@extends('layout')
@section('title', 'Янги илмий-тадқиқот ишларининг самарадорлигини таҳрирлаш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item">
        <a href="{{route('scientific_research_effectiveness.index')}}">
            Илмий-тадқиқот ишларининг самарадорлиги
        </a>
    </li>
    <li class="breadcrumb-item active">Янги илмий-тадқиқот ишларининг самарадорлигини таҳрирлаш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('scientific_research_effectiveness.update', $research->id)}}" method="post" autocomplete="off">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="specialized_code">Ихтисослик шифри</label>
                            <input type="text"
                                   class="form-control"
                                   id="specialized_code"
                                   name="specialized_code"
                                   placeholder="Ихтисослик шифрини киритинг"
                                   value="{{$research->specialized_code}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="specialized_name">Ихтисослик номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="specialized_name"
                                   name="specialized_name"
                                   placeholder="Ихтисослик номини киритинг"
                                   value="{{$research->specialized_name}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>Монография</h5>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Номи</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Номини киритинг"
                                   value="{{$research->name}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="accepted_date">Нашрга тавсия қилинганлиги санаси</label>
                            <input type="date"
                                   class="form-control"
                                   id="accepted_date"
                                   name="accepted_date"
                                   value="{{$research->accepted_date}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="accepted_report">Нашрга тавсия қилинганлиги ҳақида тегишли кенгаш баёни</label>
                            <input type="text"
                                   class="form-control"
                                   id="accepted_report"
                                   name="accepted_report"
                                   placeholder="Нашрга тавсия қилинганлиги ҳақида тегишли кенгаш баёнини киритинг"
                                   value="{{$research->accepted_report}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="publication_name">Нашриёт номи</label>
                    <select class="mb-2 custom-select"
                            id="publication_name"
                            name="publication_name"
                            required>
                        <option
                            disabled>
                            Нашриётни танланг
                        </option>
                        @foreach($publications as $publication)
                            <option
                                {{$research->publication->title == $publication->title ? 'selected' : ''}}
                                value="{{$publication->title}}">{{$publication->title}}</option>
                        @endforeach
                    </select>
                    <input type="text"
                           class="form-control mb-2"
                           value="{{old('publication_name')}}"
                           hidden
                           placeholder="Нашриёт номини киритинг">
                    <div class="icheck-primary d-inline">
                        <input type="checkbox"
                               id="publication_checkbox"
                               name="publication_checkbox"
                               onchange="toggleInput(this)">
                        <label for="publication_checkbox">
                            Нашриёт номини рўйҳатдан топмадингизми?
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="users">Муаллифлар</label>
                    <select name="users[]"
                            multiple="multiple"
                            data-placeholder="Муаллифларни танланг"
                            id="users"
                            {{is_super_admin() ? '' : 'disabled'}}
                            class="select2 w-100">
                        @foreach($users as $user)
                            <option
                                {{in_array($user->id, $research->users->pluck('id')->toArray()) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >
                                {{$user->full_name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-flat" value="Сақлаш">
                </div>
            </form>
        </div>
    </div>
@endsection
