<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebudgetsRequest;
use App\Http\Requests\UpdatebudgetsRequest;
use App\Repositories\budgetsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Models\clients;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\budgets;

class budgetsController extends AppBaseController
{
    /** @var budgetsRepository $budgetsRepository*/
    private $budgetsRepository;

    public function __construct(budgetsRepository $budgetsRepo)
    {
        $this->middleware('auth');
        $this->budgetsRepository = $budgetsRepo;
    }

    /**
     * Display a listing of the budgets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DB::table('budgets')
                ->join('clients', 'budgets.client_id', '=', 'clients.id')
                ->select('clients.fullname as client_name', 'budgets.*');
                $search = $request->input('search');
                if (!empty($search)) {
                    $query->where(function ($q) use ($search) {
                        $q->where('clients.fullname', 'like', "%$search%")
                            ->orWhere('budgets.date', 'like', "%$search%")
                            ->orWhere('budgets.id', 'like', "%$search%");
                    });
                }
                if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                    $budgets = $query->distinct()->paginate(10);
               
                }else{
                    $budgets = $query->distinct()->where('budgets.id_user_master', auth()->user()->id_user_master)->paginate(10);
                    
                }
                $budgets->appends($request->except('page')); // Preserve other query parameters when paginating
            
        $data = [
            'budgets' => $budgets,
            'search' => $search
        ];

        return view('budgets.index', $data);
    }

    /**
     * Show the form for creating a new budgets.
     *
     * @return Response
     */
    public function create()
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
        $clientsOption = clients::pluck('fullname', 'id');
        }else{
        $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->pluck('fullname', 'id');
        }

        $data = [
            'clientsOption' => $clientsOption,
        ];
        return view('budgets.create', $data);
    }

    /**
     * Store a newly created budgets in storage.
     *
     * @param CreatebudgetsRequest $request
     *
     * @return Response
     */
    public function store(CreatebudgetsRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

            }else{
                $input['id_user_master']=auth()->user()->id_user_master;
            
            }
        $budgets = $this->budgetsRepository->create($input);

        Flash::success('Presupuesto Guardado.');

        return redirect(route('budgets.index'));
    }

    /**
     * Display the specified budgets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $budgets = $this->budgetsRepository->find($id);
        }else{
            $budgets = budgets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($budgets)) {
            Flash::error('Presupuesto no encontrado');

            return redirect(route('budgets.index'));
        }

        $clients = clients::find($budgets->client_id);

        $data = [
            'budgets' => $budgets,
            'client' => $clients->fullname
        ];

        return view('budgets.show', $data);
    }

    /**
     * Show the form for editing the specified budgets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $budgets = $this->budgetsRepository->find($id);
            $clientsOption = clients::pluck('fullname', 'id');
        }else{
            $budgets = budgets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
            $clientsOption = clients::where('id_user_master', auth()->user()->id_user_master)->pluck('fullname', 'id');
        }
        if (empty($budgets)) {
            Flash::error('Presupuesto no encontrado');

            return redirect(route('budgets.index'));
        }


        $data = [
            'clientsOption' => $clientsOption,
            'budgets' => $budgets,
        ];

        return view('budgets.edit', $data);
    }

    /**
     * Update the specified budgets in storage.
     *
     * @param int $id
     * @param UpdatebudgetsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebudgetsRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $budgets = $this->budgetsRepository->find($id);
        }else{
            $budgets = budgets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
         
        }
        if (empty($budgets)) {
            Flash::error('Presupuesto no encontrado');

            return redirect(route('budgets.index'));
        }

        $budgets = $this->budgetsRepository->update($request->all(), $id);

        Flash::success('Presupuesto Actualizado.');

        return redirect(route('budgets.index'));
    }

    /**
     * Remove the specified budgets from storage.
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
            $budgets = $this->budgetsRepository->find($id);
        }else{
            $budgets = budgets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
         
        }
        if (empty($budgets)) {
            Flash::error('Presupuesto no encontrado');

            return redirect(route('budgets.index'));
        }

        $this->budgetsRepository->delete($id);

        Flash::success('Presupuesto Eliminado.');

        return redirect(route('budgets.index'));
    }
}
