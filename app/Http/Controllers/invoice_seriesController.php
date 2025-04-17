<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createinvoice_seriesRequest;
use App\Http\Requests\Updateinvoice_seriesRequest;
use App\Repositories\invoice_seriesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class invoice_seriesController extends AppBaseController
{
    /** @var invoice_seriesRepository $invoiceSeriesRepository*/
    private $invoiceSeriesRepository;

    public function __construct(invoice_seriesRepository $invoiceSeriesRepo)
    {
        $this->middleware('auth');
        $this->invoiceSeriesRepository = $invoiceSeriesRepo;
    }

    /**
     * Display a listing of the invoice_series.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $invoiceSeries = $this->invoiceSeriesRepository->all();

        return view('invoice_series.index')
            ->with('invoiceSeries', $invoiceSeries);
    }

    /**
     * Show the form for creating a new invoice_series.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoice_series.create');
    }

    /**
     * Store a newly created invoice_series in storage.
     *
     * @param Createinvoice_seriesRequest $request
     *
     * @return Response
     */
    public function store(Createinvoice_seriesRequest $request)
    {
        $input = $request->all();

        $invoiceSeries = $this->invoiceSeriesRepository->create($input);

        Flash::success('Invoice Series saved successfully.');

        return redirect(route('invoiceSeries.index'));
    }

    /**
     * Display the specified invoice_series.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoiceSeries = $this->invoiceSeriesRepository->find($id);

        if (empty($invoiceSeries)) {
            Flash::error('Invoice Series not found');

            return redirect(route('invoiceSeries.index'));
        }

        return view('invoice_series.show')->with('invoiceSeries', $invoiceSeries);
    }

    /**
     * Show the form for editing the specified invoice_series.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoiceSeries = $this->invoiceSeriesRepository->find($id);

        if (empty($invoiceSeries)) {
            Flash::error('Invoice Series not found');

            return redirect(route('invoiceSeries.index'));
        }

        return view('invoice_series.edit')->with('invoiceSeries', $invoiceSeries);
    }

    /**
     * Update the specified invoice_series in storage.
     *
     * @param int $id
     * @param Updateinvoice_seriesRequest $request
     *
     * @return Response
     */
    public function update($id, Updateinvoice_seriesRequest $request)
    {
        $invoiceSeries = $this->invoiceSeriesRepository->find($id);

        if (empty($invoiceSeries)) {
            Flash::error('Invoice Series not found');

            return redirect(route('invoiceSeries.index'));
        }

        $invoiceSeries = $this->invoiceSeriesRepository->update($request->all(), $id);

        Flash::success('Invoice Series updated successfully.');

        return redirect(route('invoiceSeries.index'));
    }

    /**
     * Remove the specified invoice_series from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoiceSeries = $this->invoiceSeriesRepository->find($id);

        if (empty($invoiceSeries)) {
            Flash::error('Invoice Series not found');

            return redirect(route('invoiceSeries.index'));
        }

        $this->invoiceSeriesRepository->delete($id);

        Flash::success('Invoice Series deleted successfully.');

        return redirect(route('invoiceSeries.index'));
    }
}
