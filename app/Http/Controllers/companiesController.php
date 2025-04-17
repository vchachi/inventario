<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecompaniesRequest;
use App\Http\Requests\UpdatecompaniesRequest;
use App\Repositories\companiesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\companies;
use Illuminate\Support\Facades\Storage;


class companiesController extends AppBaseController
{
    /** @var companiesRepository $companiesRepository*/
    private $companiesRepository;

    public function __construct(companiesRepository $companiesRepo)
    {
        $this->middleware('auth');
        $this->companiesRepository = $companiesRepo;
    }

    /**
     * Display a listing of the companies.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $companies = companies::SELECT('*')->get();
        }else{
            $companies = companies::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }

        return view('companies.index')
            ->with('companies', $companies);
    }

    /**
     * Show the form for creating a new companies.
     *
     * @return Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created companies in storage.
     *
     * @param CreatecompaniesRequest $request
     *
     * @return Response
     */
    public function store(CreatecompaniesRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('public/logo');
            $input['logo']=$path;
        }
        if(!isset($input['website'])){
            $input['website']='';
        }
        $companies = $this->companiesRepository->create($input);

        Flash::success('Empresa Guardada.');

        return redirect(route('companies.index'));
    }

    /**
     * Display the specified companies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $companies = $this->companiesRepository->find($id);
        }else{
            $companies = companies::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($companies)) {
            Flash::error('Empresa no encontrada');

            return redirect(route('companies.index'));
        }

        return view('companies.show')->with('companies', $companies);
    }

    /**
     * Show the form for editing the specified companies.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $companies = $this->companiesRepository->find($id);
        }else{
            $companies = companies::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($companies)) {
            Flash::error('Empresa no encontrada');

            return redirect(route('companies.index'));
        }

        return view('companies.edit')->with('companies', $companies);
    }

    /**
     * Update the specified companies in storage.
     *
     * @param int $id
     * @param UpdatecompaniesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecompaniesRequest $request)
    {
        $input=$request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $companies = $this->companiesRepository->find($id);
        }else{
            $companies = companies::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($companies)) {
            Flash::error('Empresa no encontrada');

            return redirect(route('companies.index'));
        }
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('public/logo');
            $input['logo']=$path;
            Storage::delete($companies->logo);
        }else{
            $input['logo']=$companies->logo;
        }
        $companies = $this->companiesRepository->update( $input, $id);

        Flash::success('Empresa Actualizada.');

        return redirect(route('companies.index'));
    }

    /**
     * Remove the specified companies from storage.
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
            $companies = $this->companiesRepository->find($id);
        }else{
            $companies = companies::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        
        if (empty($companies)) {
            Flash::error('Empresa no encontrada');

            return redirect(route('companies.index'));
        }

        $this->companiesRepository->delete($id);

        Flash::success('Empresa Eliminada.');

        return redirect(route('companies.index'));
    }
}
