<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecategoriesRequest;
use App\Http\Requests\UpdatecategoriesRequest;
use App\Repositories\categoriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

use App\Models\categories;
use App\Exports\ExportPlantilla;
use App\Imports\ImportPlantilla;
use Flash;
use Excel;
use Response;

class categoriesController extends AppBaseController
{
    /** @var categoriesRepository $categoriesRepository*/
    private $categoriesRepository;

    public function __construct(categoriesRepository $categoriesRepo)
    {
        $this->middleware('auth');
        $this->categoriesRepository = $categoriesRepo;
    }

    /**
     * Display a listing of the categories.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categories = categories::SELECT('*')->get();
        }else{
            $categories = categories::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->get();
        }
        return view('categories.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new categories.
     *
     * @return Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created categories in storage.
     *
     * @param CreatecategoriesRequest $request
     *
     * @return Response
     */
    public function store(CreatecategoriesRequest $request)
    {
        $input = $request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
        $input['id_user_master']=auth()->user()->id_user_master;
        }
        $categories = $this->categoriesRepository->create($input);

        Flash::success('Categoria Guardada.');

        return redirect(route('categories.index'));
    }
    public function exportCSVFile(){
        $export = new ExportPlantilla([
            ['titulo']
        ]);
        return Excel::download($export,'categorias.csv', \Maatwebsite\Excel\Excel::CSV);
    }
    public function import(Request $request) {
        $import = new ImportPlantilla;
        Excel::import($import, $request->file('file'));
        $array = $import->getArray();
        foreach ($array as &$valor) {
            if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                $products = $this->categoriesRepository->create([
                    'title' => $valor[0][0],
                ] );
            }else{
                $products = $this->categoriesRepository->create([
                    'title' => $valor[0][0],
                    'id_user_master'=>auth()->user()->id_user_master,
                ] );
            }
      
        }
        return redirect(route('categories.index'));
    }
    /**
     * Display the specified categories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categories = $this->categoriesRepository->find($id);
        }else{
            $categories = categories::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }

        if (empty($categories)) {
            Flash::error('Categoria no encontrada');

            return redirect(route('categories.index'));
        }

        return view('categories.show')->with('categories', $categories);
    }

    /**
     * Show the form for editing the specified categories.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categories = $this->categoriesRepository->find($id);
        }else{
            $categories = categories::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($categories)) {
            Flash::error('Categoria no encontrada');

            return redirect(route('categories.index'));
        }

        return view('categories.edit')->with('categories', $categories);
    }

    /**
     * Update the specified categories in storage.
     *
     * @param int $id
     * @param UpdatecategoriesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategoriesRequest $request)
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $categories = $this->categoriesRepository->find($id);
        }else{
            $categories = categories::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($categories)) {
            Flash::error('Categoria no encontrada');

            return redirect(route('categories.index'));
        }

        $categories = $this->categoriesRepository->update($request->all(), $id);

        Flash::success('Categoria Actualizada.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified categories from storage.
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
            $categories = $this->categoriesRepository->find($id);
        }else{
            $categories = categories::SELECT('*')->where('id_user_master', auth()->user()->id_user_master)->where('id',$id)->firstOrFail();
        }
        if (empty($categories)) {
            Flash::error('Categoria no encontrada');

            return redirect(route('categories.index'));
        }

        $this->categoriesRepository->delete($id);

        Flash::success('Categoria Eliminada.');

        return redirect(route('categories.index'));
    }
}
