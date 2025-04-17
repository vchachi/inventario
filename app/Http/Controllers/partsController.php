<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepartsRequest;
use App\Http\Requests\UpdatepartsRequest;
use App\Repositories\partsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\parts;
use Flash;
use Response;

class partsController extends AppBaseController
{
    /** @var partsRepository $partsRepository*/
    private $partsRepository;

    public function __construct(partsRepository $partsRepo)
    {
        $this->middleware('auth');
        $this->partsRepository = $partsRepo;
    }

    /**
     * Display a listing of the parts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $parts = parts::select('parts.*');
 // Apply search filter if a search term is provided
 $search = $request->input('search');
 if (!empty($search)) {
     $parts->where(function ($q) use ($search) {
         $q->where('parts.name', 'like', "%$search%");
     });
 }
 $parts = $parts->distinct()->paginate(10);
 $parts->appends($request->except('page')); // Preserve other query parameters when paginating

 $data = [
     'parts' => $parts,
     'search' => $search
 ];

        return view('parts.index', $data);
    }

    /**
     * Show the form for creating a new parts.
     *
     * @return Response
     */
    public function create()
    {
        return view('parts.create');
    }

    /**
     * Store a newly created parts in storage.
     *
     * @param CreatepartsRequest $request
     *
     * @return Response
     */
    public function store(CreatepartsRequest $request)
    {
        $input = $request->all();
        $input['id_repara']=0;
        $input['active']=0;
        $input['url']='https://recambiostablet.com/buscar?controller=search&orderby=position&orderway=desc&search_query='.trim(trim(trim($input['name']))).'&submit_search=';

        $parts = $this->partsRepository->create($input);

        Flash::success('Pieza de Reparacion Guardada.');

        return redirect(route('parts.index'));
    }

    /**
     * Display the specified parts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $parts = $this->partsRepository->find($id);
        if (empty($parts)) {
            Flash::error('Pieza de Reparacion no encontrada');

            return redirect(route('parts.index'));
        }


        $data = [
            'parts' => $parts
        ];

        return view('parts.show', $data);
    }

    /**
     * Show the form for editing the specified parts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $parts = $this->partsRepository->find($id);
        if (empty($parts)) {
            Flash::error('Pieza de Reparacion no encontrada');

            return redirect(route('parts.index'));
        }


        $data = [
            'parts' => $parts,
        ];

        return view('parts.edit', $data);
    }

    /**
     * Update the specified parts in storage.
     *
     * @param int $id
     * @param UpdatepartsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepartsRequest $request)
    {
        $parts = $this->partsRepository->find($id);
        if (empty($parts)) {
            Flash::error('Pieza de Reparacion no encontrada');

            return redirect(route('parts.index'));
        }

        $parts = $this->partsRepository->update($request->all(), $id);

        Flash::success('Pieza de Reparacion actualizada.');

        return redirect(route('parts.index'));
    }

    /**
     * Remove the specified parts from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $parts = $this->partsRepository->find($id);
        if (empty($parts)) {
            Flash::error('Pieza de Reparacion no encontrada');

            return redirect(route('parts.index'));
        }

        $this->partsRepository->delete($id);

        Flash::success('Pieza de Reparacion eliminada.');

        return redirect(route('parts.index'));
    }
}
