<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateordersRequest;
use App\Http\Requests\UpdateordersRequest;
use App\Repositories\ordersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use Flash;
use Response;

class ordersController extends AppBaseController
{
    /** @var ordersRepository $ordersRepository*/
    private $ordersRepository;

    public function __construct(ordersRepository $ordersRepo)
    {
        $this->middleware('auth');
        $this->ordersRepository = $ordersRepo;
    }

    /**
     * Display a listing of the orders.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = orders::SELECT(DB::raw('orders.number, orders.date,orders.state,orders.provider,orders.store,orders.delivery_costs,orders.observations,orders.id'));

    // Apply search filter if a search term is provided
    $search = $request->input('search');
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('orders.number', 'like', "%$search%")
                ->orWhere('orders.delivery_costs', 'like', "%$search%")
                ->orWhere('orders.provider', 'like', "%$search%");
                // Add more columns to search here
        });
    }
    if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
        $orders = $query->distinct()->paginate(10);
   
    }else{
        $orders = $query->distinct()->where('orders.id_user_master', auth()->user()->id_user_master)->paginate(10);
        
    }
    $orders->appends($request->except('page')); // Preserve other query parameters when paginating

    $data = [
        'orders' => $orders,
        'search' => $search
    ];
return view('orders.index', $data);

    }

    /**
     * Show the form for creating a new orders.
     *
     * @return Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created orders in storage.
     *
     * @param CreateordersRequest $request
     *
     * @return Response
     */
    public function store(CreateordersRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            $input['id_user_master']=auth()->user()->id_user_master;
        
        }
        $orders = $this->ordersRepository->create($input);

        Flash::success('Pedido Guardado.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified orders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orders = $this->ordersRepository->find($id);
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $orders = $this->ordersRepository->find($id);
        }else{
            $orders = orders::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($orders)) {
            Flash::error('Pedido no encontrado');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('orders', $orders);
    }

    /**
     * Show the form for editing the specified orders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $orders = $this->ordersRepository->find($id);
        }else{
            $orders = orders::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($orders)) {
            Flash::error('Pedido no encontrado');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')->with('orders', $orders);
    }

    /**
     * Update the specified orders in storage.
     *
     * @param int $id
     * @param UpdateordersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateordersRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $orders = $this->ordersRepository->find($id);
        }else{
            $orders = orders::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($orders)) {
            Flash::error('Pedido no encontrado');

            return redirect(route('orders.index'));
        }

        $orders = $this->ordersRepository->update($request->all(), $id);

        Flash::success('Pedido actualizado.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified orders from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Pedido no encontrado');

            return redirect(route('orders.index'));
        }

        $this->ordersRepository->delete($id);

        Flash::success('Pedido eliminado.');

        return redirect(route('orders.index'));
    }
}
