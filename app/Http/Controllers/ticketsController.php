<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateticketsRequest;
use App\Http\Requests\UpdateticketsRequest;
use App\Repositories\ticketsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\tickets;

class ticketsController extends AppBaseController
{
    /** @var ticketsRepository $ticketsRepository*/
    private $ticketsRepository;

    public function __construct(ticketsRepository $ticketsRepo)
    {
        $this->middleware('auth');
        $this->ticketsRepository = $ticketsRepo;
    }

    /**
     * Display a listing of the tickets.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $tickets = tickets::SELECT('*')->get();
        }else{
            $tickets = tickets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }
        return view('tickets.index')
            ->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new tickets.
     *
     * @return Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created tickets in storage.
     *
     * @param CreateticketsRequest $request
     *
     * @return Response
     */
    public function store(CreateticketsRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        $tickets = $this->ticketsRepository->create($input);

        Flash::success('Tickets Guardado.');

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified tickets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $tickets = $this->ticketsRepository->find($id);
        }else{
            $tickets = tickets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($tickets)) {
            Flash::error('Tickets no encontrado');

            return redirect(route('tickets.index'));
        }

        return view('tickets.show')->with('tickets', $tickets);
    }

    /**
     * Show the form for editing the specified tickets.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $tickets = $this->ticketsRepository->find($id);
        }else{
            $tickets = tickets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($tickets)) {
            Flash::error('Tickets no encontrado');

            return redirect(route('tickets.index'));
        }

        return view('tickets.edit')->with('tickets', $tickets);
    }

    /**
     * Update the specified tickets in storage.
     *
     * @param int $id
     * @param UpdateticketsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateticketsRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $tickets = $this->ticketsRepository->find($id);
        }else{
            $tickets = tickets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($tickets)) {
            Flash::error('Tickets no encontrado');

            return redirect(route('tickets.index'));
        }

        $tickets = $this->ticketsRepository->update($request->all(), $id);

        Flash::success('Tickets actualizado.');

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified tickets from storage.
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
            $tickets = $this->ticketsRepository->find($id);
        }else{
            $tickets = tickets::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($tickets)) {
            Flash::error('Tickets no encontrado');

            return redirect(route('tickets.index'));
        }

        $this->ticketsRepository->delete($id);

        Flash::success('Tickets Eliminado.');

        return redirect(route('tickets.index'));
    }
}
