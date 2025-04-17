<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createinvoice_customRequest;
use App\Http\Requests\Updateinvoice_customRequest;
use App\Repositories\invoice_customRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class invoice_customController extends AppBaseController
{
    /** @var invoice_customRepository $invoiceCustomRepository*/
    private $invoiceCustomRepository;

    public function __construct(invoice_customRepository $invoiceCustomRepo)
    {
        $this->middleware('auth');
        $this->invoiceCustomRepository = $invoiceCustomRepo;
    }

    /**
     * Display a listing of the invoice_custom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $invoiceCustoms = $this->invoiceCustomRepository->all();

        return view('invoice_customs.index')
            ->with('invoiceCustoms', $invoiceCustoms);
    }

    /**
     * Show the form for creating a new invoice_custom.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoice_customs.create');
    }

    /**
     * Store a newly created invoice_custom in storage.
     *
     * @param Createinvoice_customRequest $request
     *
     * @return Response
     */
    public function store(Createinvoice_customRequest $request)
    {
        $input = $request->all();

        $invoiceCustom = $this->invoiceCustomRepository->create($input);

        Flash::success('Invoice Custom saved successfully.');

        return redirect(route('invoiceCustoms.index'));
    }

    /**
     * Display the specified invoice_custom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoiceCustom = $this->invoiceCustomRepository->find($id);

        if (empty($invoiceCustom)) {
            Flash::error('Invoice Custom not found');

            return redirect(route('invoiceCustoms.index'));
        }

        return view('invoice_customs.show')->with('invoiceCustom', $invoiceCustom);
    }

    /**
     * Show the form for editing the specified invoice_custom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoiceCustom = $this->invoiceCustomRepository->find($id);

        if (empty($invoiceCustom)) {
            Flash::error('Invoice Custom not found');

            return redirect(route('invoiceCustoms.index'));
        }

        return view('invoice_customs.edit')->with('invoiceCustom', $invoiceCustom);
    }

    /**
     * Update the specified invoice_custom in storage.
     *
     * @param int $id
     * @param Updateinvoice_customRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinvoice_customRequest $request)
    {
        $invoiceCustom = $this->invoiceCustomRepository->find($id);

        if (empty($invoiceCustom)) {
            Flash::error('Invoice Custom not found');

            return redirect(route('invoiceCustoms.index'));
        }

        $invoiceCustom = $this->invoiceCustomRepository->update($request->all(), $id);

        Flash::success('Invoice Custom updated successfully.');

        return redirect(route('invoiceCustoms.index'));
    }

    /**
     * Remove the specified invoice_custom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoiceCustom = $this->invoiceCustomRepository->find($id);

        if (empty($invoiceCustom)) {
            Flash::error('Invoice Custom not found');

            return redirect(route('invoiceCustoms.index'));
        }

        $this->invoiceCustomRepository->delete($id);

        Flash::success('Invoice Custom deleted successfully.');

        return redirect(route('invoiceCustoms.index'));
    }
}
