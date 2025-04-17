<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clients;
use App\Models\products;
use App\Models\salesItems;
use App\Models\sales;
use App\Models\repairs;
use App\Exports\ExportPlantilla;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;
use Excel;


class FacturaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    $query = sales::SELECT(DB::raw('clients.fullname as client_name,sales.total,sales.subtotal,sales.iva,sales.date,sales.id,sales.id_repara'))
                ->join('clients', 'sales.client_id', '=', 'clients.id')
                ->join('salesitems', 'salesitems.id_sale', '=', 'sales.id')
                ->leftJoin('products', 'products.id', '=', 'salesitems.id_product');

                   // Apply search filter if a search term is provided
    $search = $request->input('search');
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('clients.fullname', 'like', "%$search%")
                ->orWhere('sales.subtotal', 'like', "%$search%")
                ->orWhere('sales.id', 'like', "%$search%")
                // Add more columns to search here
                ->orWhere('sales.total', 'like', "%$search%");
        });
    }
    if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
        $sales = $query->distinct()->paginate(10);
   
    }else{
        $sales = $query->distinct()->where('sales.id_user_master', auth()->user()->id_user_master)->paginate(10);
        
    }
    $sales->appends($request->except('page')); // Preserve other query parameters when paginating

        $data = [
            'sales' => $sales,
            'search' => $search
        ];

        return view('factura.index', $data);
    }

    public function exportAllFacturaFecha(Request $request){
        $input=$request->all();
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $salesList = DB::table('sales')
            ->join('clients', 'sales.client_id', '=', 'clients.id')
            ->select('clients.fullname as client_name', 'sales.total', 'sales.subtotal','sales.id','sales.iva','sales.date',DB::raw('IF(sales.forma_pago = 1,"Efectivo",IF(sales.forma_pago = 2,"Tarjeta",IF(sales.forma_pago = 3,"Bizum",IF(sales.forma_pago = 4,"Transferencia","")))) as forma_pago'))
            ->where('sales.date','>=',$input['datestart'])->where('sales.date','<=',$input['dateend']." 23:59:59")->get();
       
        }else{
            $salesList = DB::table('sales')
            ->join('clients', 'sales.client_id', '=', 'clients.id')
            ->select('clients.fullname as client_name', 'sales.total', 'sales.subtotal','sales.id','sales.iva','sales.date',DB::raw('IF(sales.forma_pago = 1,"Efectivo",IF(sales.forma_pago = 2,"Tarjeta",IF(sales.forma_pago = 3,"Bizum",IF(sales.forma_pago = 4,"Transferencia","")))) as forma_pago'))
           ->where('sales.id_user_master', auth()->user()->id_user_master)
           ->where('sales.date','>=',$input['datestart'])->where('sales.date','<=',$input['dateend']." 23:59:59")->get();

        }
        $salesList->prepend([
            'cliente_nombre',
            'total',
            'subtotal',
            'numero_factura',
            'iva',
            'fecha',
            'forma_pago'
        ]);
        $export = new ExportPlantilla($salesList->toArray());
        return Excel::download($export,'facturas.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
