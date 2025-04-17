<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesuscriptionsRequest;
use App\Http\Requests\UpdatesuscriptionsRequest;
use App\Repositories\suscriptionsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class suscriptionsController extends AppBaseController
{
    /** @var suscriptionsRepository $suscriptionsRepository*/
    private $suscriptionsRepository;

    public function __construct(suscriptionsRepository $suscriptionsRepo)
    {
        $this->middleware('auth');
        $this->suscriptionsRepository = $suscriptionsRepo;
    }

    /**
     * Display a listing of the suscriptions.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $suscriptions = $this->suscriptionsRepository->all();

        return view('suscriptions.index')
            ->with('suscriptions', $suscriptions);
    }

    /**
     * Show the form for creating a new suscriptions.
     *
     * @return Response
     */
    public function create()
    {
        return view('suscriptions.create');
    }

    /**
     * Store a newly created suscriptions in storage.
     *
     * @param CreatesuscriptionsRequest $request
     *
     * @return Response
     */
    public function store(CreatesuscriptionsRequest $request)
    {
        $input = $request->all();

        $suscriptions = $this->suscriptionsRepository->create($input);

        Flash::success('Suscriptions saved successfully.');

        return redirect(route('suscriptions.index'));
    }

    /**
     * Display the specified suscriptions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $suscriptions = $this->suscriptionsRepository->find($id);

        if (empty($suscriptions)) {
            Flash::error('Suscriptions not found');

            return redirect(route('suscriptions.index'));
        }

        return view('suscriptions.show')->with('suscriptions', $suscriptions);
    }

    /**
     * Show the form for editing the specified suscriptions.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $suscriptions = $this->suscriptionsRepository->find($id);

        if (empty($suscriptions)) {
            Flash::error('Suscriptions not found');

            return redirect(route('suscriptions.index'));
        }

        return view('suscriptions.edit')->with('suscriptions', $suscriptions);
    }

    /**
     * Update the specified suscriptions in storage.
     *
     * @param int $id
     * @param UpdatesuscriptionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesuscriptionsRequest $request)
    {
        $suscriptions = $this->suscriptionsRepository->find($id);

        if (empty($suscriptions)) {
            Flash::error('Suscriptions not found');

            return redirect(route('suscriptions.index'));
        }

        $suscriptions = $this->suscriptionsRepository->update($request->all(), $id);

        Flash::success('Suscriptions updated successfully.');

        return redirect(route('suscriptions.index'));
    }

    /**
     * Remove the specified suscriptions from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $suscriptions = $this->suscriptionsRepository->find($id);

        if (empty($suscriptions)) {
            Flash::error('Suscriptions not found');

            return redirect(route('suscriptions.index'));
        }

        $this->suscriptionsRepository->delete($id);

        Flash::success('Suscriptions deleted successfully.');

        return redirect(route('suscriptions.index'));
    }
}
