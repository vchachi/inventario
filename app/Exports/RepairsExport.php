<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\repairs;
use Maatwebsite\Excel\Concerns\FromCollection;

class RepairsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){
            $repairsList = DB::table('repairs')
            ->join('clients', 'repairs.client_id', '=', 'clients.id')
            ->join('categories', 'repairs.category_id', '=', 'categories.id')
            ->select('clients.fullname as client_name', 'categories.title as category_title', 'repairs.brand','repairs.model','repairs.imei_serie','repairs.repair_cost','repairs.concept','repairs.observations',DB::raw('IF(repairs.status = "1","Ingresado",IF(repairs.status = "2","Taller",IF(repairs.status = "3","Reparado",IF(repairs.status = "4","Irreparable","Entregado")))) as status'),'repairs.date')
            ->get();
        }else{
            $repairsList = DB::table('repairs')
            ->join('clients', 'repairs.client_id', '=', 'clients.id')
            ->join('categories', 'repairs.category_id', '=', 'categories.id')
            ->select('clients.fullname as client_name', 'categories.title as category_title', 'repairs.brand','repairs.model','repairs.imei_serie','repairs.repair_cost','repairs.concept','repairs.observations',DB::raw('IF(repairs.status = "1","Ingresado",IF(repairs.status = "2","Taller",IF(repairs.status = "3","Reparado",IF(repairs.status = "4","Irreparable","Entregado")))) as status'),'repairs.date')
            ->where('repairs.id_user_master', auth()->user()->id_user_master)
            ->get();
        }
 

        $repairsList->prepend([
            'cliente_nombre',
            'categoria_nombre',
            'marca',
            'modelo',
            'numero_serie',
            'coste_reparacion',
            'concepto',
            'observaciones',
            'estado',
            'fecha'
        ]);
        return $repairsList;
    }
}
