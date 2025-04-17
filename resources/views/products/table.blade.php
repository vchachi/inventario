<!-- Add a search form above the table -->
<form action="{{ route('products.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar Producto, Categoria, Marca o Modelo..." value="{{ $search }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Busqueda</button>
        </div>
    </div>
</form>
<!-- Main row -->
<div class="row table-responsive">
    <div class="col-md-12">
        <!-- Table -->
        <div class="card">
            <!-- /.card-header -->
            <div class="table-responsive">
                <table id="example2" class="table">
                    <thead>
                        <tr>
                            <th class="all">Nombre</th>
                            <th class="all">Categoría</th>
                            <th class="all">Color</th>
                            <th class="all">Código de barras</th>
                            <th class="all">Referencia</th>
                            <th class="all">Unidades</th>
                            <th class="all">Precio de ventas</th>
                            <th class="all">Estado</th>
                            <th class="all">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category_title }}</td>
                            <td>{{ $product->color }}</td>
                            <td>{{ $product->bar_code }}</td>
                            <td>{{ $product->reference }}</td>
                            <td>{{ $product->units }}</td>
                            <td>{{ $product->sell_price }}</td>
                            <td>{{ $product->state == 1 ? "Funcional" : ($product->state == 2 ? "Reacondicionado" : ($product->state == 3 ? "Seminuevo" : ($product->state == 4 ? "Perfecto estado" : ($product->state == 5 ? "Nuevo" : ""))))}}</td>
                           
                            <td>
                                {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{{ route('products.show', [$product->id]) }}"
                                    class='btn btn-default btn-xs'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{ route('products.edit', [$product->id]) }}"
                                    class='btn btn-default btn-xs'>
                                        <i class="far fa-edit"></i>
                                    </a>
                                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- Pagination links -->
            <style>
                .card-footer.product-table::after {
                    display: none;
                    clear: both;
                    content: "";
                }
                @media screen and (max-width: 768px) {
                    .card-footer.product-table {
                        flex-direction: column;
                    }
                }
                @media screen and ( max-width: 400px ){

li.page-item {

    display: none;
}

.page-item:first-child,
.page-item:nth-child( 2 ),
.page-item:nth-last-child( 2 ),
.page-item:last-child,
.page-item.active,
.page-item.disabled {

    display: block;
}
}
            </style>
            <div class="card-footer product-table d-flex justify-content-between align-items-center">
                <div>Mostrando {{ $products->firstItem() }} de {{ $products->lastItem() }} de {{ $products->total() }} valores</div>
                <div>{{ $products->appends(['search' => $search])->onEachSide(0)->links() }}</div>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    
</script>