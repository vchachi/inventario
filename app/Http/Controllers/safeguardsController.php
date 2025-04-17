<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesafeguardsRequest;
use App\Http\Requests\UpdatesafeguardsRequest;
use App\Repositories\safeguardsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\safeguards;

class safeguardsController extends AppBaseController
{
    /** @var safeguardsRepository $safeguardsRepository*/
    private $safeguardsRepository;

    public function __construct(safeguardsRepository $safeguardsRepo)
    {
        $this->middleware('auth');
        $this->safeguardsRepository = $safeguardsRepo;
    }

    /**
     * Display a listing of the safeguards.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $safeguards = safeguards::SELECT('*')->get();
        }else{
            $safeguards = safeguards::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }
        return view('safeguards.index')
            ->with('safeguards', $safeguards);
    }

    /**
     * Show the form for creating a new safeguards.
     *
     * @return Response
     */
    public function create()
    {
        return view('safeguards.create');
    }

    /**
     * Store a newly created safeguards in storage.
     *
     * @param CreatesafeguardsRequest $request
     *
     * @return Response
     */
    public function store(CreatesafeguardsRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        $safeguards = $this->safeguardsRepository->create($input);

        Flash::success('Resguardos Guardado.');

        return redirect(route('safeguards.index'));
    }

    /**
     * Display the specified safeguards.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $safeguards = $this->safeguardsRepository->find($id);
        }else{
            $safeguards = safeguards::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($safeguards)) {
            Flash::error('Resguardos no encontrado');

            return redirect(route('safeguards.index'));
        }

        return view('safeguards.show')->with('safeguards', $safeguards);
    }

    /**
     * Show the form for editing the specified safeguards.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $safeguards = $this->safeguardsRepository->find($id);
        }else{
            $safeguards = safeguards::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($safeguards)) {
            Flash::error('Resguardos no encontrado');

            return redirect(route('safeguards.index'));
        }

        return view('safeguards.edit')->with('safeguards', $safeguards);
    }

    /**
     * Update the specified safeguards in storage.
     *
     * @param int $id
     * @param UpdatesafeguardsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesafeguardsRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $safeguards = $this->safeguardsRepository->find($id);
        }else{
            $safeguards = safeguards::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($safeguards)) {
            Flash::error('Resguardos no encontrado');

            return redirect(route('safeguards.index'));
        }

        $safeguards = $this->safeguardsRepository->update($request->all(), $id);

        Flash::success('Resguardos Actualizado.');

        return redirect(route('safeguards.index'));
    }

    /**
     * Remove the specified safeguards from storage.
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
            $safeguards = $this->safeguardsRepository->find($id);
        }else{
            $safeguards = safeguards::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($safeguards)) {
            Flash::error('Resguardos no encontrado');

            return redirect(route('safeguards.index'));
        }

        $this->safeguardsRepository->delete($id);

        Flash::success('Resguardos Eliminado.');

        return redirect(route('safeguards.index'));
    }
}
