<?php

namespace App\Http\Controllers;

use App\Models\sales;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Models\clients;
use App\Models\products;
use App\Models\salesItems;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;

class DocumentGeneController extends Controller
{
    //
    public function showticketfactura($id,$tipo)
    {
      $this->middleware('auth');
        $sales =sales::find($id);

        if (empty($sales)) {
            Flash::error('No existe la factura');
            return redirect(route('home'));
        }
        
        $clientsOption = clients::find($sales->client_id);
        $itemsCliente = salesItems::select(DB::raw('salesitems.*,products.title,repairs.concept '))
        ->leftjoin('sales', 'sales.id', '=', 'salesitems.id_sale')
        ->leftjoin('products', 'salesitems.id_product', '=', 'products.id')
        ->leftjoin('repairs', 'repairs.id', '=',  'sales.id_repara')
        ->where('salesitems.id_sale',$sales->id)->get();
        if(isset(auth()->user()->empresas->socialname)){
          $datoEmpresa=[
            'empresa'=>auth()->user()->empresas->socialname,
            'NIF'=>auth()->user()->empresas->CIFNIF,
            'direccion'=>auth()->user()->empresas->address,
            'codigopostal'=>auth()->user()->empresas->postal_code,
            'provincia'=>auth()->user()->empresas->provincia,
            'ciudad'=>auth()->user()->empresas->localidad,
            'pais'=>auth()->user()->empresas->country,
            'tel'=>auth()->user()->empresas->phone,
            'web'=>auth()->user()->empresas->website,
            'email'=>auth()->user()->empresas->email,
            'image'=>storage_path().'/app/'.auth()->user()->empresas->logo,
          ];
        }else{
          $datoEmpresa=[
            'empresa'=>'',
            'NIF'=>'',
            'direccion'=>'',
            'codigopostal'=>'',
            'provincia'=>'',
            'ciudad'=>'',
            'pais'=>'',
            'tel'=>'',
            'web'=>'',
            'email'=>'',
            'image'=>public_path()."/images/logo.png",
          ];
        }
          $data = [
            'clientsOption' => $clientsOption,
            'sales' => $sales,
            'empresa'=>$datoEmpresa,
            'productos'=>$itemsCliente
        ];
        if($tipo==1){
          $pdf = PDF::loadView('documents.showticketsimpli',$data);
        }else if($tipo==2){
          $pdf = PDF::loadView('documents.showticketrect',$data);
        }else{
          $pdf = PDF::loadView('documents.showticket',$data);
        }
        $customPaper = array(0,0,170.079,792);
        $pdf->setPaper($customPaper);
        return $pdf->stream(
            'file.pdf',
            array(
              'Attachment' => 0
            )
          );
        /*$
        return $pdf->download('ticketfact.pdf');*/
    }
    public function showfactura1($id,$tipo)
    {
        $sales =sales::find($id);

        if (empty($sales)) {
            Flash::error('No existe la factura');
            return redirect(route('home'));
        }
        
        $clientsOption = clients::find($sales->client_id);
        $itemsCliente = salesItems::select(DB::raw('salesitems.*,products.title,repairs.concept '))
        ->leftjoin('sales', 'sales.id', '=', 'salesitems.id_sale')
        ->leftjoin('products', 'salesitems.id_product', '=', 'products.id')
        ->leftjoin('repairs', 'repairs.id', '=',  'sales.id_repara')
        ->where('salesitems.id_sale',$sales->id)->get();
        if(isset(auth()->user()->empresas->socialname)){
          $datoEmpresa=[
            'empresa'=>auth()->user()->empresas->socialname,
            'NIF'=>auth()->user()->empresas->CIFNIF,
            'direccion'=>auth()->user()->empresas->address,
            'codigopostal'=>auth()->user()->empresas->postal_code,
            'provincia'=>auth()->user()->empresas->provincia,
            'ciudad'=>auth()->user()->empresas->localidad,
            'pais'=>auth()->user()->empresas->country,
            'tel'=>auth()->user()->empresas->phone,
            'web'=>auth()->user()->empresas->website,
            'email'=>auth()->user()->empresas->email,
            'image'=>storage_path().'/app/'.auth()->user()->empresas->logo,
          ];
        }else{
          $datoEmpresa=[
            'empresa'=>'',
            'NIF'=>'',
            'direccion'=>'',
            'codigopostal'=>'',
            'provincia'=>'',
            'ciudad'=>'',
            'pais'=>'',
            'tel'=>'',
            'web'=>'',
            'email'=>'',
            'image'=>public_path()."/images/logo.png",
          ];
        }
          $data = [
            'clientsOption' => $clientsOption,
            'sales' => $sales,
            'image'=>public_path()."/images/logo.png",
            'imagegps'=>public_path()."/images/gps.png",
            'imageworld'=>public_path()."/images/world.png",
            'imagephone'=>public_path()."/images/phone.png",
            'productos'=>$itemsCliente,
            'empresa'=> $datoEmpresa
        ];
        if($tipo==1){
          $pdf = PDF::loadView('documents.facturaa4simplificada',$data);
        }else if($tipo==2){
          $pdf = PDF::loadView('documents.facturaa4rectificacion',$data);
        }else{
          $pdf = PDF::loadView('documents.facturaa4',$data);
        }
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream(
            'file.pdf',
            array(
              'Attachment' => 0
            )
          );
        /*$
        return $pdf->download('ticketfact.pdf');*/
    }
    public function documentsglobal(Request $request){
        $input = $request->all();

        $sales =sales::select(DB::raw('sales.*,sales.id as saleid,clients.*'))
        ->leftjoin('clients', 'clients.id', '=', 'sales.client_id')
        ->where('sales.date','>=',$input['datestart'])->where('sales.date','<=',$input['dateend']." 23:59:59")->get();

        $itemsCliente = salesItems::select(DB::raw('salesitems.*,products.title,repairs.concept'))
        ->leftjoin('sales', 'sales.id', '=', 'salesitems.id_sale')
        ->leftjoin('products', 'salesitems.id_product', '=', 'products.id')
        ->leftjoin('repairs', 'repairs.id', '=',  'sales.id_repara')
        ->where('sales.date','>=',$input['datestart'])->where('sales.date','<=',$input['dateend']." 23:59:59")->get();
       
        if(isset(auth()->user()->empresas->socialname)){
          $datoEmpresa=[
            'empresa'=>auth()->user()->empresas->socialname,
            'NIF'=>auth()->user()->empresas->CIFNIF,
            'direccion'=>auth()->user()->empresas->address,
            'codigopostal'=>auth()->user()->empresas->postal_code,
            'provincia'=>auth()->user()->empresas->provincia,
            'ciudad'=>auth()->user()->empresas->localidad,
            'pais'=>auth()->user()->empresas->country,
            'tel'=>auth()->user()->empresas->phone,
            'web'=>auth()->user()->empresas->website,
            'email'=>auth()->user()->empresas->email,
            'image'=>storage_path().'/app/'.auth()->user()->empresas->logo,
          ];
        }else{
          $datoEmpresa=[
            'empresa'=>'',
            'NIF'=>'',
            'direccion'=>'',
            'codigopostal'=>'',
            'provincia'=>'',
            'ciudad'=>'',
            'pais'=>'',
            'tel'=>'',
            'web'=>'',
            'email'=>'',
            'image'=>public_path()."/images/logo.png",
          ];
        }
          $data = [
            'sales' => $sales,
            'image'=>public_path()."/images/logo.png",
            'imagegps'=>public_path()."/images/gps.png",
            'imageworld'=>public_path()."/images/world.png",
            'imagephone'=>public_path()."/images/phone.png",
            'productos'=>$itemsCliente,
            'empresa'=> $datoEmpresa
        ];
        $tipo= $input['fact'];
        if($tipo==3){
          $pdf = PDF::loadView('documents.global.showticketsimpli',$data);
        }else if($tipo==2){
          $pdf = PDF::loadView('documents.global.showticketrect',$data);
        }else if($tipo==1){
          $pdf = PDF::loadView('documents.global.showticket',$data);
        }else  if($tipo==6){
          $pdf = PDF::loadView('documents.global.facturaa4simplificada',$data);
        }else if($tipo==5){
          $pdf = PDF::loadView('documents.global.facturaa4rectificacion',$data);
        }else if($tipo==4){
          $pdf = PDF::loadView('documents.global.facturaa4',$data);
        }
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream(
            'file.pdf',
            array(
              'Attachment' => 0
            )
          );
    }
}
