<!-- Main row -->
<div class="row">
    <div class="col-md-12">
        <!-- Table -->
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $categories)
                        <tr>
                            <td>{{ $categories->title }}</td>
                            <td width="120">
                                {!! Form::open(['route' => ['categories.destroy', $categories->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{{ route('categories.show', [$categories->id]) }}"
                                    class='btn btn-default btn-xs'>
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', [$categories->id]) }}"
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
                    <tfoot>
                        <tr>
                            <th>Titulo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    document?.addEventListener('DOMContentLoaded', function() {
        $(document).ready( function () {
            var $j = jQuery.noConflict();
            $(function () {
                    $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Mostrando la página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "search":"Buscar:",
            "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
    },
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
                },
            "responsive": true,
            });
            });
        })
    })
</script>
