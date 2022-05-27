@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('article_citation.index')}}">
    <meta name="filter" content="{{route('article_citation.index')}}">
@endsection
@section('title', 'Илмий мақолаларига иқтибослар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Илмий мақолаларига иқтибослар</li>
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
                                    <option value="article_title" {{$col === 'article_title' ? 'selected' : ''}}>
                                        Мақоланинг номи
                                    </option>
                                    <option value="magazine" {{$col === 'magazine' ? 'selected' : ''}}>Журналнинг номи
                                    </option>
                                    <option
                                        value="magazine_publish_date" {{$col === 'magazine_publish_date' ? 'selected' : ''}}>
                                        Сана
                                    </option>
                                    <option value="citations_count" {{$col === 'citations_count' ? 'selected' : ''}}>
                                        Иқтибослар сони
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
                        <a href="{{route('article_citation.not_confirmed')}}" class="btn btn-primary btn-flat">Тасдиқланмаганлар</a>
                    </div>
                @endif
            </div>
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
                            <a href="{{route('article_citation.edit', $citation->id)}}"
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
            {{$citations->links('components.pagination')}}
        </div>
    </div>
    <x-delete :url="route('article_citation.delete', 'ID')"/>
@endsection
