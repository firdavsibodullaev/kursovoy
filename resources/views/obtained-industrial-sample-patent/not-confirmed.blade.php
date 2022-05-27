@extends('layout')
@section('title', 'Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар (Таскдиқланмаганлар)')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('obtained_industrial_sample_patent.index')}}">
            Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар
        </a>
    </li>
    <li class="breadcrumb-item active">Таскдиқланмаганлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                Рейтинги аниқланаётган йилда профессор-ўқитувчилари томонидан ихтиро,
                фойдали модел, саноат намуналари ва селекция ютуқлари учун олинган патентлар
                (тегишли ташкилотлар томонидан тасдиқланган норматив ҳужжатлар асосида) ҳақида
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
                        Ихтиро, фойдали модел, саноат намунаси, селекция ютуғи учун патент берилган ишланманинг номи
                    </th>
                    <th>
                        Берилган санаси
                    </th>
                    <th style="width: 20%">
                        Қайд рақамлари*
                    </th>
                    <th>Файл</th>
                    <th style="width: 8%">
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($patents as $patent)
                    <tr>
                        <td>{{$patent->id}}</td>
                        {{--                        <td>{{$patent->institute->name}}</td>--}}
                        <td>{!! $patent->users_formatted !!}</td>
                        <td>{{$patent->name}}</td>
                        <td>{{$patent->date}}</td>
                        <td>{{$patent->number}}</td>
                        <td>
                            @if($media = $patent->file)
                                <a href="{{$media->getFullUrl()}}" target="_blank">Файл</a>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="document.querySelector('#confirm-form-{{$patent->id}}').submit()"
                               class="btn btn-success btn-flat btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <form action="{{route('obtained_industrial_sample_patent.confirm', $patent->id)}}"
                                  id="confirm-form-{{$patent->id}}"
                                  method="post">@csrf</form>
                            <a href="{{route('obtained_industrial_sample_patent.edit', $patent->id)}}"
                               class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$patent->id}}')"
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
    <x-delete :url="route('obtained_industrial_sample_patent.delete', 'ID')"/>
@endsection
