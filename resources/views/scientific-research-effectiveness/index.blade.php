@extends('layout')
@section('meta')
    <meta name="filter" content="{{route('scientific_research_effectiveness.index')}}">
@endsection
@section('title', 'Илмий-тадқиқот ишларининг самарадорлиги')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item active">Илмий-тадқиқот ишларининг самарадорлиги</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    @php($param = request('filter', '')['user'] ?? '')
                    <div class="search-block w-100 mb-3">
                        <div class="input-group input-group">
                            @php($param = request('filter', '')['user'] ?? '')
                            <input class="form-control"
                                   id="search-input"
                                   type="text"
                                   value="{{$param}}"
                                   placeholder="Поиск..."
                                   aria-label="Поиск">
                            <div class="input-group-append">
                                <button class="btn btn-info" onclick="filter(this, 'user')" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-default" onclick="filter(this, '')" type="submit">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @can($permissions['confirm'])
                    <div class="col-8 d-flex justify-content-end">
                        <div>
                            <a href="{{route('scientific_research_effectiveness.not_confirmed')}}"
                               class="btn btn-primary btn-flat">Тасдиқланмаганлар</a>
                        </div>
                    </div>
                @endcan
            </div>
            <h3 class="text-center">
                Рейтинги аниқланаётган йилда бажарилган илмий-тадқиқот ишларининг самарадорлиги ҳақида
                <br>МАЪЛУМОТ
            </h3>
            @include('partials.messages')
            <table class="table table-striped text-center table-bordered" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th rowspan="2" style="width: 60px" data-type="number" class="position-relative">
                        <div class="d-flex justify-content-between align-items-center absolute-positions">
                            Id
                        </div>
                    </th>
                    <th rowspan="2">
                        Муаллифларнинг Ф.И.Ш
                    </th>
                    <th rowspan="2">
                        Ихтисослик шифри ва номи
                    </th>
                    <th colspan="2">
                        Монография *
                    </th>
                    <th style="width: 20%" rowspan="2">
                        Нашриёт номи
                    </th>
                    <th rowspan="2"></th>
                </tr>
                <tr>
                    <th style="width: 15%">Номи</th>
                    <th style="width: 20%">Нашрга тавсия қилинганлиги ҳақида тегишли кенгаш баёни, санаси</th>
                </tr>
                </thead>
                <tbody>
                @foreach($researches as $research)
                    <tr>
                        <td>{{$research->id}}</td>
                        <td>{!! $research->users_formatted !!}</td>
                        <td>{{$research->specialize}}</td>
                        <td>{{$research->name}}</td>
                        <td>{{$research->accept}}</td>
                        <td>{{$research->publication->title}}</td>
                        <td>
                            @can($permissions['edit'])
                                <a href="{{route('scientific_research_effectiveness.edit', $research->id)}}"
                                   class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endcan
                            @can($permissions['delete'])
                                <a href="javascript:void(0)"
                                   data-toggle="modal"
                                   data-target="#modal-delete"
                                   onclick="setFormAction('{{$research->id}}')"
                                   class="btn btn-danger btn-flat btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$researches->links('components.pagination')}}
        </div>
    </div>
    @can($permissions['delete'])
        <x-delete :url="route('scientific_research_effectiveness.delete', 'ID')"/>
    @endcan
@endsection
