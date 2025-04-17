@push('page_css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
        <link rel="stylesheet" href="{{asset('css/sales-add.css')}}">
@endpush
<section>
    <div class="product-bg">
        <div class="product-main">
            <div class="top">
                <h3>Añadir productos</h3>
            </div>
            <div class="middle">
                <div class="middle-left middle-border">
                    <ul class="main-ul main-ul-all">
                        <li class="main-li">
                            <h3>Clientes
                            </h3>
                            <div class="select-wrapper">
                                <select class="select-arrow js-example-basic-single" name="client_id" id="client_id">
                                <option selected>Selecciona Cliente</option>
        @foreach ($clientsOption as $clientsption)
                        <option value="{{ $clientsption->id }}" >{{ $clientsption->fullname }}  </option>
        @endforeach
                                </select>
                                <i class="fa-sharp fa-solid fa-caret-down"></i>
                            </div>
                        </li>
                        <li class="main-li">
                            <h3>Productos</h3>
                            <div class="select-wrapper">
                                <select class="select-arrow js-example-basic-single" name="productos_id" id="productos_id">
        <option selected>Selecciona Producto</option>
        @foreach ($productosall as $productosall)
                        <option value="{{ $productosall->id }}" >{{ $productosall->title }}  </option>
        @endforeach
                                </select>
                                <i class="fa-sharp fa-solid fa-caret-down"></i>
                            </div>
                        </li>
                        <li class="main-li">
                            <ul>
                                <li>
                                    <h3>Precio Unidad</h3>
                                    <input type="number" onchange="NuevoPrecio(this)" name="price" id="price" placeholder="Precio sin IVA">
                                    <input type="number" name="price2" disabled id="price2" placeholder="Precio Iva Incluido">
                                </li>
                               
                                <li>
                                    <h3>N° Cantidad</h3>
                                    <input type="number" name="units" id="units"  placeholder="">
                                </li>
                                <li style="display:none;">
                                    <h3>Precio Unidad Iva</h3>
                                    <input type="text" disabled name="price2" id="price2" placeholder="Impuestos incluidos">
                                </li>
                            </ul>
                        </li>
                        <li class="main-li">
                            <button onclick="agregarProduct()"  type="button">
                                <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                                <h2>AÑADIR PRODUCTO</h2>
                            </button>
                        </li>
                    </ul>
                </div>
                <input id="productosguardar" name="productosguardar" type="hidden">
                <input id="subtotalenvio" name="subtotalenvio" type="hidden">
                <input id="ivaenvio" name="ivaenvio" type="hidden">
                <input id="totalenvio" name="totalenvio" type="hidden">
                <div class="middle-right middle-border">
                    <div class="right-bottom">
                        
<ul class="main-ul-2 main-ul-all" id="ListaGrupo">
</ul>
                        <ul class="main-ul-2 main-ul-all">
                            <li>
                                <p>Subtotal:</p>
                                <p id="subtotal">0,00 €</p>
                            </li>
                            <li>
                                <h3>IVA (21%):</h3>
                                <span>
                                    <i class="fa-solid fa-angle-down"></i>
                                    <p id="iva">0,00 €</p>
                                </span>
                            </li>
                            <li>
                                <p>Total:</p>
                                <p id="total">0,00 €</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="bottom-left bottom-common">
                    <a href="{{ route('sales.index') }}">
                    <button type="button" >
                        <i class="fa-solid fa-arrow-left"></i>
                        <h3>Atrás</h3>
                    </button>
                    </a>
                 
                </div>
              
               
                <div class="bottom-right bottom-common">
                <div class="select-wrapper">
                <h3>Forma de pago</h3>
                            {!! Form::select('forma_pago', ['1' => 'Efectivo', '2' => 'Tarjeta', '3' => 'Bizum ', '4' => 'Transferencia'], null, ['class' => 'form-control custom-select']) !!}
                            </div>
                            <button style="padding: 0px 15px" type="button" onclick="accionSubmit()">
                    <i class="fa-solid fa-receipt"></i>
                            <h3>Pagar</h3>
                    </button>
                    <button style="display:none;" id='submitbutton' name='submitbutton' type="submit">
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@push('page_scripts')
    <script>
        
        var select={}
        function accionSubmit(){
        if($('#client_id').val()=="Selecciona Cliente"){
            alert("Es necesario un cliente")
        }else if (productosenfactura.length==0){
            alert("No tienes productos")
 
        }else{
            $('#submitbutton').click();
        }
     }
        var productosenfactura=[]
        var productos={!! json_encode($productosall2) !!};
 $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('#productos_id').on( "change", function() {
    var str = "";
    $( "#productos_id option:selected" ).each( function() {
      str = $( this ).val() ;
    } );
    if(productos.find((dato)=>dato.id==str)){
        select=productos.find((dato)=>dato.id==str)
        var PrecioIndividual=parseFloat(productos.find((dato)=>dato.id==str).sell_price);
        var Precio=Math.round(PrecioIndividual * 100) / 100
        var impuesto=Math.round((Precio*0.21) * 100) / 100
        $( "#price" ).val(Precio.toFixed(2))
        $( "#price2" ).val((impuesto+Precio).toFixed(2))
        
    }
  } )
});
function NuevoPrecio(data){
    var PrecioIndividual=parseFloat($(data).val());
        var Precio=Math.round(PrecioIndividual * 100) / 100
        var impuesto=Math.round((Precio*0.21) * 100) / 100
        $( "#price2" ).val((impuesto+Precio).toFixed(2))
}
function eliminar(id){
    console.log(productosenfactura.splice(id,1))
    
    this.mostrarInfo()
}
function agregarProduct(){
    if(select.id){
        if($( "#units" ).val()>0){
            if($( "#price" ).val()>0){
                var Precio=Math.round($( "#price" ).val() * 100) / 100
        var impuesto=Math.round((Precio*0.21) * 100) / 100
    productosenfactura.push({
        producto:select,
        cantidad:$( "#units" ).val(),
        precio:$( "#price" ).val(),
        iva:impuesto
    })
            }else{

                alert("Es necesario un Precio")
            }
        }else{
alert("Es necesario un Cantidad")

        }
     
    }else{
alert("Es necesario un producto")
    }
 
    this.mostrarInfo()
}
function mostrarInfo(){
    texto=""
    productosenfactura.forEach((dato,index)=>{
        var Precio=parseFloat(dato.iva)+parseFloat(dato.precio)
        var monto=Math.round(Precio * 100) / 100
        texto+=" <li class='list-group-item'>"+dato.cantidad+" - "+dato.producto.title+" - "+(monto.toFixed(2).replace(".",","))+" €<button type='button' onclick='eliminar("+index+")' class='close text-danger' aria-label='Close'><span aria-hidden='true'>&times;</span></button></li>"
    })
    $( "#ListaGrupo" ).html(texto)
    this.calcularTodo()
}
function calcularTodo(){
    let subtotal=0
    let iva=0
    productosenfactura.forEach((dato)=>{
        subtotal+=Math.round((parseFloat(dato.cantidad)*parseFloat(dato.precio)) * 100) / 100
        iva+=Math.round((parseFloat(dato.cantidad)*parseFloat(dato.iva)) * 100) / 100
    })
    $( "#subtotal" ).html(subtotal.toFixed(2).replace(".",",")+" €")
    $( "#iva" ).html(iva.toFixed(2).replace(".",",")+" €")
    $( "#total" ).html(((subtotal+iva).toFixed(2)).replace(".",",")+" €")
    this.agregarInforInput(subtotal,(subtotal+iva),iva)
}
function agregarInforInput(subtotal,total,iva){
    $( "#productosguardar" ).val(JSON.stringify(productosenfactura))
    $( "#subtotalenvio" ).val(JSON.stringify(subtotal))
    $( "#totalenvio" ).val(JSON.stringify(total))
    $( "#ivaenvio" ).val(JSON.stringify(iva))
}
function ProductosSeleccionados(dato,datoVenta){
    dato.forEach((dato)=>{
    let select=productos.find((datos)=>datos.id==dato.id_product)
    var impuesto=Math.round((dato.price*0.21) * 100) / 100
    productosenfactura.push({
        producto:select,
        cantidad:dato.amount,
        precio:dato.price,
        iva:impuesto
    })
    })
    $('#client_id').val(datoVenta.client_id)
    $('#client_id').trigger('change');
    this.mostrarInfo()
}
@if (isset($itemssales))

@if (count($itemssales)> 0)
ProductosSeleccionados({!! json_encode($itemssales) !!},{!! json_encode($sales) !!})
        @else
        @endif
        
        @endif
    </script>
@endpush