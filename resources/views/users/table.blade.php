<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th colspan="3">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        
            <tr>
                <td>{!! $user->name !!}


                </td>
                <td>{!! $user->email !!}
                @if ($user->id=== $user->id_user_master)
                <span style="color:red;font-weight:bold;">(Cuenta Empresarial)</span>
                @else
                @endif</td>
                <td>{{ $user->role == '0' ? 'Super Admin' : ($user->role == '1' ? 'Administrador' : ($user->role == '2' ? 'Logistica' : 'Empleado')) }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        @if(Auth::user()->id_user_master===0 && Auth::user()->is_master)
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'>
    <i class="far fa-edit"></i>
</a>
{!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}
   
                        @else
                        @if ($user->id=== $user->id_user_master)

@else

<a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'>
    <i class="far fa-edit"></i>
</a>
{!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Estas Seguro?')"]) !!}

@endif
                        @endif
                    
                      
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
