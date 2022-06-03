@extends('layout')
@section('breadcrumb')
    <li class="breadcrumb-item active">Бош саҳифа</li>
@endsection
@section('content')
    @can($permissions['reports'])
        @include('report.index')
    @endcan
@endsection
