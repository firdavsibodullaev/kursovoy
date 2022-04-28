@php($is_checked = old('magazine_checkbox') === 'on')
@extends('layout')
@section('title', 'Илмий мақолаларига иқтибослар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('article_citation.index')}}">Илмий мақолаларига иқтибослар</a></li>
    <li class="breadcrumb-item active">Илмий мақолаларига иқтибослар қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('article_citation.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="article_title">Мақоланинг номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="article_title"
                                   name="article_title"
                                   placeholder="Мақоланинг номини киритинг"
                                   value="{{old('article_title')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="magazine_name">Журналнинг номи</label>
                            <select class="mb-2 custom-select"
                                    @if(!$is_checked)
                                    id="magazine_name"
                                    name="magazine_name"
                                    required
                                    @else
                                    hidden
                                @endif
                            >
                                <option
                                    {{old('magazine_name') ? '' : 'selected'}}
                                    disabled>
                                    Журнални танланг
                                </option>
                                @foreach($magazines as $magazine)
                                    <option
                                        {{old('magazine_name') == $magazine->title ? 'selected' : ''}}
                                        value="{{$magazine->title}}">{{$magazine->title}}</option>
                                @endforeach
                            </select>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{old('magazine_name')}}"
                                   @if($is_checked)
                                   id="magazine_name"
                                   name="magazine_name"
                                   required
                                   @else
                                   hidden
                                   @endif
                                   placeholder="Журнал номини киритинг">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox"
                                       id="magazine_checkbox"
                                       name="magazine_checkbox"
                                       {{$is_checked ? 'checked' : ''}}
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
                                   value="{{old('link')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="magazine_publish_date">Сана</label>
                            <input type="date"
                                   name="magazine_publish_date"
                                   class="form-control"
                                   id="magazine_publish_date"
                                   value="{{old('magazine_publish_date')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="article_language">Мақоланинг тили</label>
                            <select name="article_language"
                                    id="article_language"
                                    class="custom-select"
                                    required>
                                @foreach($languages as $key => $language)
                                    <option value="{{$key}}">{{$language}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="citations_count">Иқтибослар сони</label>
                            <input type="number"
                                   id="citations_count"
                                   class="form-control"
                                   name="citations_count"
                                   placeholder="Иқтибослар сонини киритинг"
                                   value="{{old('citations_count')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Муаллифлар</label>
                    <select name="users[]" multiple="multiple" id="users" class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{$user->id === auth()->id() || (old('users') && in_array($user->id, old('users'))) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"><input type="submit" value="Сақлаш" class="btn btn-primary btn-flat"></div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: 'Муаллифларни танланг'
        });
    </script>
@endsection
