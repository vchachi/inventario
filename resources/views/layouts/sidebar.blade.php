<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:rgba(0, 0, 64)">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('/images/logo.png')}}"
             alt="Logo"
             class="img-fluid">
        <span class="brand-text font-weight-light"></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
