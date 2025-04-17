<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateclientsRequest;
use App\Http\Requests\UpdateclientsRequest;
use App\Repositories\clientsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\clients;
use App\Exports\ExportPlantilla;
use Flash;
use Excel;
use Response;

class clientsController extends AppBaseController
{
    /** @var clientsRepository $clientsRepository*/
    private $clientsRepository;

    public function __construct(clientsRepository $clientsRepo)
    {
        $this->middleware('auth');
        $this->clientsRepository = $clientsRepo;
    }

    /**
     * Display a listing of the clients.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = clients::select('clients.*');

    // Apply search filter if a search term is provided
    $search = $request->input('search');
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('clients.fullname', 'like', "%$search%")
                ->orWhere('clients.phone', 'like', "%$search%")
                ->orWhere('clients.NIF', 'like', "%$search%")
                // Add more columns to search here
                ->orWhere('clients.email', 'like', "%$search%");
        });
    }
    if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
        $clients = $query->distinct()->paginate(10);
   
    }else{
        $clients = $query->distinct()->where('clients.id_user_master', auth()->user()->id_user_master)->paginate(10);
        
    }
    $clients->appends($request->except('page')); // Preserve other query parameters when paginating

    $data = [
        'clients' => $clients,
        'search' => $search
    ];
        return view('clients.index',$data);
    }

    /**
     * Show the form for creating a new clients.
     *
     * @return Response
     */
    public function create()
    {
        return view('clients.create');
    }
    public function exportcliente()
    {
        $inicial=[['id','nombre','Telefono','NIF','direccion','localidad','provincia','codigo_postal','email','observaciones','creado','actualizado']];
        $sqlSelect="clients.id,clients.fullname,clients.phone,clients.NIF,clients.address,clients.localidad,clients.provincia,clients.postal_code,clients.email,clients.observations,clients.created_at,clients.updated_at";
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $data=clients::select(DB::raw($sqlSelect))->get();
            }else{       
            $data=clients::select(DB::raw($sqlSelect))->where('id_user_master', auth()->user()->id_user_master)->get();
         }
        $resultado=array_merge($inicial,[$data]);
        $export = new ExportPlantilla($resultado);
        return Excel::download($export,'clientes.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    
    /**
     * Store a newly created clients in storage.
     *
     * @param CreateclientsRequest $request
     *
     * @return Response
     */
    public function store(CreateclientsRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            $input['id_user_master']=auth()->user()->id_user_master;
        
        }
        $clients = $this->clientsRepository->create($input);

        Flash::success('Cliente guardado');

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $clients = $this->clientsRepository->find($id);
        }else{
            $clients = clients::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($clients)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $clients = $this->clientsRepository->find($id);
        }else{
            $clients = clients::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($clients)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('clients', $clients);
    }

    /**
     * Update the specified clients in storage.
     *
     * @param int $id
     * @param UpdateclientsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclientsRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $clients = $this->clientsRepository->find($id);
        }else{
            $clients = clients::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($clients)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($request->all(), $id);

        Flash::success('Cliente Actualizado.');

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified clients from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error('Cliente no encontrado');

            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);

        Flash::success('Cliente eliminado.');

        return redirect(route('clients.index'));
    }
}
