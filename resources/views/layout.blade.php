<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} | @yield('title', 'Бош саҳифа')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .absolute-positions {
            position: absolute;
            left: 12px;
            top: 12px;
            right: 12px;
            bottom: 12px;
        }
    </style>
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img/logo.png')}}" alt="NDKILogo" height="100" width="100">
    </div>

    <!-- Navbar -->
@include('partials.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <ol class="breadcrumb float-sm-left">
                        @yield('breadcrumb')
                        {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                        {{--                            <li class="breadcrumb-item active">Dashboard v1</li>--}}
                    </ol>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('partials.footer')
    @can($permissions['excel'])
        <div class="modal fade" id="modal-excel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Excel!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('excel_export')}}" method="get">
                            <div class="form-group">
                                <label for="excel_report_year">Хисобот йилини танланг</label>
                                @php($year = get_year_select_options(date('Y')))
                                <select id="excel_report_year"
                                        name="year"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat">Юклаб олиш</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endcan
</div>
<!-- ./wrapper -->
<script src="{{mix('js/combine.js')}}"></script>
@yield('js')
</body>
</html>
