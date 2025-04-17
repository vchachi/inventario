
<div class="col-sm-7 col-12">
    <div class="card">
        <div class="card-body">
        <div class="form-group col-sm-12">
                    {!! Form::label('date', 'Fecha:') !!}
                    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
        </div>
        <div class="form-group col-sm-12">

{!! Form::label('client_id', 'Cliente:') !!}
    {!! Form::select('client_id', $clientsOption, null, ['class' => 'form-control custom-select js-example-basic-single']) !!}
</div>
        </div>
    </div>
      
    <div class="card">
        <div class="card-body">
                <div class="form-group col-sm-12">
                {!! Form::label('productos_id', 'Productos:') !!}
                <select class="form-control custom-select js-example-basic-single" id="productos_id" aria-label="Default select example">
        <option selected>Selecciona Producto</option>
        @foreach ($productosall as $productosall)
                        <option value="{{ $productosall->id }}" >{{ $productosall->title }}  </option>
        @endforeach
        </select>
                </div>
            
                <div class="row">
                        <div class="col-sm-6">
                            {!! Form::label('price', 'Precio:') !!}
                            {!! Form::text('price', null, ['class' => 'form-control']) !!}
                            
                        </div>
                        <div class="col-sm-6">
                        {!! Form::label('units', 'Unidad:') !!}
                        {!! Form::text('units', null, ['class' => 'form-control']) !!}
                        </div>
                </div>

         <button type="button" class="btn btn-secondary btn-lg mt-2" onClick="agregarProduct()">Agregar Producto</button>
         
        </div>
    </div>
</div>

<div class="col-sm-5 col-12 p-4" style="border:1px solid">
    <h3>Productos</h3>
<ul class="list-group" id="ListaGrupo">
</ul>
        <div class="card mt-3" style="border:1px solid">
                <div class="card-body">
                    <div class="row" >
                        <div class="col-9 col-sm-9">
                        <label>Subtotal:  </label>
                        </div>
                        <div class="col-3 col-sm-3 text-right">
                            <label  id="subtotal">0$<label>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-9 col-sm-9"><label>IVA (21%):  </label>
                        </div>
                        <div class="col-3 col-sm-3 text-right">
                            <label  id="iva">0$<label>
                        </div>
                    </div>
                    <div class="row" style="border-top:1px solid" >
                        <div class="col-9 col-sm-9"><label>TOTAL:  </label>
                        </div>
                        <div class="col-3 col-sm-3 text-right">
                            <label  id="total">0$<label>
                        </div>
                    </div>
                </div>
        </div>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
       
    </script>
    <script>
        var select={}
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
        $( "#price" ).val(productos.find((dato)=>dato.id==str).sell_price)
    }
  } )
});
function agregarProduct(){
    productosenfactura.push({
        producto:select,
        cantidad:$( "#units" ).val(),
        precio:$( "#price" ).val()
    })
    texto=""
    productosenfactura.forEach((dato)=>{
        texto+=" <li class='list-group-item'>"+dato.cantidad+" - "+dato.producto.title+" - "+dato.precio+"$</li>"
    })
    $( "#ListaGrupo" ).html(texto)
    this.calcularTodo()
}
function calcularTodo(){
    let subtotal=0
    let iva=0
    productosenfactura.forEach((dato)=>{
        subtotal+=dato.cantidad*dato.precio
        iva+=((dato.cantidad*dato.precio)*0.21)
    })
    $( "#subtotal" ).html(subtotal+" $")
    $( "#iva" ).html(iva+" $")
    $( "#total" ).html((subtotal+iva)+" $")
}
    </script>
@endpush