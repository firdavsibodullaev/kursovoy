@extends('layout')
@section('title', 'Кафедралар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Кафедралар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                Кафедралар
            </h3>
            @include('partials.messages')
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="departments-tab" role="tablist">
                        @foreach($faculties as $faculty)
                            <li class="nav-item">
                                <a id="{{$faculty->short_name}}-tab"
                                   data-toggle="pill"
                                   @class([
                                        'nav-link',
                                        'active' => $loop->first
                                    ])
                                   href="#{{$faculty->short_name}}"
                                   role="tab"
                                   aria-controls="{{$faculty->short_name}}"
                                   aria-selected="true">
                                    {{$faculty->full_name}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="departments-tabContent">
                        @foreach($faculties as $faculty)
                            <div id="{{$faculty->short_name}}"
                                 @class([
                                    'tab-pane',
                                    'fade',
                                    'show' => $loop->first,
                                    'active' => $loop->first
                                ])
                                 role="tabpanel"
                                 aria-labelledby="{{$faculty->short_name}}-tab">
                                @foreach($faculty->departments as $department)
                                    <div class="card">
                                        <div class="card-body">
                                            <p><strong>Номи
                                                    (лотинча)</strong>: {{$department->getTranslation('full_name','uz')}}
                                                ({{$department->getTranslation('short_name','uz')}})</p>
                                            <p><strong>Номи
                                                    (кирилча)</strong>: {{$department->getTranslation('full_name','oz')}}
                                                ({{$department->getTranslation('short_name','oz')}})</p>
                                            <p><strong>Номи
                                                    (русча)</strong>: {{$department->getTranslation('full_name','ru')}}
                                                ({{$department->getTranslation('short_name','ru')}})</p>
                                            <p><strong>Номи
                                                    (инглизча)</strong>: {{$department->getTranslation('full_name','en',false)}}
                                                ({{$department->getTranslation('short_name','en',false)}})</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            @can($permissions['edit'])
                                                <a href="{{route('department.edit', $department->id)}}"
                                                   class="btn btn-flat btn-sm btn-warning">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            @endcan
                                            @can($permissions['delete'])
                                                <a href="javascript:void(0)"
                                                   data-toggle="modal"
                                                   data-target="#modal-delete"
                                                   onclick="setFormAction('{{$department->id}}')"
                                                   class="btn btn-danger btn-flat btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    @can($permissions['delete'])
        <x-delete :url="route('department.delete', 'ID')"/>
    @endcan
@endsection
