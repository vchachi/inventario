<div class="whole-body">
    <div class="decision">
        <a class="box" href="{{ route('documentsgenerate.showticketfactura',[$id,0]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/ticket.svg')}}" alt="ss" srcset="">
            <h5>Ticket Factura</h5>
        </a>
        <a class="box" href="{{ route('documentsgenerate.showticketfactura',[$id,2]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/ticket.svg')}}" alt="ss" srcset="">
            <h5>Ticket Factura Rectificada</h5>
        </a>
        <a class="box" href="{{ route('documentsgenerate.showticketfactura',[$id,1]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/ticket.svg')}}" alt="ss" srcset="">
            <h5>Ticket Factura Simplificada</h5>
        </a>
        <a class="box" href="{{ route('documentsgenerate.showfactura1',[$id,0]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/Slip.svg')}}" alt="sds">
            <h5>Factura A4</h5>
        </a>

        <a class="box" href="{{ route('documentsgenerate.showfactura1',[$id,2]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/Slip.svg')}}" alt="sds">
            <h5>Factura A4 Rectificada</h5>
        </a>
        
        <a class="box" href="{{ route('documentsgenerate.showfactura1',[$id,1]) }}" target="_blank">
            <img src="{{asset('images/repairs-images/Slip.svg')}}" alt="sds">
            <h5>Factura A4 Simplificada</h5>
        </a>
                    @if (isset($datoRetorno ))
        <a class="box" href="{{ route('repairs.index',$id) }}">
            <img src="{{asset('images/repairs-images/close.png')}}" alt="sds">
            <h5>Cancelar</h5>
            @else
            <a class="box" href="{{ route('sales.edit',$id) }}">
            <img src="{{asset('images/repairs-images/close.png')}}" alt="sds">
            <h5>Cancelar</h5>

            @endif
                       
        </a>
    </div>
</div>