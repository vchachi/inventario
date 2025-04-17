<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Inicio</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('repairs.index') }}"
       class="nav-link {{ Request::is('repairs*') ? 'active' : '' }}">
       <i class="nav-icon fa fa-wrench"></i>
        <p>Reparaciones</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('sales.index') }}"
       class="nav-link {{ Request::is('sales*') ? 'active' : '' }}">
       <i class="nav-icon fa fa-shopping-cart"></i>
        <p>Ventas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('clients.index') }}"
       class="nav-link {{ Request::is('clients*') ? 'active' : '' }}">
       <i class="nav-icon fa fa-address-book"></i>
        <p>Clientes</p>
    </a>
</li>

@if(Auth::user()->role == '0' || Auth::user()->role == '1' || Auth::user()->role == '2') 
<li class="nav-item">
    <a href="#"
       class="nav-link">
       <i class="nav-icon fa fa-cubes"></i>
        <p>Stocks<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
    
<li class="nav-item">
            <a href="{{ route('products.index') }}"
               class="nav-link {{ Request::is('products*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-cubes"></i>
                <p>Productos</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('categories.index') }}"
               class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-list"></i>
                <p>Categorias</p>
            </a>
        </li>
    
        <li class="nav-item">
            <a href="{{ route('parts.index') }}"
               class="nav-link {{ Request::is('parts*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-puzzle-piece"></i>
                <p>Piezas Reparaci&oacute;n</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orders.index') }}"
               class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-truck"></i>
                <p>Pedidos</p>
            </a>
        </li>
    </ul>
</li>

                
@endif

<li class="nav-item">
    <a href="#"
       class="nav-link">
       <i class="nav-icon fa fa-briefcase"></i>
        <p>Administraci&oacute;n <i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('budgets.index') }}"
               class="nav-link {{ Request::is('budgets*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-file"></i>
                <p>Presupuestos</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('factura.index') }}"
               class="nav-link">
               <i class="nav-icon fa fa-book"></i>
                <p>Facturas</p>
            </a>
        </li>
        
    @if(Auth::user()->role == '0' || Auth::user()->role == '1')
        <li class="nav-item">
            <a href="{{ route('estadisticas') }}"
               class="nav-link">
               <i class="nav-icon fa fa-chart-area"></i>
                     <p>Estad&iacute;sticas</p>
            </a>
        </li>
        
    @if(Auth::user()->role == '0')
        <li class="nav-item">
            <a href="#"
               class="nav-link">
               <i class="nav-icon fa fa-pencil-ruler"></i>
                <p>Personalizaci&oacute;n <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('tickets.index') }}"
                       class="nav-link {{ Request::is('tickets*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-briefcase"></i>
                        <p>Tickets</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('safeguards.index') }}"
                       class="nav-link {{ Request::is('safeguards*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-align-justify"></i>
                        <p>Resguardos</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ route('invoiceSeries.index') }}"
                       class="nav-link {{ Request::is('invoiceSeries*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-align-justify"></i>
                        <p>Facturas > Series</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('invoiceCustoms.index') }}"
                       class="nav-link {{ Request::is('invoiceCustoms*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-align-justify"></i>
                        <p>Facturas > Personalizar</p>
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('warranties.index') }}"
               class="nav-link {{ Request::is('warranties*') ? 'active' : '' }}">
               <i class="nav-icon fa fa-bookmark"></i>
                <p>Garantías </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#"
               class="nav-link">
               <i class="nav-icon fa fa-cog"></i>
                <p>Ajustes<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('companies.index') }}"
                       class="nav-link {{ Request::is('companies*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-object-group"></i>
                        <p>Datos de empresa</p>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a href="{{ route('suscriptions.index') }}"
                       class="nav-link {{ Request::is('suscriptions*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-cog"></i>
                        <p>Suscriptions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('accessLevels.index') }}"
                       class="nav-link {{ Request::is('accessLevels*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-cog"></i>
                        <p>Niveles de Acceso</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employees.index') }}"
                       class="nav-link {{ Request::is('employees*') ? 'active' : '' }}">
                       <i class="nav-icon fa fa-users"></i>
                        <p>Empleados</p>
                    </a>
                </li>-->
            </ul>
        </li>
        @endif
        @endif
    </ul>
</li>
@if(Auth::user()->role == '0' || Auth::user()->role == '1')
<li class="nav-item">
    <a href="{{ route('users.index') }}"
       class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
       <i class="nav-icon fa fa-user"></i>
        <p>Usuarios</p>
    </a>
</li>
@endif


