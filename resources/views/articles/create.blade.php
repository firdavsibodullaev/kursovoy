@php($is_checked = old('magazine_checkbox') === 'on')
@php($is__checked = old('country_checkbox') === 'on')
@extends('layout')
@section('title', 'Илмий мақолалар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('scientific_article.index')}}">Илмий мақолалар</a></li>
    <li class="breadcrumb-item active">Илмий мақола қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('scientific_article.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Мақоланинг номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   placeholder="Мақоланинг номини киритинг"
                                   value="{{old('title')}}"
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
                            <label for="publish_year">Нашр йили</label>
                            <input type="text"
                                   name="publish_year"
                                   class="form-control year"
                                   id="publish_year"
                                   placeholder="Нашр йилини киритинг"
                                   value="{{old('publish_year')}}"
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
                                   value="{{old('pages')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="country_name">Давлат номи</label>
                            <select class="mb-2 custom-select"
                                    @if(!$is__checked)
                                    id="country_name"
                                    name="country_name"
                                    required
                                    @else
                                    hidden
                                @endif
                            >
                                <option
                                    {{old('country_name') ? '' : 'selected'}}
                                    disabled>
                                    Давлатни танланг
                                </option>
                                @foreach($countries as $country)
                                    <option
                                        {{old('country_name') == $country->name ? 'selected' : ''}}
                                        value="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{old('country_name')}}"
                                   @if($is__checked)
                                   id="country_name"
                                   name="country_name"
                                   required
                                   @else
                                   hidden
                                   @endif
                                   placeholder="Давлат номини киритинг">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox"
                                       id="country_checkbox"
                                       name="country_checkbox"
                                       {{$is_checked ? 'checked' : ''}}
                                       onchange="toggleInput(this)">
                                <label for="country_checkbox">
                                    Давлат номини рўйҳатдан топмадингизми?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Муаллифлар</label>
                    <select name="users[]" multiple="multiple" data-placeholder="Муаллифларни танланг" id="users" class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{$user->id === auth()->id() || (old('users') && in_array($user->id, old('users'))) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Мақолани pdf форматида юкланг</label>
                    <input type="file"
                           class="form-control-file"
                           name="file"
                           required
                           accept="application/pdf"
                           id="file">
                </div>
                <div class="form-group">
                    <input type="submit" value="Сақлаш" class="btn btn-primary btn-flat">
                </div>
            </form>
        </div>
    </div>
@endsection
