<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\sales;
use App\Models\clients;
use App\Models\User;
use App\Models\products;
use App\Models\categories;
class EstadisticasController extends Controller
{
    public function index(Request $request)
    {
        return view('estadisticas.index');
    }
    public function earnings(Request $request)
    {
        $input = $request->all();

        $ingresos=sales::SELECT(DB::raw('SUM(sales.subtotal) as Total_Vendido,AVG(sales.subtotal) as promedio'));
        $clientes=clients::SELECT(DB::raw('COUNT(clients.id) as ContadoCliente'));
        $clientesCompran=sales::SELECT(DB::raw('COUNT(sales.client_id) as ClientesCompra'));
   
        $textoSQL="DAYNAME(sales.date) as DIA, ";
        for ($i = 8;$i<24 ; $i++) {
            if ($i == 8) {
                $textoSQL=$textoSQL." IF((time(sales.date)>='00:00:00' AND time(sales.date)<'09:00:00'),'08:00:00' ,";
            }else if($i==9){
                $textoSQL=$textoSQL." IF((time(sales.date)>='09:00:00' AND time(sales.date)<'10:00:00'),'09:00:00' ,";
            }else if($i==23){
                $textoSQL=$textoSQL." IF((time(sales.date)>='23:00:00' AND time(sales.date)<'24:00:00'),'23:00:00' ,'24:00:00') ";
            }else{
                $textoSQL=$textoSQL." IF((time(sales.date)>='".$i.":00:00' AND time(sales.date)<'".($i+1).":00:00'),'".$i.":00:00' ,";          
            }
        }
        for ($i = 8;$i<23 ; $i++) {
            $textoSQL= $textoSQL.")";
        }
        $textoSQL=$textoSQL." as Hora,SUM(sales.subtotal) as Total";
        $totalComprasMapa=sales::SELECT(DB::raw($textoSQL))->groupBy('DIA','HORA');
        if(isset($input['dateFrom'])){
            $ingresos=$ingresos->where('sales.date','>=',$input['dateFrom']);
            $clientesCompran=$clientesCompran->where('sales.date','>=',$input['dateFrom']);
            $totalComprasMapa=   $totalComprasMapa->where('sales.date','>=',$input['dateFrom']);
        }
        if(isset($input['dateTo'])){
            $ingresos=$ingresos->where('sales.date','<=',$input['dateTo']);
            $clientesCompran=$clientesCompran->where('sales.date','<=',$input['dateTo']);
            $totalComprasMapa=   $totalComprasMapa->where('sales.date','<=',$input['dateTo']);
        }
        if(isset($input['Fuente'])){
            if($input['Fuente']==1){
                $ingresos=$ingresos->where('sales.id_repara','>',0);
                $clientesCompran=$clientesCompran->where('sales.id_repara','>',0);
                $totalComprasMapa=$totalComprasMapa->where('sales.id_repara','>',0);
            }else if ($input['Fuente']==2){
                $ingresos=$ingresos->whereNull('sales.id_repara');
                $clientesCompran=$clientesCompran->whereNull('sales.id_repara');
                $totalComprasMapa=$totalComprasMapa->whereNull('sales.id_repara');
            }
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            
            $ingresos=$ingresos->where('sales.id_user_master', auth()->user()->id_user_master);
            $clientesCompran=$clientesCompran->where('sales.id_user_master', auth()->user()->id_user_master);
            $totalComprasMapa=$totalComprasMapa->where('sales.id_user_master', auth()->user()->id_user_master);
            $clientes=  $clientes->where('id_user_master', auth()->user()->id_user_master);
        }


        $clientes=$clientes->get();
        $ingresos=$ingresos->get();
        $clientesCompran=$clientesCompran->get();
        $totalComprasMapa=$totalComprasMapa->get();


        $mediacliente=0;
        if($clientes[0]->ContadoCliente>0){
            $mediacliente=round($clientesCompran[0]->ClientesCompra/$clientes[0]->ContadoCliente, 2);
        }

        $arregloDeLavista=array(array());
        $arrayIDHoras=array();
        $ArrayDias=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
  
        for ($i = 0;$i<16 ; $i++) {
            $numero=(24-(16-$i));
            if ( $numero == 8) {
                $arrayIDHoras[$i]='08:00:00';
            }else if($numero==9){
                $arrayIDHoras[$i]='09:00:00';
            }else if($numero==23){
                $arrayIDHoras[$i]='23:00:00';
            }else{
                $arrayIDHoras[$i]=''.$numero.':00:00';           
             }
        }
        for ($i = 0;$i<17 ; $i++) {
            for ($j = 0;$j<8 ; $j++) {
                $datoFinalColumna=false;
                $datoFinalFila=false;
                if($i==16){
                    $datoFinalColumna=true;
                }
                if($j==7){
                    $datoFinalFila=true;
                }
                $arregloDeLavista[$i][$j]=[
                    'valor'=>0,
                    'spanColumna'=>$datoFinalColumna,
                    'spanFila'=> $datoFinalFila
                ];
            }
        }
        foreach ($totalComprasMapa as &$valor) {
            $idDia = array_search($valor->DIA,$ArrayDias);
            $idHora = array_search($valor->Hora,$arrayIDHoras);
            $arregloDeLavista[$idHora][$idDia]['valor']=$valor->Total;
        }
        for ($i = 0;$i<16 ; $i++) {
            $suma=0;
            for ($j = 0;$j<8 ; $j++) {
                if($j==7){
                   $arregloDeLavista[$i][$j]['valor']=$suma;
                }else{
                $suma+=$arregloDeLavista[$i][$j]['valor'];
                }
            
            }
        }
        for ($j = 0;$j<8 ; $j++) {
            $suma=0;
            for ($i = 0;$i<17 ; $i++) {
                if($i==16){
                   $arregloDeLavista[$i][$j]['valor']=$suma;
                   if($suma>0){
                    $arregloDeLavista[$i][$j]['porcentaje']=100;
                   }else{
                    $arregloDeLavista[$i][$j]['porcentaje']=0;
                   }
                }else{
                $suma+=$arregloDeLavista[$i][$j]['valor'];
                }
            
            }
        }
        for ($j = 0;$j<8 ; $j++) {
            for ($i = 0;$i<16 ; $i++) {
                $arregloDeLavista[$i][$j]['porcentaje']=0;
                if($arregloDeLavista[16][$j]['porcentaje']>0){
                    if($arregloDeLavista[$i][$j]['valor']>0){
                        $arregloDeLavista[$i][$j]['porcentaje']=round(($arregloDeLavista[$i][$j]['valor']*100)/$arregloDeLavista[16][$j]['valor']);
                    }
                }
            }
        }

    return view('estadisticas.earnings')
        ->with('ingresos',$ingresos)->with('clientecontrdo',  $clientes)
        ->with('mediacliente',$mediacliente)
        ->with('arregloDeLavista',$arregloDeLavista)
        ->with('input',$input);
    } 


    public function performance(Request $request)
    {
        $input = $request->all();
        $userOption=User::SELECT('*');
        $totalVentasSinReparaciones=sales::SELECT(DB::raw('COUNT(sales.id) as NumeroVentas'));   
        $totalVentasSinReparaciones2=sales::SELECT(DB::raw('SUM(sales.subtotal) as Totalvendido'));  
        $totalVentasSinReparaciones3=sales::SELECT(DB::raw('SUM(salesitems.amount) as TotalCantidad'))
        ->leftjoin('salesitems','salesitems.id_sale','=','sales.id'); 
        $totalVentasRepara=sales::SELECT(DB::raw('COUNT(sales.id) as NumeroReparaciones')); 
        $totalVentasRepara2=sales::SELECT(DB::raw('SUM(sales.subtotal) as totalrepara')); 
        $tecnicoRepara=sales::SELECT(DB::raw('users.name as nombre,count(sales.id) as cuenta ,SUM(sales.subtotal) as totalrepara'))
        ->join('users','users.id','=','sales.user_created')
        ->groupBy('users.name');
        $Dependientes=sales::SELECT(DB::raw('users.name,SUM(IF(sales.id_repara IS NULL,1,0)) as NumeroVentas,SUM(IF(sales.id_repara IS NULL,0,1)) as NumeroRepara,SUM(busqueda.cantidad) as CantidadArticulos,SUM(IF(sales.id_repara IS NULL,sales.subtotal,0)) as TotalVenta,SUM(IF(sales.id_repara IS NULL,0,sales.subtotal)) as TotalRepara'))
        ->leftjoin(DB::raw('(SELECT sum(salesitems.amount) as cantidad,salesitems.id_sale from salesitems group by salesitems.id_sale) as busqueda'),'busqueda.id_sale','=','sales.id')
        ->join('users','users.id','=','sales.user_created')
        ->groupBy('users.name');
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            $userOption=$userOption->where('users.id_user_master', auth()->user()->id_user_master);
            $totalVentasSinReparaciones=$totalVentasSinReparaciones->where('sales.id_user_master', auth()->user()->id_user_master);
            $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->where('sales.id_user_master', auth()->user()->id_user_master);
            $totalVentasSinReparaciones3=$totalVentasSinReparaciones3->where('sales.id_user_master', auth()->user()->id_user_master);
            $Dependientes= $Dependientes->where('sales.id_user_master', auth()->user()->id_user_master);
            $totalVentasRepara=$totalVentasRepara->where('sales.id_user_master', auth()->user()->id_user_master);
            $totalVentasRepara2=$totalVentasRepara2->where('sales.id_user_master', auth()->user()->id_user_master);
            $tecnicoRepara= $tecnicoRepara->where('sales.id_user_master', auth()->user()->id_user_master);
        }

        if(isset($input['dateFrom'])){ 
            $totalVentasSinReparaciones=$totalVentasSinReparaciones->where('sales.date','>=',$input['dateFrom']);
            $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->where('sales.date','>=',$input['dateFrom']);
            $totalVentasSinReparaciones3=$totalVentasSinReparaciones3->where('sales.date','>=',$input['dateFrom']);
            $Dependientes=$Dependientes->where('sales.date','>=',$input['dateFrom']);
            $totalVentasRepara=$totalVentasRepara->where('sales.date','>=',$input['dateFrom']);
            $totalVentasRepara2=$totalVentasRepara2->where('sales.date','>=',$input['dateFrom']);
            $tecnicoRepara=$tecnicoRepara->where('sales.date','>=',$input['dateFrom']);
        }
        if(isset($input['dateTo'])){
            $totalVentasSinReparaciones=$totalVentasSinReparaciones->where('sales.date','<=',$input['dateTo']);
            $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->where('sales.date','<=',$input['dateTo']);
            $totalVentasSinReparaciones3=   $totalVentasSinReparaciones3->where('sales.date','<=',$input['dateTo']);
            $Dependientes=   $Dependientes->where('sales.date','<=',$input['dateTo']);
            $totalVentasRepara=   $totalVentasRepara->where('sales.date','<=',$input['dateTo']);
            $totalVentasRepara2=   $totalVentasRepara2->where('sales.date','<=',$input['dateTo']);
            $tecnicoRepara=   $tecnicoRepara->where('sales.date','<=',$input['dateTo']);
        }

        if(isset($input['user_id'])){
            $totalVentasSinReparaciones=$totalVentasSinReparaciones->where('sales.user_created','=',$input['user_id']);
            $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->where('sales.user_created','=',$input['user_id']);
            $totalVentasSinReparaciones3=   $totalVentasSinReparaciones3->where('sales.user_created','=',$input['user_id']);
            $Dependientes=   $Dependientes->where('sales.user_created','=',$input['user_id']);
            $totalVentasRepara=   $totalVentasRepara->where('sales.user_created','=',$input['user_id']);
            $totalVentasRepara2=   $totalVentasRepara2->where('sales.user_created','=',$input['user_id']);
            $tecnicoRepara=   $tecnicoRepara->where('sales.user_created','=',$input['user_id']);
        }

        $totalVentasSinReparaciones=$totalVentasSinReparaciones->whereNull('sales.id_repara');
        $totalVentasSinReparaciones=$totalVentasSinReparaciones->distinct();
        $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->whereNull('sales.id_repara');
        $totalVentasSinReparaciones3=$totalVentasSinReparaciones3->whereNull('sales.id_repara');
        $totalVentasRepara=$totalVentasRepara->whereNotNull('sales.id_repara');
        $totalVentasRepara2=$totalVentasRepara2->whereNotNull('sales.id_repara');
        $tecnicoRepara= $tecnicoRepara->whereNotNull('sales.id_repara');

        $totalVentasSinReparaciones=$totalVentasSinReparaciones->get();
        $totalVentasSinReparaciones2=$totalVentasSinReparaciones2->get();
        $totalVentasSinReparaciones3=$totalVentasSinReparaciones3->get();
        $Dependientes= $Dependientes->get();

        $totalVentasRepara=$totalVentasRepara->get();
        $totalVentasRepara2=$totalVentasRepara2->get();
        $tecnicoRepara= $tecnicoRepara->get();
        $userOption=$userOption->get();

     return view('estadisticas.performance')
     ->with('totalVentasSinReparaciones',$totalVentasSinReparaciones)
     ->with('totalVentasSinReparaciones2',$totalVentasSinReparaciones2)
     ->with('totalVentasSinReparaciones3',$totalVentasSinReparaciones3)
     ->with('totalVentasRepara',$totalVentasRepara)
     ->with('tecnicoRepara', $tecnicoRepara)
     ->with('Dependientes',$Dependientes)
     ->with('totalVentasRepara2',$totalVentasRepara2)
     ->with('input',$input)
     ->with('userOption',$userOption);
    }


    public function products(Request $request)
    {
        $input = $request->all();

        $productosOption=products::SELECT('*');
        $categoriaOption=categories::SELECT('*');
        $cantidadProductos=products::SELECT(DB::raw('products.title as NombreProducto,SUM(salesitems.subtotal) as Totalvendido,SUM(salesitems.amount) as TotalCantidad'))
        ->leftjoin('salesitems','salesitems.id_product','=','products.id')        
        ->join('sales','sales.id','=','salesitems.id_sale')     
        ->leftjoin('categories','categories.id','=','products.category_id')
        ->groupBy('products.title');
        $TotalUnidades=products::SELECT(DB::raw('SUM(salesitems.subtotal) as Totalvendido,SUM(salesitems.amount) as TotalCantidad'))
        ->join('salesitems','salesitems.id_product','=','products.id') 
        ->leftjoin('categories','categories.id','=','products.category_id')       
        ->join('sales','sales.id','=','salesitems.id_sale');
        if(isset($input['productos_id'])){
            $cantidadProductos=$cantidadProductos->where('products.id','=',$input['productos_id']);
            $TotalUnidades=   $TotalUnidades->where('products.id','>=',$input['productos_id']);
        }  
        if(isset($input['categoria_id'])){
            $cantidadProductos=$cantidadProductos->where('categories.id','=',$input['categoria_id']);
            $TotalUnidades=   $TotalUnidades->where('categories.id','>=',$input['categoria_id']);
        }  
        if(isset($input['dateFrom'])){
            $cantidadProductos=$cantidadProductos->where('sales.date','>=',$input['dateFrom']);
            $TotalUnidades=$TotalUnidades->where('sales.date','>=',$input['dateFrom']);
        }
        if(isset($input['dateTo'])){
            $cantidadProductos=$cantidadProductos->where('sales.date','<=',$input['dateTo']);
            $TotalUnidades=$TotalUnidades->where('sales.date','<=',$input['dateTo']);
        }
        if(isset($input['product_order'])){
            if($input['product_order']=="1"){
                $cantidadProductos=$cantidadProductos->orderByRaw('TotalCantidad DESC');
            }
            if($input['product_order']=="2"){
                $cantidadProductos=$cantidadProductos->orderByRaw('Totalvendido DESC');
            }
            if($input['product_order']=="3"){
                $cantidadProductos=$cantidadProductos->orderByRaw('NombreProducto ASC');
            }
        }
        if(auth()->user()->id_user_master==0 && auth()->user()->is_master==true){

        }else{
            
            $productosOption=$productosOption->where('products.id_user_master', auth()->user()->id_user_master);
            $categoriaOption=$categoriaOption->where('categories.id_user_master', auth()->user()->id_user_master);
            $cantidadProductos=$cantidadProductos->where('products.id_user_master', auth()->user()->id_user_master);
            $TotalUnidades=  $TotalUnidades->where('products.id_user_master', auth()->user()->id_user_master);
        }
        $productosOption=$productosOption->get();
        $categoriaOption=$categoriaOption->get();
        $cantidadProductos=$cantidadProductos->get();
        $TotalUnidades=$TotalUnidades->get();

        return view('estadisticas.products')
        ->with('productosOption',$productosOption)
        ->with('categoriaOption',$categoriaOption)
        ->with('cantidadProductos', $cantidadProductos)
        ->with('TotalUnidades',$TotalUnidades)
        ->with('input',$input);
    }
}
