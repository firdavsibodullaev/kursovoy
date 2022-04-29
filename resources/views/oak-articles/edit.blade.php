@extends('layout')
@section('title', 'Илмий мақолани таҳрирлаш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('oak_scientific_article.index')}}">Илмий мақолалар (ОАК&nbsp;рўйхатидаги)</a></li>
    <li class="breadcrumb-item active">Илмий мақолани таҳрирлаш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('oak_scientific_article.update', [$article->id, 'status' => request('status')])}}"
                  method="post"
                  enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Мақоланинг номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   placeholder="Мақоланинг номини киритинг"
                                   value="{{$article->title}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="magazine_name">Журналнинг номи</label>
                            <select class="mb-2 custom-select"
                                    id="magazine_name"
                                    name="magazine_name"
                                    required>
                                <option
                                    {{$article->magazine->title ? '' : 'selected'}}
                                    disabled>
                                    Журнални танланг
                                </option>
                                @foreach($magazines as $magazine)
                                    <option
                                        {{$article->magazine->title == $magazine->title ? 'selected' : ''}}
                                        value="{{$magazine->title}}">{{$magazine->title}}</option>
                                @endforeach
                            </select>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{$article->magazine->title}}"
                                   hidden
                                   placeholder="Журнал номини киритинг">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox"
                                       id="magazine_checkbox"
                                       name="magazine_checkbox"
                                       onchange="toggleInput(this)">
                                <label for="magazine_checkbox">
                                    Журнал номини рўйҳатдан топмадингизми?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="link">Интернет манзили</label>
                            <input type="text"
                                   class="form-control"
                                   name="link"
                                   id="link"
                                   placeholder="Интернет манзилини киритинг"
                                   value="{{$article->link}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="publish_year">Нашр йили</label>
                            <input type="text"
                                   name="publish_year"
                                   class="form-control"
                                   id="publish_year"
                                   placeholder="Нашр йилини киритинг"
                                   value="{{$article->publish_year}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pages">Саҳифалар сони</label>
                            <input type="text"
                                   class="form-control"
                                   id="pages"
                                   name="pages"
                                   placeholder="Саҳифалар сонини киритинг"
                                   value="{{$article->pages}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Муаллифлар</label>
                    <select name="users[]" multiple="multiple" data-placeholder="Муаллифларни танланг" id="users"
                            class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{in_array($user->id, $article->users->pluck('id')->toArray()) ? 'selected' : ''}}
                                value="{{$user->id}}">
                                {{$user->full_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                @php($file = $article->getFirstMedia($collection))
                <div id="file-block" @class([
                                        "d-none" => $file,
                                         "form-group"
                                     ])>
                    <label for="file">Мақолани pdf форматида юкланг</label>
                    <input type="file"
                           class="form-control-file"
                           name="file"
                           accept="application/pdf"
                           id="file">
                </div>
                @if($file)
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <a href="{{$file->getFullUrl()}}" target="_blank">
                        <span class="d-flex">
                            <img src="{{asset('img/pdf.svg')}}" width="50" alt="{{$file->file_name}}">
                            <span class="ml-2">
                                {{$file->file_name}}<br>
                                {{$file->human_readable_size}}
                            </span>
                        </span>

                        </a>
                        <div>
                            <button type="button" onclick="removeFile(this)" class="btn btn-sm btn-flat btn-danger">
                                Ўчириш
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <input type="submit" value="Сақлаш" class="btn btn-primary btn-flat">
                </div>
            </form>
        </div>
    </div>
@endsection
