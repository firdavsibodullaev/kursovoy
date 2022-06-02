@extends('layout')
@section('meta')
    <meta name="filter" content="{{route('copyright_protected_various_material_information.index')}}">
@endsection
@section('title', 'Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item active">Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар</li>
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
                @if(is_super_admin())
                    <div class="col-8 d-flex justify-content-end">
                        <div>
                            <a href="{{route('copyright_protected_various_material_information.not_confirmed')}}" class="btn btn-primary btn-flat">Тасдиқланмаганлар</a>
                        </div>
                    </div>
                @endif
            </div>
            <h3 class="text-center">
                Рейтинги аниқланаётган йилда профессор-ўқитувчилари
                томонидан ахборот-коммуникация технологияларига оид
                дастурлар ва электрон маълумотлар базалари учун олинган
                гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган
                турли материаллар ҳақида
                <br>МАЪЛУМОТ
            </h3>
            @include('partials.messages')
            <table class="table table-striped text-center table-bordered" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 60px" data-type="number" class="position-relative">
                        <div class="d-flex justify-content-between align-items-center absolute-positions">
                            Id
                        </div>
                    </th>
                    {{--                    <th style="width: 8%">--}}
                    {{--                        ОТМлар номи--}}
                    {{--                    </th>--}}
                    <th>
                        Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш
                    </th>
                    <th>
                        Олинган гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар номи
                    </th>
                    <th>
                        Берилган санаси
                    </th>
                    <th style="width: 20%">
                        Қайд рақамлари
                    </th>
                    <th>Файл</th>
                    <th style="width: 8%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($information as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        {{--                        <td>{{$item->institute->name}}</td>--}}
                        <td>{!! $item->users_formatted !!}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->serial}}</td>
                        <td>
                            @if($media = $item->file)
                                <a href="{{$media->getFullUrl()}}" target="_blank">Файл</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('copyright_protected_various_material_information.edit', $item->id)}}"
                               class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$item->id}}')"
                               class="btn btn-danger btn-flat btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$information->links('components.pagination')}}
        </div>
    </div>
    <x-delete :url="route('copyright_protected_various_material_information.delete', 'ID')"/>
@endsection
