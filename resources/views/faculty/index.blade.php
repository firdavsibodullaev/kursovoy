@extends('layout')
@section('title', 'Факультетлар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Факультетлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                Факультетлар
            </h3>
            @include('partials.messages')
            @foreach($faculties as $faculty)
                <div class="card">
                    <div class="card-body">
                        <p><strong>Номи (лотинча)</strong>: {{$faculty->getTranslation('full_name','uz')}}
                            ({{$faculty->getTranslation('short_name','uz')}})</p>
                        <p><strong>Номи (кирилча)</strong>: {{$faculty->getTranslation('full_name','oz')}}
                            ({{$faculty->getTranslation('short_name','oz')}})</p>
                        <p><strong>Номи (русча)</strong>: {{$faculty->getTranslation('full_name','ru')}}
                            ({{$faculty->getTranslation('short_name','ru')}})</p>
                        <p><strong>Номи (инглизча)</strong>: {{$faculty->getTranslation('full_name','en',false)}}
                            ({{$faculty->getTranslation('short_name','en',false)}})</p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        @can($permissions['edit'])
                            <a href="{{route('faculty.edit', $faculty->id)}}" class="btn btn-flat btn-sm btn-warning">
                                <i class="fas fa-pen"></i>
                            </a>
                        @endcan
                        @can($permissions['delete'])
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$faculty->id}}')"
                               class="btn btn-danger btn-flat btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endcan
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @can($permissions['delete'])
        <x-delete :url="route('faculty.delete', 'ID')"/>
    @endcan
@endsection
