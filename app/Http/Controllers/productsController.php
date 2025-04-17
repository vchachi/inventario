<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductsRequest;
use App\Http\Requests\UpdateproductsRequest;
use App\Repositories\productsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\categories;
use App\Exports\ExportPlantilla;
use App\Imports\ImportPlantilla;
use App\Models\products;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;
use Flash;
use Excel;
use stdClass;
use Response;

class productsController extends AppBaseController
{
    /** @var productsRepository $productsRepository*/
    private $productsRepository;
    private $texto=[
        'title.required' => 'Nombre  es necesario que complete el campo',
        'reference.required' => 'Referencia  es necesario que complete el campo',
        'units.integer' => 'Unidades es requerido y debe ser un numero',
        'sell_price.numeric' => 'Precio de Venta es requerido y debe ser un numero'
    ];
    private $validacion=[
        'title' => 'required',
        'reference' => 'required',
        'units' => 'integer',
        'sell_price' => 'numeric',
    ];
    public function __construct(productsRepository $productsRepo)
    {
        $this->productsRepository = $productsRepo;
    }

    /**
     * Display a listing of the products.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.title as category_title', 'products.*');

        // Apply search filter if a search term is provided
        $search = $request->input('search');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('products.title', 'like', "%$search%")
                    ->orWhere('products.brand', 'like', "%$search%")
                    ->orWhere('products.model', 'like', "%$search%")
                    // Add more columns to search here
                    ->orWhere('categories.title', 'like', "%$search%");
            });
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $products = $query->distinct()->paginate(10);
       
        }else{
            $products = $query->distinct()->where('products.id_user_master', auth()->user()->id_user_master)->paginate(10);
            
        }
        $products = $query->paginate(8);
        $products->appends($request->except('page')); // Preserve other query parameters when paginating

        $data = [
            'products' => $products,
            'search' => $search
        ];

        return view('products.index', $data);
    }

    public function exportCSVFile(){
        $export = new ExportPlantilla([
            ['nombre','marca','modelo','color','codigobarra','referencia','unidades','preciocompra','precioventa','observaciones']
        ]);
        return Excel::download($export,'products.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function import(Request $request) {
        $import = new ImportPlantilla;
        Excel::import($import, $request->file('file'));
        $array = $import->getArray();
        foreach ($array as &$valor) {
            if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                $products = $this->productsRepository->create([
                    'title' => $valor[0][0],
                    'category_id' => 1,
                    'brand' => $valor[0][1],
                    'model' => $valor[0][2],
                    'color' => $valor[0][3],
                    'bar_code' => $valor[0][4],
                    'reference' => $valor[0][5],
                    'units' => number_format($valor[0][6]),
                    'buy_price' => floatval($valor[0][7]),
                    'sell_price' => floatval($valor[0][8]),
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => $valor[0][9]
                ] );
           
            }else{
                $products = $this->productsRepository->create([
                    'title' => $valor[0][0],
                    'category_id' => 1,
                    'brand' => $valor[0][1],
                    'model' => $valor[0][2],
                    'color' => $valor[0][3],
                    'bar_code' => $valor[0][4],
                    'reference' => $valor[0][5],
                    'units' => number_format(floatval($valor[0][6])),
                    'buy_price' => floatval($valor[0][7]),
                    'sell_price' => floatval($valor[0][8]),
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => $valor[0][9],
                    'id_user_master'=>auth()->user()->id_user_master
                ] );
                
            }
     
        }
        return redirect(route('products.index'));
    }
    public function repairsImport(Request $request){
        $input = $request->all();
            $response = Http::withHeaders([
                'Accept' => 'application/xml',
            ])->get("https://recambiostablet.com/api/products/", [
                'ws_key' => "SH77B9WW89CVEVS5TQ8HV4Y9HKG5GH1B",
            ]);
    
            $xmlData = $response->body();
    
            $xml = new SimpleXMLElement($xmlData);
                $idMAster=auth()->user()->id_user_master;
                $idMAsterbool=auth()->user()->is_master;
          foreach ($xml->products->product as $productData) {
                $url = "https://recambiostablet.com/api/products/".$productData['id']."?ws_key=SH77B9WW89CVEVS5TQ8HV4Y9HKG5GH1B";
           
               $response = Http::get($url);
                $data = new SimpleXMLElement($response);
                print_r($data->product);
                  /*  
                $cat_id = $data->product->id_category_default[0]->__toString();
                $units = $data->product->unit_price_ratio[0]->__toString();
                $buy_price = $data->product->price[0]->__toString();
                $sell_price = $data->product->wholesale_price[0]->__toString();
                print_R($data->product);
                /*
                if($idMAster==0 && $idMAsterbool==true){
                    $products = products::updateOrCreate(['id_repairs'=> $data->product->id[0]->__toString()],[
                        'title' => $data->product->name->language[0][0]->__toString(),
                        'category_id' =>(int) $cat_id,
                        'brand' => '',
                        'model' => '',
                        'color' => '',
                        'bar_code' => '',
                        'reference' => $data->product->reference[0]->__toString(),
                        'units' => (int) $units,
                        'buy_price' => (double) $buy_price,
                        'sell_price' => (double) $sell_price,
                        'invoicing' => 1,
                        'state' => 1,
                        'storage' => 1,
                        'warranty' => 1,
                        'observations' => $data->product->meta_description->language[1][0]->__toString(),
                        'id_repairs' =>$data->product->id[0]->__toString()
                    ] );  
               
                }else{
                    $products = products::updateOrCreate(['id_repairs'=> $data->product->id[0]->__toString()],[
                        'title' => $data->product->name->language[0][0]->__toString(),
                        'category_id' =>(int) $cat_id,
                        'brand' => '',
                        'model' => '',
                        'color' => '',
                        'bar_code' => '',
                        'reference' => $data->product->reference[0]->__toString(),
                        'units' => (int) $units,
                        'buy_price' => (double) $buy_price,
                        'sell_price' => (double) $sell_price,
                        'invoicing' => 1,
                        'state' => 1,
                        'storage' => 1,
                        'warranty' => 1,
                        'observations' => $data->product->meta_description->language[1][0]->__toString(),
                        'id_repairs' => $data->product->id[0]->__toString(),
                        'id_user_master'=>$idMAster
                    ] );                
                }    */
            }
         //return redirect(route('products.index'));
        
    }
    public function woocomerceimport(Request $request){
        $input = $request->all();
        $productos= array();    
        $idMAster=auth()->user()->id_user_master;
        $idMAsterbool=auth()->user()->is_master;
        foreach ($this->AddAllProductsWoocomerce($productos,$input,"") as &$valor) {

            if($idMAster==0 && $idMAsterbool==true){
                $products = products::updateOrCreate(['id_woocomerce'=>$valor->id],[
                    'title' => $valor->name,
                    'category_id' => 1,
                    'brand' => '',
                    'model' => '',
                    'color' => '',
                    'bar_code' => '',
                    'reference' => '',
                    'units' => number_format($valor->stock_quantity),
                    'buy_price' => floatval($valor->price),
                    'sell_price' => floatval($valor->sale_price),
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => '',
                    'id_woocomerce' =>$valor->id,
                ] );
           
            }else{
                $products = products::updateOrCreate(['id_woocomerce'=>$valor->id],[
                    'title' => $valor->name,
                    'category_id' => 1,
                    'brand' => '',
                    'model' => '',
                    'color' => '',
                    'bar_code' => '',
                    'reference' => '',
                    'units' => number_format($valor->stock_quantity),
                    'buy_price' => floatval($valor->price),
                    'sell_price' => floatval($valor->sale_price),
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => '',
                    'id_woocomerce' =>$valor->id,
                    'id_user_master'=>$idMAster
                ] );                
            }
        
        }
        return redirect(route('products.index'));
    }

    public function shopifyimport(Request $request){
        $input = $request->all();
        $productos=array();
        foreach ($this->AddAllProducts($productos,$input,"") as &$valor) {
            if($idMAster==0 && $idMAsterbool==true){
                $products = products::updateOrCreate(['id_shopify'=>$valor->id],[
                    'title' => $valor->title,
                    'category_id' => 1,
                    'brand' => '',
                    'model' => '',
                    'color' => '',
                    'bar_code' => $valor->variants[0]->barcode,
                    'reference' => '',
                    'units' => $valor->variants[0]->inventory_quantity,
                    'buy_price' => $valor->variants[0]->price,
                    'sell_price' => $valor->variants[0]->price,
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => '',
                    'id_shopify' =>$valor->id,
                ] );
            }else{
                $products = products::updateOrCreate(['id_shopify'=>$valor->id],[
                    'title' => $valor->title,
                    'category_id' => 1,
                    'brand' => '',
                    'model' => '',
                    'color' => '',
                    'bar_code' => $valor->variants[0]->barcode,
                    'reference' => '',
                    'units' => $valor->variants[0]->inventory_quantity,
                    'buy_price' => $valor->variants[0]->price,
                    'sell_price' => $valor->variants[0]->price,
                    'invoicing' => 1,
                    'state' => 1,
                    'storage' => 1,
                    'warranty' => 1,
                    'observations' => '',
                    'id_shopify' =>$valor->id,
                    'id_user_master'=>$idMAster
                ] );     
            }
        
        }
            return redirect(route('products.index'));
    }

    function AddAllProductsWoocomerce($productos,$input,$urlEnviaNuevo){
        $curl = curl_init();
        $urlEnviar=$input['url']."/wp-json/wc/v2/products?per_page=100";
        if($urlEnviaNuevo==""){
    
        }else{
            $urlEnviar=$urlEnviaNuevo;
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlEnviar,// your preferred link
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER=>true,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_VERBOSE=>false,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_SSL_VERIFYPEER=>false,
            CURLOPT_HTTPHEADER =>array(
                "Authorization: Basic " . base64_encode($input['userkey'] . ":" . $input['passkey'] )
                ),
        ));
        $response = curl_exec($curl);
        $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
        $headers = array();
        $header_data = explode("\n",$response[0]);
        $headers['status'] = $header_data[0];
        array_shift($header_data);
        foreach($header_data as $part) {
            $h = explode(":", $part,2);
            $headers[trim($h[0])] = trim($h[1]);
        }
        $err = curl_error($curl);
        curl_close($curl);
        if(!isset($headers['link'])){
            return [];
        }
        $ruta=$this->WoocomerPagination($headers['link']);
        $productoss=array_merge(json_decode($response[1]),$productos);
        if(empty($ruta)){
            return $productoss;
        }else{
           return $this->AddAllProductsWoocomerce( $productoss,$input,$ruta);
        }
    }

function AddAllProducts($productos,$input,$token){
    $curl = curl_init();
    $urlEnviar="https://".$input['url'].".myshopify.com/admin/api/2023-07/products.json?limit=1";
    if($token==""){

    }else{
        $urlEnviar.="&page_info=".$token;

    }
    curl_setopt_array($curl, array(
        CURLOPT_URL => $urlEnviar,// your preferred link
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER=>true,
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_VERBOSE=>false,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYPEER=>false,
        CURLOPT_HTTPHEADER => array(
            // Set Here Your Requesred Headers
            'X-Shopify-Access-Token: '. $input['password'],
        ),
    ));
    $response = curl_exec($curl);
    $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
    $headers = array();
    $header_data = explode("\n",$response[0]);
    $headers['status'] = $header_data[0];
    array_shift($header_data);
    foreach($header_data as $part) {
        $h = explode(":", $part,2);
        $headers[trim($h[0])] = trim($h[1]);
    }

    $err = curl_error($curl);
    curl_close($curl);
    $productoss=$productos;
    if(!isset(json_decode($response[count( $response)-1])->products)){
        return [];
    }
    if(COUNT(json_decode($response[count( $response)-1])->products)>1){
        $productoss=array_merge($productos,json_decode($response[count( $response)-1])->products);
    }else{
        $productoss[]= json_decode($response[count( $response)-1])->products[0];

    }
    if(isset($headers['link'])){
        if($this->shopifyPagination($headers['link'])==""){
            return $productoss;
        }else{
             return $this->AddAllProducts($productoss,$input,$this->shopifyPagination($headers['link']));
        }
    }else{
        return $productoss;

    }
   
}
function WoocomerPagination($link){
    $envioInformacion="";
    $link_array =[];
    if( strpos( $link, ',' )  !== false ) {
        $link_array = explode(',', $link );
    } else {
        $links = $link;
    }
    if( sizeof( $link_array ) > 1 ) {
        
        $rel = explode(";", $link_array[1]);
        $rel = $this->str_btwn($rel[1], '"', '"');
        if($rel == "next") {
            $next_link = $link_array[1];
            $next_link = $this->str_btwn($next_link, '<', '>');  
              
            $envioInformacion = $next_link;
        } 
    } else {
        $rel = explode(";", $link);
        $rel = $this->str_btwn($rel[1], '"', '"');
        
        if($rel == "next") {
            $next_link = $links;
            $next_link = $this->str_btwn($next_link, '<', '>');
            $envioInformacion = $next_link;
        }
    }
    return $envioInformacion;
}
    function shopifyPagination($link){
        $envioInformacion="";
        $link_array =[];
        if( strpos( $link, ',' )  !== false ) {
            $link_array = explode(',', $link );
        } else {
            $links = $link;
        }
        if( sizeof( $link_array ) > 1 ) {
            $next_link = $link_array[1];
            $next_link = $this->str_btwn($next_link, '<', '>');
        
            $param = parse_url($next_link); 
            parse_str($param['query'], $next_link); 
        
            $envioInformacion = $next_link['page_info'];
        } else {
            $rel = explode(";", $link);
            $rel = $this->str_btwn($rel[1], '"', '"');
        
            if($rel == "previous") {
            
            } else {
                $next_link = $links;
                $next_link = $this->str_btwn($next_link, '<', '>');
        
                $param = parse_url($next_link); 
                parse_str($param['query'], $next_link); 
        
                $envioInformacion = $next_link['page_info'];
            }
        }
        return $envioInformacion;
    }
    function str_btwn($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    } 
    /**
     * Show the form for creating a new products.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categoriesOption = categories::pluck('title', 'id');
       
        }else{
            
        $categoriesOption = categories::where('id_user_master', auth()->user()->id_user_master)->pluck('title', 'id');
            
        }

        $data = [
            'categoriesOption' => $categoriesOption,
        ];
        return view('products.create', $data);
    }

    /**
     * Store a newly created products in storage.
     *
     * @param CreateproductsRequest $request
     *
     * @return Response
     */
    public function store(CreateproductsRequest $request)
    {
        $request->validate($this->validacion,$this->texto);
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
        }else{
            $input['id_user_master']=auth()->user()->id_user_master;
         }
        $products = $this->productsRepository->create($input);

        Flash::success('Producto Guardado.');

        return redirect(route('products.index'));
    }

    /**
     * Display the specified products.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $products = $this->productsRepository->find($id);
        }else{
            $products = products::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
      

        if (empty($products)) {
            Flash::error('Producto no encontrado');

            return redirect(route('products.index'));
        }
        $category = categories::find($products->category_id);

        $data = [
            'products' => $products,
            'category' => $category->title
        ];
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified products.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $products = $this->productsRepository->find($id);
        }else{
            $products = products::where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
      
        if (empty($products)) {
            Flash::error('Producto no encontrado');

            return redirect(route('products.index'));
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categoriesOption = categories::pluck('title', 'id');
       
        }else{
            
        $categoriesOption = categories::where('id_user_master', auth()->user()->id_user_master)->pluck('title', 'id');
            
        }
        $data = [
            'categoriesOption' => $categoriesOption,
            'products' => $products,
        ];

        return view('products.edit', $data);
    }

    /**
     * Update the specified products in storage.
     *
     * @param int $id
     * @param UpdateproductsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductsRequest $request)
    {
        
        $request->validate($validacion,$texto);
        $input =  $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $products = $this->productsRepository->find($id);
        }else{
            $products = products::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }

        if (empty($products)) {
            Flash::error('Producto no encontrado');

            return redirect(route('products.index'));
        }

        $products = $this->productsRepository->update($input, $id);

        Flash::success('Producto Actualizado.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified products from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $products = $this->productsRepository->find($id);
        }else{
            $products = products::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($products)) {
            Flash::error('Producto no encontrado');

            return redirect(route('products.index'));
        }

        $this->productsRepository->delete($id);

        Flash::success('Producto Guardado.');

        return redirect(route('products.index'));
    }
}
