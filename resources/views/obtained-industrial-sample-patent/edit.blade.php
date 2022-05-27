@extends('layout')
@section('title', 'Патентни тахрирлаш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('obtained_industrial_sample_patent.index')}}">
            Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар
        </a>
    </li>
    <li class="breadcrumb-item active">Патентни тахрирлаш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('obtained_industrial_sample_patent.update', $patent->id)}}"
                  method="post"
                  autocomplete="off"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="name">Патент берилган ишланманинг номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Патент берилган ишланманинг номини киритинг"
                                   value="{{$patent->name}}"
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
                                   value="{{$patent->date}}"
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
                                   value="{{$patent->number}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        @php($file = $patent->file)
                        <div id="file-block" @class([
                                        "d-none" => $file,
                                         "form-group"
                                     ])>
                            <label for="file">Патентни pdf кўринишида юкланг</label>
                            <input type="file"
                                   name="file"
                                   id="file"
                                   class="form-control-file"
                                   required
                                   accept="application/pdf"/>
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
{{--                        <div class="form-group">--}}
{{--                            <label for="institute_name">Институтнинг номи</label>--}}
{{--                            <select class="mb-2 custom-select"--}}
{{--                                    id="institute_name"--}}
{{--                                    name="institute_name"--}}
{{--                                    required>--}}
{{--                                <option--}}
{{--                                    disabled>--}}
{{--                                    Институтни танланг--}}
{{--                                </option>--}}
{{--                                @foreach($institutes as $institute)--}}
{{--                                    <option--}}
{{--                                        {{$patent->institute->name == $institute->name ? 'selected' : ''}}--}}
{{--                                        value="{{$institute->name}}">{{$institute->name}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <input type="text"--}}
{{--                                   class="form-control mb-2"--}}
{{--                                   hidden--}}
{{--                                   placeholder="Институт номини киритинг">--}}
{{--                            <div class="icheck-primary d-inline">--}}
{{--                                <input type="checkbox"--}}
{{--                                       id="institute_checkbox"--}}
{{--                                       name="institute_checkbox"--}}
{{--                                       onchange="toggleInput(this)">--}}
{{--                                <label for="institute_checkbox">--}}
{{--                                    Институт номини рўйҳатдан топмадингизми?--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш</label>
                    <select name="users[]" multiple="multiple" data-placeholder="Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш танланг" id="users" class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{in_array($user->id, $patent->users->pluck('id')->toArray()) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-flat btn-primary" value="Сақлаш">
                </div>
            </form>
        </div>
    </div>
@endsection
