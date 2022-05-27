@extends('layout')
@section('title', 'Илмий мақолаларига иқтибослар (Тасдиқланмаганлар)')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('article_citation.index')}}">Илмий мақолаларига иқтибослар</a></li>
    <li class="breadcrumb-item active">Тасдиқланмаганлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                Ҳалқаро кўрсаткичларга кўра профессор-ўқитувчиларнинг илмий
                мақолаларига («Web of Science», «Scopus», «Google Scholar» ёки бошқа халқаро эътироф этилган базаларда
                мавжуд бўлган журналлар бўйича) иқтибослар ҳақида
                <br>
                МАЪЛУМОТ
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
                    <th style="width: 24%" data-type="string">
                        Муаллиф (лар) Ф.И.Ш.
                    </th>
                    <th class="" data-type="string">
                        Журналнинг номи
                    </th>
                    <th data-type="string">
                        Сана
                    </th>
                    <th class="position-relative" style="width: 15%;">
                        <span class="d-flex absolute-positions justify-content-center align-items-center">
                            Мақоланинг номи
                        </span>
                    </th>
                    <th style="width: 15%;">
                        Тили
                    </th>
                    <th style="width: 8%;">Интернет манзили</th>
                    <th style="width: 8%;">Иқтибослар сони*</th>
                    <th style="width: 10%;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($citations as $citation)
                    <tr>
                        <td>{{$citation->id}}</td>
                        <td>
                            {!! $citation->users_formatted !!}
                        </td>
                        <td>
                            {{$citation->magazine->title}}
                        </td>
                        <td>
                            {{date_create($citation->magazine_publish_date)->format('m.Y')}}
                        </td>
                        <td>
                            {{$citation->article_title}}
                        </td>
                        <td>
                            {{$languages[$citation->article_language]}}
                        </td>
                        <td>
                            <a href="{{$citation->link}}" target="_blank">Ҳавола</a>
                        </td>
                        <td>
                            {{$citation->citations_count}}
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="document.querySelector('#confirm-form-{{$citation->id}}').submit()"
                               class="btn btn-success btn-flat btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <form action="{{route('article_citation.confirm', $citation->id)}}"
                                  id="confirm-form-{{$citation->id}}"
                                  method="post">@csrf</form>
                            <a href="{{route('article_citation.edit', [$citation->id, 'status' => 'not-confirmed'])}}"
                               class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$citation->id}}')"
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
    <x-delete :url="route('article_citation.force_delete', 'ID')"/>
@endsection
