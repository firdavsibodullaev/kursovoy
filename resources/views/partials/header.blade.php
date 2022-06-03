<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{--        <li class="nav-item d-none d-sm-inline-block">--}}
        {{--            <a href="#" class="nav-link">Contact</a>--}}
        {{--        </li>--}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        @can($permissions['excel'])
            <li class="nav-item mr-3 mt-1">
                <a href="{{route('excel_page')}}" class="btn btn-sm btn-flat btn-success">Excel</a>
            </li>
        @endcan
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li title="Чиқиш" class="nav-item">
            <a class="nav-link"
               href="#"
               onclick="document.querySelector('#logout-form').submit()"
               role="button">
                <i class="fas fa-sign-out-alt"></i>
                <form action="{{route('logout')}}" id="logout-form" method="post">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</nav>
