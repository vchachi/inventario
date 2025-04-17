<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatewarrantiesRequest;
use App\Http\Requests\UpdatewarrantiesRequest;
use App\Repositories\warrantiesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\warranties;

class warrantiesController extends AppBaseController
{
    /** @var warrantiesRepository $warrantiesRepository*/
    private $warrantiesRepository;

    public function __construct(warrantiesRepository $warrantiesRepo)
    {
        $this->warrantiesRepository = $warrantiesRepo;
    }

    /**
     * Display a listing of the warranties.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $warranties = warranties::SELECT('*')->get();
        }else{
            $warranties = warranties::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }
    

        return view('warranties.index')
            ->with('warranties', $warranties);
    }

    /**
     * Show the form for creating a new warranties.
     *
     * @return Response
     */
    public function create()
    {
        return view('warranties.create');
    }

    /**
     * Store a newly created warranties in storage.
     *
     * @param CreatewarrantiesRequest $request
     *
     * @return Response
     */
    public function store(CreatewarrantiesRequest $request)
    {
      
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        $warranties = $this->warrantiesRepository->create($input);

        Flash::success('Garantías Guardada.');

        return redirect(route('warranties.index'));
    }

    /**
     * Display the specified warranties.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $warranties = $this->warrantiesRepository->find($id);
        }else{
            $warranties = warranties::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }

        if (empty($warranties)) {
            Flash::error('Garantías no encontrado');

            return redirect(route('warranties.index'));
        }

        return view('warranties.show')->with('warranties', $warranties);
    }

    /**
     * Show the form for editing the specified warranties.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $warranties = $this->warrantiesRepository->find($id);
        }else{
            $warranties = warranties::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($warranties)) {
            Flash::error('Garantías no encontrado');

            return redirect(route('warranties.index'));
        }

        return view('warranties.edit')->with('warranties', $warranties);
    }

    /**
     * Update the specified warranties in storage.
     *
     * @param int $id
     * @param UpdatewarrantiesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatewarrantiesRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $warranties = $this->warrantiesRepository->find($id);
        }else{
            $warranties = warranties::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($warranties)) {
            Flash::error('Garantías no encontrado');

            return redirect(route('warranties.index'));
        }

        $warranties = $this->warrantiesRepository->update($request->all(), $id);

        Flash::success('Garantías actualizada.');

        return redirect(route('warranties.index'));
    }

    /**
     * Remove the specified warranties from storage.
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
            $warranties = $this->warrantiesRepository->find($id);
        }else{
            $warranties = warranties::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($warranties)) {
            Flash::error('Garantías no encontrado');

            return redirect(route('warranties.index'));
        }

        $this->warrantiesRepository->delete($id);

        Flash::success('Garantías eliminada.');

        return redirect(route('warranties.index'));
    }
}
