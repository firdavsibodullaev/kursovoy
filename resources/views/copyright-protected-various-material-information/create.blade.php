{{--@php($is_checked = old('institute_checkbox') === 'on')--}}
@extends('layout')
@section('title', 'Материал қўшиш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('copyright_protected_various_material_information.index')}}">
            Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар
        </a>
    </li>
    <li class="breadcrumb-item active">Материал қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('copyright_protected_various_material_information.store')}}"
                  method="post"
                  enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Олинган гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли
                                материаллар номи</label>
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
                            <label for="serial">Қайд рақамлари</label>
                            <input type="text"
                                   class="form-control"
                                   id="serial"
                                   name="serial"
                                   placeholder="Қайд рақамини киритинг"
                                   maxlength="15"
                                   value="{{old('serial')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="file">Патентни pdf кўринишида юкланг</label>
                            <input type="file"
                                   name="file"
                                   id="file"
                                   class="form-control-file"
                                   required
                                   accept="application/pdf"/>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="institute_name">Институтнинг номи</label>--}}
                        {{--                            <select class="mb-2 custom-select"--}}
                        {{--                                    @if(!$is_checked)--}}
                        {{--                                    id="institute_name"--}}
                        {{--                                    name="institute_name"--}}
                        {{--                                    required--}}
                        {{--                                    @else--}}
                        {{--                                    hidden--}}
                        {{--                                @endif--}}
                        {{--                            >--}}
                        {{--                                <option--}}
                        {{--                                    {{old('institute_name') ? '' : 'selected'}}--}}
                        {{--                                    disabled>--}}
                        {{--                                    Институтни танланг--}}
                        {{--                                </option>--}}
                        {{--                                @foreach($institutes as $institute)--}}
                        {{--                                    <option--}}
                        {{--                                        {{old('institute_name') == $institute->name ? 'selected' : ''}}--}}
                        {{--                                        value="{{$institute->name}}">{{$institute->name}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                            <input type="text"--}}
                        {{--                                   class="form-control mb-2"--}}
                        {{--                                   value="{{old('institute_name')}}"--}}
                        {{--                                   @if($is_checked)--}}
                        {{--                                   id="institute_name"--}}
                        {{--                                   name="institute_name"--}}
                        {{--                                   required--}}
                        {{--                                   @else--}}
                        {{--                                   hidden--}}
                        {{--                                   @endif--}}
                        {{--                                   placeholder="Институт номини киритинг">--}}
                        {{--                            <div class="icheck-primary d-inline">--}}
                        {{--                                <input type="checkbox"--}}
                        {{--                                       id="institute_checkbox"--}}
                        {{--                                       name="institute_checkbox"--}}
                        {{--                                       {{$is_checked ? 'checked' : ''}}--}}
                        {{--                                       onchange="toggleInput(this)">--}}
                        {{--                                <label for="institute_checkbox">--}}
                        {{--                                    Институт номини рўйҳатдан топмадингизми?--}}
                        {{--                                </label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_id">Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш</label>
                    <select name="user_id" data-placeholder="Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш танланг"
                            id="user_id" class="select2 w-100">
                        <option value=""></option>
                        @foreach($users as $user)
                            <option
                                {{($user->id == old('user_id') || $user->id == auth()->id()) ? 'selected' : ''}}
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
