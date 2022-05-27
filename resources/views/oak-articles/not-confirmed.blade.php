@extends('layout')
@section('title', 'Илмий мақолалар  (ОАК рўйхатидаги) (Тасдиқланмаганлар)')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('oak_scientific_article.index')}}">Илмий мақолалар (ОАК&nbsp;рўйхатидаги)</a></li>
    <li class="breadcrumb-item active">Тасдиқланмаганлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                Рейтингни аниқлаш йилида Республика илмий журналларидаги (ОАК рўйхатидаги) илмий мақолалар ҳақида
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
                    <th style="width: 24%" data-type="string">
                        Муаллиф (лар) Ф.И.Ш.
                    </th>
                    <th class="" data-type="string">
                        Журналнинг номи
                    </th>
                    <th data-type="string">
                        Илмий мақола номи
                    </th>
                    <th data-type="string">
                        Нашр йили, бетлари
                    </th>
                    <th class="position-relative" style="width: 15%;">
                        <span class="d-flex absolute-positions justify-content-center align-items-center">
                            Интернет манзили
                        </span>
                    </th>
                    <th>Файл</th>
                    <th style="width: 10%;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->id}}</td>
                        <td>
                            {!! $article->users_formatted !!}
                        </td>
                        <td>
                            {{$article->magazine->title}}
                        </td>
                        <td>
                            {{$article->title}}
                        </td>
                        <td>
                            {{$article->publish_year}}, {{$article->pages}}
                        </td>
                        <td>
                            <a href="{{$article->link}}" target="_blank">Ҳавола</a>
                        </td>
                        <td>
                            @if($media = $article->getFirstMedia($collection))
                                <a href="{{$media->getFullUrl()}}" target="_blank">Файл</a>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:void(0)"
                               onclick="document.querySelector('#confirm-form-{{$article->id}}').submit()"
                               class="btn btn-success btn-flat btn-sm">
                                <i class="fas fa-check"></i>
                            </a>
                            <form action="{{route('oak_scientific_article.confirm', $article->id)}}"
                                  id="confirm-form-{{$article->id}}"
                                  method="post">@csrf</form>
                            <a href="{{route('oak_scientific_article.edit', [$article->id, 'status' => 'not-confirmed'])}}"
                               class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$article->id}}')"
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
    <x-delete :url="route('oak_scientific_article.force_delete', ['ID', 'status' => 'not-confirmed'])"/>
@endsection
