<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterepairsRequest;
use App\Http\Requests\UpdaterepairsRequest;
use App\Repositories\repairsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\salesItems;
use Illuminate\Support\Facades\DB;
use App\Exports\RepairsExport;
use App\Models\categories;
use App\Models\clients;
use App\Models\repairs;
use Maatwebsite\Excel\Facades\Excel;
use Flash;
use PDF;
use Response;

class repairsController extends AppBaseController
{
    /** @var repairsRepository $repairsRepository*/
    private $repairsRepository;

    public function __construct(repairsRepository $repairsRepo)
    {
        $this->middleware('auth');
        $this->repairsRepository = $repairsRepo;
    }

    /**
     * Display a listing of the repairs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
                $query = repairs::select('clients.fullname as client_name', 'categories.title as category_title', 'repairs.*')
                ->join('clients', 'repairs.client_id', '=', 'clients.id')
                ->join('categories', 'repairs.category_id', '=', 'categories.id');
    
            // Apply search filter if a search term is provided
            $search = $request->input('search');
            if (!empty($search)) {
                $query->where(function ($q) use ($search) {
                    $q->where('clients.fullname', 'like', "%$search%")
                        ->orWhere('categories.title', 'like', "%$search%")
                        ->orWhere('repairs.id', 'like', "%$search%")
                        // Add more columns to search here
                        ->orWhere('repairs.date', 'like', "%$search%");
                });
            }
            if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                $repairs = $query->distinct()->paginate(10);
           
            }else{
                $repairs = $query->distinct()->where('repairs.id_user_master', auth()->user()->id_user_master)->paginate(10);
                
            }
            $repairs->appends($request->except('page')); // Preserve other query parameters when paginating
    
            $data = [
                'repairs' => $repairs,
                'search' => $search
            ];
        return view('repairs.index', $data);
    }

    /**
     * Show the form for creating a new repairs.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categoriesOption = categories::get();
            $clientsOption = clients::get();
        }else{
            $categoriesOption = categories::where('id_user_master', auth()->user()->id_user_master)->get();
        $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->get();
        }
        

        $data = [
            'categoriesOption' => $categoriesOption,
            'clientsOption' => $clientsOption,
        ];
        return view('repairs.create', $data);
    }

    /**
     * Store a newly created repairs in storage.
     *
     * @param CreaterepairsRequest $request
     *
     * @return Response
     */
    public function store(CreaterepairsRequest $request)
    {
        $input = $request->all();
        $input['status'] = '1';
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            $input['id_user_master']=auth()->user()->id_user_master;
        
        }
        $repairs = $this->repairsRepository->create($input);

        Flash::success('Reparacion Guardada.');

        return redirect(route('repairs.index'));
    }

    /**
     * Display the specified repairs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $repairs = $this->repairsRepository->find($id);
        }else{
            $repairs = repairs::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($repairs)) {
            Flash::error('Reparacion no encontrada');

            return redirect(route('repairs.index'));
        }

        $client = clients::find($repairs->client_id);
        $category = categories::find($repairs->category_id);

        $data = [
            'repairs' => $repairs,
            'client' => $client->fullname,
            'category' => $category->title
        ];

        return view('repairs.show', $data);
    }

    /**
     * Show the form for editing the specified repairs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $repairs = $this->repairsRepository->find($id);
            $categoriesOption = categories::get();
            $clientsOption = clients::get();
        }else{
            $categoriesOption = categories::where('id_user_master', auth()->user()->id_user_master)->get();
        $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->get();
        $repairs = repairs::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
    }

        if (empty($repairs)) {
            Flash::error('Reparacion no encontrada');

            return redirect(route('repairs.index'));
        }


        $data = [
            'categoriesOption' => $categoriesOption,
            'clientsOption' => $clientsOption,
            'repairs' => $repairs,
        ];

        return view('repairs.edit', $data);
    }

    /**
     * Update the specified repairs in storage.
     *
     * @param int $id
     * @param UpdaterepairsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterepairsRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $repairs = $this->repairsRepository->find($id);
        }else{
            $repairs = repairs::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($repairs)) {
            Flash::error('Reparacion no Encontrada');

            return redirect(route('repairs.index'));
        }
        $input=$request->all();
        if($input["status"]==6){
            if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                $dataHeaderSale=[
                    'client_id' => $input['client_id'],
                    'date' => now(),
                    'id_repara' => $id,
                    'total' => $input['repair_cost'],
                    'subtotal' => $input['repair_cost'],
                    'iva'=>0,
                    'forma_pago'=>1,
                    'user_created'=>auth()->user()->id
                ];
            }else{
                $dataHeaderSale=[
                    'client_id' => $input['client_id'],
                    'date' => now(),
                    'id_repara' => $id,
                    'total' => $input['repair_cost'],
                    'subtotal' => $input['repair_cost'],
                    'iva'=>0,
                    'id_user_master'=>auth()->user()->id_user_master,
                    'forma_pago'=>1,
                    'user_created'=>auth()->user()->id
                ];
            }
        
            $salesid = sales::create( $dataHeaderSale)->id;
           $guardado=salesItems::create([
            'id_sale' => $salesid,
            'reng_id' => 1,
            'id_product' => 0,
            'price' => $input['repair_cost'],
            'amount' => 1,
            'subtotal'=>$input['repair_cost'],
            ]);
        }
       
        $repairs = $this->repairsRepository->update($input, $id);

        Flash::success('Reparacion Actualizada.');

        return redirect(route('repairs.index'));
    }

    /**
     * Remove the specified repairs from storage.
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
            $repairs = $this->repairsRepository->find($id);
        }else{
            $repairs = repairs::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($repairs)) {
            Flash::error('Reparacion no encontrada');

            return redirect(route('repairs.index'));
        }

        $this->repairsRepository->delete($id);

        Flash::success('Reparacion eliminadas exitosamente.');

        return redirect(route('repairs.index'));
    }

    /**
     * Show the form for editing the specified repairs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function pdfGenerate($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $repairs = $this->repairsRepository->find($id);
        }else{
            $repairs = repairs::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($repairs)) {
            Flash::error('Reparaciones no encontradas');

            return redirect(route('repairs.index'));
        }
        
        $data = [
            'repairs' => $repairs
        ];
          
        $pdf = PDF::loadView('pdf/repairs/factura', $data);
    
        return $pdf->download('factura.pdf');
    }
    
    /**
     * Show the form for creating a new repairs.
     *
     * @return Response
     */
    public function exportRepairsCSVFile() 
    {
        return Excel::download(new RepairsExport, 'repairs.xlsx');
    }
}
