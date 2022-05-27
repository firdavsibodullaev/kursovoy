@extends('layout')
@section('title', 'Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар (Тасдиқланмаганлар)')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('copyright_protected_various_material_information.index')}}">
            Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар
        </a>
    </li>
    <li class="breadcrumb-item active">Тасдиқланмаганлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
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
                        <td>{!! $item->user->full_name !!}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->serial}}</td>
                        <td>
                            @if($media = $item->file)
                                <a href="{{$media->getFullUrl()}}" target="_blank">Файл</a>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="document.querySelector('#confirm-form-{{$item->id}}').submit()"
                               class="btn btn-success btn-flat btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <form action="{{route('copyright_protected_various_material_information.confirm', $item->id)}}"
                                      id="confirm-form-{{$item->id}}"
                                      method="post">@csrf</form>
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
        </div>
    </div>
    <x-delete :url="route('copyright_protected_various_material_information.delete', 'ID')"/>
@endsection
