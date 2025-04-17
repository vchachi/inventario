<!DOCTYPE html>
<html>
<head>
  <title>Factura</title>
  <style>
    *{margin:0px 7px 0px 3px;}
    .letter{
      font-size:7px;
    }
    .tableinfo{
width:170px;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body style="font-size:10px;margin:3px 0px 0px 5px;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div>
          <h3 style="font-size:13px;margin:0px 0px 0px 65px">Factura</h3>
          <img style="width:50px;height:50px;margin:0px 0px 0px 65px" src="{{$empresa['image']}}" />
          <p class="letter" style="margin:3px 0px 0px 5px;">{{$empresa['empresa']}}</p>
          <table class="tableinfo">
           <tr class="letter">
    <td>NIF:</td>
    <td  style="text-align:right;">{{$empresa['NIF']}}</td>
  </tr>
  <tr class="letter">
    <td>Direccion:</td>
    <td  style="text-align:right;">{{$empresa['direccion']}} </td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Factura:</span></td>
    <td style="text-align:right;">{{$sales->id}} </td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Fecha:</span></td>
    <td style="text-align:right;">{{$sales->date}} </td>
  </tr>
          </table>
       </div>
         <hr style="font-size:10px;margin:3px 0px 0px 0px">
        <div>
        <table class="tableinfo">
        <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Nombre:</span></td>
    <td style="text-align:right;">{{$clientsOption->fullname}} </td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">NIF:</span></td>
    <td style="text-align:right;"> {{$clientsOption->NIF}}</td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Dirección:</span></td>
    <td style="text-align:right;"> {{$clientsOption->address}}</td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Teléfono:</span></td>
    <td style="text-align:right;"> {{$clientsOption->phone}}</td>
  </tr>
          </table>
      </div>
         <hr style="font-size:10px;margin:3px 0px 0px 0px">
         <div>
          
        <table class="tableinfo">
        <tr class="letter">
    <td  style="margin:0px 0px 0px 5px;text-align:left;">Producto</td>
    <td style="margin:0px 0px 0px 5px;text-align:center;">Cantidad</td>
    <td style="margin:0px 0px 0px 5px;text-align:right;"> Precio</td>
  </tr>
         @foreach ($productos as $producto)
     
         <tr class="letter">
         
         @if (empty($producto->title))
    <td class="letter" style=";margin:0px 0px 0px 5px;text-align:left;">{{ $producto->concept }}</td>
  

          @else
    <td  class="letter" style="margin:0px 0px 0px 5px; text-align:left;">{{ $producto->title}}</td>

          @endif
<td class="letter" style="padding:0px 0px 0px 5px;text-align:center;">
{{ $producto->amount }}
</td>
<td class="letter" style="padding:0px 0px 0px 5px;text-align:right;">
({{ $producto->price }}EUR)
</td>
        </tr>
        @endforeach
          </table>
        </div>
         <hr style="font-size:10px;margin:3px 0px 0px 0px">
         <div>
          
        <table class="tableinfo">
        <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Subtotal:</span></td>
    <td style="text-align:right;">  {{$sales->subtotal}} (EUR)</td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">IVA (21%):</span></td>
    <td style="text-align:right;">  {{$sales->iva}} (EUR)</td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Total:</span></td>
    <td style="text-align:right;">  {{$sales->total}} (EUR)</td>
  </tr>
  <tr class="letter">
    <td><span style="margin:0px;font-weight:900">Pago:</span></td>
    <td style="text-align:right;">  {{$sales->forma_pago=='1'?'Efectivo': ($sales->forma_pago=='2'?'Tarjeta':($sales->forma_pago=='3'?'Bizum':'Transferencia'))}}</td>
  </tr>
      </table>
       </div>
      </div>
    </div>
  </div>
</body>
</html>