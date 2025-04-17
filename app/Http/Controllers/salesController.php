<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesalesRequest;
use App\Http\Requests\UpdatesalesRequest;
use App\Repositories\salesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Models\clients;
use App\Models\products;
use App\Models\salesItems;
use App\Models\sales;
use App\Models\repairs;
use Illuminate\Http\Request;
use Flash;
use Response;

class salesController extends AppBaseController
{
    /** @var salesRepository $salesRepository*/
    private $salesRepository;

    public function __construct(salesRepository $salesRepo)
    {
        $this->middleware('auth');
        $this->salesRepository = $salesRepo;
    }

    /**
     * Display a listing of the sales.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = sales::SELECT(DB::raw('clients.fullname as client_name,sales.total,sales.subtotal,sales.iva,sales.date,sales.id,sales.id_repara,sales.id_user_master'))
                ->join('clients', 'sales.client_id', '=', 'clients.id')
                ->whereNull('sales.id_repara');
    
            // Apply search filter if a search term is provided
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('clients.fullname', 'like', "%$search%")
                        ->orWhere('sales.subtotal', 'like', "%$search%")
                        ->orWhere('sales.id', 'like', "%$search%")
                        // Add more columns to search here
                        ->orWhere('sales.date', 'like', "%$search%");
                });
            }
            if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                $sales = $query->distinct()->paginate(10);
           
            }else{
                $sales = $query->distinct()->where('sales.id_user_master', auth()->user()->id_user_master)->paginate(10);
                
            }
            $sales->appends($request->except('page')); // Preserve other query parameters when paginating
    
            $data = [
                'sales' => $sales,
                'search' => $search
            ];
        return view('sales.index', $data);
    }

    /**
     * Show the form for creating a new sales.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $productosall = products::get();
       
        }else{
           
        $productosall = products::where('id_user_master', auth()->user()->id_user_master)->get();   
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){        
            $clientsOption = clients::get();
            }else{
                $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->get();
           }

        
        $data = [
            'clientsOption' => $clientsOption,
            'productosall'=>$productosall,
            'productosall2'=>$productosall
        ];
        return view('sales.create', $data);
    }

    public function paid(Request $request)
    {
        $input = $request->all();
        $dataArregloSalesItem=json_decode($input['productosguardar']);
        $dataHeaderSale=[
            'client_id' => $input['client_id'],
            'date' => now(),
            'total' => $input['totalenvio'],
            'subtotal' => $input['subtotalenvio'],
            'iva'=>$input['ivaenvio'],
            'forma_pago'=>$input['forma_pago'],
            'user_created'=>auth()->user()->id
        ];
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){        
            $dataHeaderSale=[
                'client_id' => $input['client_id'],
                'date' => now(),
                'total' => $input['totalenvio'],
                'subtotal' => $input['subtotalenvio'],
                'iva'=>$input['ivaenvio'],
                'forma_pago'=>$input['forma_pago'],
                'user_created'=>auth()->user()->id
            ];
            }else{
                $dataHeaderSale=[
                    'client_id' => $input['client_id'],
                    'date' => now(),
                    'total' => $input['totalenvio'],
                    'subtotal' => $input['subtotalenvio'],
                    'iva'=>$input['ivaenvio'],
                    'forma_pago'=>$input['forma_pago'],
                    'id_user_master'=>auth()->user()->id_user_master,
                    'user_created'=>auth()->user()->id
                ];
           }

        $salesid = $this->salesRepository->create( $dataHeaderSale)->id;
       $dataSaleItem=array();
        foreach ($dataArregloSalesItem as $key=>$value) {
            $guardado=salesItems::create([
                'id_sale' => $salesid,
                'reng_id' => $key+1,
                'id_product' => $value->producto->id,
                'price' => $value->precio,
                'amount' => $value->cantidad,
                'subtotal'=>$value->cantidad*$value->precio,
                ]);
        }
        return view('sales.paid')->with('id',$salesid);
    }
    public function paidshow($id){
        return view('sales.paid')->with('id',$id);
    }
    public function paidshowRepairs($id){
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){        
          
        $datoSales=sales::where('id_repara',$id)->get();
            }else{
        $datoSales=sales::where('id_repara',$id)->where('id_user_master', auth()->user()->id_user_master)->get();
           }
        return view('sales.paid')->with('id',$datoSales[0]->id)->with('datoRetorno',1);
    }
    /**
     * Store a newly created sales in storage.
     *
     * @param CreatesalesRequest $request
     *
     * @return Response
     */
    public function store(CreatesalesRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            $input['id_user_master']=auth()->user()->id_user_master;
        
        }
        $sales = $this->salesRepository->create($input);

        Flash::success('Ventas Guardada Correctamente.');

        return redirect(route('sales.index'));
    }

    /**
     * Display the specified sales.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $sales = $this->salesRepository->find($id);
        }else{
            $sales = sales::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($sales)) {
            Flash::error('Venta no encontrada');

            return redirect(route('sales.index'));
        }
        
        $clients = clients::find($sales->client_id);

        $data = [
            'sales' => $sales,
            'client' => $clients->fullname
        ];
        return view('sales.show', $data);
    }

    /**
     * Show the form for editing the specified sales.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $sales = $this->salesRepository->find($id);      
            $clientsOption = clients::get();
            $productosall = products::get();
        }else{
            $productosall = products::where('id_user_master', auth()->user()->id_user_master)->get();
            $sales = sales::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
            $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->get();
        }

        if (empty($sales)) {
            Flash::error('Venta no encontrada');

            return redirect(route('sales.index'));
        }
        $items =salesItems::where('id_sale',$id)->get();
        if (empty($items)) {
            Flash::error('Venta no encontrada');

            return redirect(route('sales.index'));
        }
        
        $data = [
            'clientsOption' => $clientsOption,
            'productosall'=>$productosall,
            'productosall2'=>$productosall,
            'sales' => $sales,
            'itemssales'=>$items
        ];

        return view('sales.edit', $data);
    }
    
    /**
     * Update the specified sales in storage.
     *
     * @param int $id
     * @param UpdatesalesRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();
        $dataArregloSalesItem=json_decode($input['productosguardar']);
        $sales = $this->salesRepository->find($id);

        if (empty($sales)) {
            Flash::error('Venta no encontrada');

            return redirect(route('sales.index'));
        }
        $dataHeaderSale=[
            'client_id' => $input['client_id'],
            'total' => $input['totalenvio'],
            'subtotal' => $input['subtotalenvio'],
            'iva'=>$input['ivaenvio'],
            'forma_pago'=>$input['forma_pago'],
        ];
        $sales = $this->salesRepository->update($dataHeaderSale, $id);
        salesItems::where('id_sale',$id)->delete();
        foreach ($dataArregloSalesItem as $key=>$value) {
            $guardado=salesItems::create([
                'id_sale' => $id,
                'reng_id' => $key+1,
                'id_product' => $value->producto->id,
                'price' => $value->precio,
                'amount' => $value->cantidad,
                'subtotal'=>$value->cantidad*$value->precio,
                ]);
        }

        return view('sales.paid')->with('id',$id);
    }

    /**
     * Remove the specified sales from storage.
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
            $sales = $this->salesRepository->find($id);
        }else{
            $sales = sales::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($sales)) {
            Flash::error('Venta no encontrada');

            return redirect(route('sales.index'));
        }
        if(!empty($sales->id_repara)){
            repairs::where('id',$sales->id_repara)->update(['status'=>'5']);
        }
        $this->salesRepository->delete($id);

        Flash::success('Sales deleted successfully.');

        return redirect(route('sales.index'));
    }
}
