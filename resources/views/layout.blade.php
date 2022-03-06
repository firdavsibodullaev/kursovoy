<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    @yield('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} | @yield('title', 'Главная страница')</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        .cursor-pointer {
            cursor: pointer;
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
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('content-header', 'Главная страница')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb')
                            {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                            {{--                            <li class="breadcrumb-item active">Dashboard v1</li>--}}
                        </ol>
                    </div><!-- /.col -->
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
</div>
<!-- ./wrapper -->
<script src="{{mix('js/combine.js')}}"></script>
@yield('js')
</body>
</html>
