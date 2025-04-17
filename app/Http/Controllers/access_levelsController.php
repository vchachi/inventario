<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createaccess_levelsRequest;
use App\Http\Requests\Updateaccess_levelsRequest;
use App\Repositories\access_levelsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class access_levelsController extends AppBaseController
{
    /** @var access_levelsRepository $accessLevelsRepository*/
    private $accessLevelsRepository;

    public function __construct(access_levelsRepository $accessLevelsRepo)
    {
        $this->middleware('auth');
        $this->accessLevelsRepository = $accessLevelsRepo;
    }

    /**
     * Display a listing of the access_levels.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $accessLevels = $this->accessLevelsRepository->all();

        return view('access_levels.index')
            ->with('accessLevels', $accessLevels);
    }

    /**
     * Show the form for creating a new access_levels.
     *
     * @return Response
     */
    public function create()
    {
        return view('access_levels.create');
    }

    /**
     * Store a newly created access_levels in storage.
     *
     * @param Createaccess_levelsRequest $request
     *
     * @return Response
     */
    public function store(Createaccess_levelsRequest $request)
    {
        $input = $request->all();

        $accessLevels = $this->accessLevelsRepository->create($input);

        Flash::success('Nivel de Acceso Guardado.');

        return redirect(route('accessLevels.index'));
    }

    /**
     * Display the specified access_levels.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accessLevels = $this->accessLevelsRepository->find($id);

        if (empty($accessLevels)) {
            Flash::error('Nivel de Acceso no encontrado');

            return redirect(route('accessLevels.index'));
        }

        return view('access_levels.show')->with('accessLevels', $accessLevels);
    }

    /**
     * Show the form for editing the specified access_levels.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accessLevels = $this->accessLevelsRepository->find($id);

        if (empty($accessLevels)) {
            Flash::error('Nivel de Acceso no encontrado');

            return redirect(route('accessLevels.index'));
        }

        return view('access_levels.edit')->with('accessLevels', $accessLevels);
    }

    /**
     * Update the specified access_levels in storage.
     *
     * @param int $id
     * @param Updateaccess_levelsRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaccess_levelsRequest $request)
    {
        $accessLevels = $this->accessLevelsRepository->find($id);

        if (empty($accessLevels)) {
            Flash::error('Nivel de Acceso no encontrado');

            return redirect(route('accessLevels.index'));
        }

        $accessLevels = $this->accessLevelsRepository->update($request->all(), $id);

        Flash::success('Nivel de Acceso Actualizado.');

        return redirect(route('accessLevels.index'));
    }

    /**
     * Remove the specified access_levels from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accessLevels = $this->accessLevelsRepository->find($id);

        if (empty($accessLevels)) {
            Flash::error('Nivel de Acceso no encontrado');

            return redirect(route('accessLevels.index'));
        }

        $this->accessLevelsRepository->delete($id);

        Flash::success('Nivel de Acceso Eliminado.');

        return redirect(route('accessLevels.index'));
    }
}
