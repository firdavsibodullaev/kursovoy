@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('scientific_article.index')}}">
    <meta name="filter" content="{{route('scientific_article.index')}}">
@endsection
@section('title', 'Илмий мақолалар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Илмий мақолалар</li>
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
                <div class="col-{{is_super_admin() ? 6 : 8}}">
                    <div class="sort-block">
                        <div class="row">
                            @php($sort = request('sort'))
                            @php($col = preg_replace('/^-/','', $sort))
                            @php($direction = $sort && $sort{0} === '-' ? 'desc' : 'asc')
                            <div class="col-6">
                                <select onchange="sort()" class="custom-select" id="sort-columns">
                                    <option disabled {{!$col ? 'selected' : ''}}>Сортировать по...</option>
                                    <option value="id" {{$col === 'id' ? 'selected' : ''}}>Id</option>
                                    <option value="title" {{$col === 'title' ? 'selected' : ''}}>
                                        Мақоланинг номи
                                    </option>
                                    <option value="magazine" {{$col === 'magazine' ? 'selected' : ''}}>Журналнинг номи
                                    </option>
                                    <option
                                        value="publish_year" {{$col === 'publish_year' ? 'selected' : ''}}>
                                        Сана
                                    </option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group">
                                    <select onchange="sort()" class="custom-select" name="" id="sort-directions">
                                        <option {{$direction === 'asc' ? 'selected' : ''}} value="asc">По возрастанию
                                        </option>
                                        <option {{$direction === 'desc' ? 'selected' : ''}} value="desc">По убыванию
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(is_super_admin())
                    <div class="col-2">
                        <a href="{{route('scientific_article.not_confirmed')}}" class="btn btn-primary btn-flat">Тасдиқланмаганлар</a>
                    </div>
                @endif
            </div>
            <h3 class="text-center">
                Рейтингни аниқлаш йилида халқаро илмий журналларда
                («Web of Science», «Scopus» ва Вазирлар Маҳкамаси ҳузуридаги
                Олий аттестация комиссияси рўйхатига киритилган журналларда)
                чоп этилган илмий мақолалар ҳақида
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
                        Давлат номи
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
                            {{$article->country->name}}
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
                            <a href="{{route('scientific_article.edit', $article->id)}}"
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
            {{$articles->links('components.pagination')}}
        </div>
    </div>
    <x-delete :url="route('scientific_article.delete', 'ID')"/>
@endsection
