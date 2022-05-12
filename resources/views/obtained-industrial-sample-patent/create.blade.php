@php($is_checked = old('institute_checkbox') === 'on')
@extends('layout')
@section('title', 'Патент қўшиш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('obtained_industrial_sample_patent.index')}}">
            Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар
        </a>
    </li>
    <li class="breadcrumb-item active">Патент қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('obtained_industrial_sample_patent.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Патент берилган ишланманинг номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Патент берилган ишланманинг номини киритинг"
                                   value="{{old('name')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="date">Берилган санаси</label>
                            <input type="date"
                                   class="form-control"
                                   id="date"
                                   name="date"
                                   value="{{old('date')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="number">Қайд рақамлари</label>
                            <input type="text"
                                   class="form-control"
                                   id="number"
                                   name="number"
                                   placeholder="Қайд рақамини киритинг"
                                   maxlength="15"
                                   value="{{old('number')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="institute_name">Институтнинг номи</label>
                            <select class="mb-2 custom-select"
                                    @if(!$is_checked)
                                    id="institute_name"
                                    name="institute_name"
                                    required
                                    @else
                                    hidden
                                @endif
                            >
                                <option
                                    {{old('institute_name') ? '' : 'selected'}}
                                    disabled>
                                    Институтни танланг
                                </option>
                                @foreach($institutes as $institute)
                                    <option
                                        {{old('institute_name') == $institute->name ? 'selected' : ''}}
                                        value="{{$institute->name}}">{{$institute->name}}</option>
                                @endforeach
                            </select>
                            <input type="text"
                                   class="form-control mb-2"
                                   value="{{old('institute_name')}}"
                                   @if($is_checked)
                                   id="institute_name"
                                   name="institute_name"
                                   required
                                   @else
                                   hidden
                                   @endif
                                   placeholder="Институт номини киритинг">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox"
                                       id="institute_checkbox"
                                       name="institute_checkbox"
                                       {{$is_checked ? 'checked' : ''}}
                                       onchange="toggleInput(this)">
                                <label for="institute_checkbox">
                                    Институт номини рўйҳатдан топмадингизми?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш</label>
                    <select name="users[]" multiple="multiple" data-placeholder="Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш танланг" id="users" class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{$user->id === auth()->id() || (old('users') && in_array($user->id, old('users'))) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group"><input type="submit" class="btn btn-flat btn-primary" value="Сақлаш"></div>
            </form>
        </div>
    </div>
@endsection
