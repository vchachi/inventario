<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\RepairsExport;
use App\Models\categories;
use App\Models\clients;
use App\Models\repairs;
use App\Models\budgets;
use App\Models\user;
use App\Models\sales;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

                if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
                    $repairs =repairs::select('clients.fullname as client_name', 'categories.title as category_title', 'repairs.*')
                ->join('clients', 'repairs.client_id', '=', 'clients.id')
                ->join('categories', 'repairs.category_id', '=', 'categories.id')
                ->get();
                $latestBudget = budgets::select('clients.fullname as client_name', 'budgets.*')
                ->join('clients', 'budgets.client_id', '=', 'clients.id')
                ->latest('created_at')
                ->take(5)
                ->get();
                $latestSales = sales::select('clients.fullname as client_name', 'sales.*')
                ->join('clients', 'sales.client_id', '=', 'clients.id')
                ->whereNull('sales.id_repara')
                ->latest('created_at')
                ->take(5)
                ->get();
                $repairsTotal =repairs::count();
                $salesTotal =sales::whereNull('sales.id_repara')->count();
                $budgetsTotal =budgets::count();
                $clientsTotal =clients::count();
                
                }else{
                    $repairs =repairs::select('clients.fullname as client_name', 'categories.title as category_title', 'repairs.*')
                    ->join('clients', 'repairs.client_id', '=', 'clients.id')
                    ->join('categories', 'repairs.category_id', '=', 'categories.id')
                    ->where('repairs.id_user_master', auth()->user()->id_user_master)
                    ->get();
                    $latestBudget = budgets::select('clients.fullname as client_name', 'budgets.*')
                    ->join('clients', 'budgets.client_id', '=', 'clients.id')
                    ->where('budgets.id_user_master', auth()->user()->id_user_master)
                    ->latest('created_at')
                    ->take(5)
                    ->get();
                    $latestSales = sales::select('clients.fullname as client_name', 'sales.*')
                    ->join('clients', 'sales.client_id', '=', 'clients.id')
                    ->whereNull('sales.id_repara')
                    ->where('sales.id_user_master', auth()->user()->id_user_master)
                    ->latest('created_at')
                    ->take(5)
                    ->get();
                    $repairsTotal =repairs::where('id_user_master', auth()->user()->id_user_master)->count();
                    $salesTotal =sales::where('id_user_master', auth()->user()->id_user_master)->whereNull('sales.id_repara')->count();
                    $budgetsTotal =budgets::where('id_user_master', auth()->user()->id_user_master)->count();
                    $clientsTotal =clients::where('id_user_master', auth()->user()->id_user_master)->count();
                }
      
        $data = [
            'repairs' => $repairs,
            'latestBudget' => $latestBudget,
            'latestSales' => $latestSales,
            'repairsTotal'=>$repairsTotal,
            'salesTotal'=>$salesTotal,
            'clientsTotal'=>$clientsTotal,
            'budgetsTotal'=>$budgetsTotal
        ];
        return view('home', $data);
    }
}
