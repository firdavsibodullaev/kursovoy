@extends('layout')
@section('title', $dsc->user_full_name)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('phd_doctors.index')}}">Фан номзодлари</a></li>
    <li class="breadcrumb-item active">{{$dsc->user_full_name}}</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('phd_doctors.update', $dsc->id)}}" method="post" autocomplete="off">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text"
                                   name="last_name"
                                   class="form-control"
                                   id="last_name"
                                   placeholder="Фамилияни киритинг"
                                   value="{{$dsc->user->last_name}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="first_name">Исм</label>
                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   id="first_name"
                                   placeholder="Исминини киритинг"
                                   value="{{$dsc->user->first_name}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="patronymic">Отасининг исми</label>
                            <input type="text"
                                   name="patronymic"
                                   class="form-control"
                                   id="patronymic"
                                   placeholder="Отасининг исмини киритинг"
                                   value="{{$dsc->user->patronymic}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>Фан номзоди дипломи</h5>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="diploma_series">Серия</label>
                            <input type="text"
                                   class="form-control"
                                   id="diploma_series"
                                   name="diploma_series"
                                   value="{{$dsc->diploma['series'] ?? null}}"
                                   placeholder="Фан номзоди дипломи сериясини киритинг">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="diploma_number">Рақами</label>
                            <input type="number"
                                   class="form-control"
                                   id="diploma_number"
                                   name="diploma_number"
                                   value="{{$dsc->diploma['number'] ?? null}}"
                                   placeholder="Фан номзоди дипломи серияси рақамини киритинг">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h5>
                            Илмий даражага эга бўлмай доцент илмий унвонини олган ёки унга тенглаштирилганнинг дипломи
                        </h5>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="professor_without_science_degree_series">Серия</label>
                            <input type="text"
                                   class="form-control"
                                   id="professor_without_science_degree_series"
                                   name="professor_without_science_degree_series"
                                   value="{{$dsc->professor_without_science_degree['series'] ?? null}}"
                                   placeholder="Диплом сериясини киритинг">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="professor_without_science_degree_number">Рақами</label>
                            <input type="number"
                                   class="form-control"
                                   id="professor_without_science_degree_number"
                                   name="professor_without_science_degree_number"
                                   value="{{$dsc->professor_without_science_degree['number'] ?? null}}"
                                   placeholder="Диплом серияси рақамини киритинг">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="speciality_name">Мутахассислиги номи</label>
                    <input type="text"
                           class="form-control"
                           id="speciality_name"
                           name="speciality_name"
                           placeholder="Мутахассислиги номини киритинг"
                           value="{{$dsc->speciality_name}}"
                           required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="employee_order">Ишга қабул қилинганлиги тўғрисидаги буйруқ рақами</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">№</span>
                                </div>
                                <input type="text"
                                       id="employee_order"
                                       class="form-control"
                                       name="employee_order"
                                       placeholder="Ишга қабул қилинганлиги тўғрисидаги буйруқ рақамини киритинг"
                                       value="{{$dsc->employment['order']}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="employee_date">Ишга қабул қилинганлиги тўғрисидаги буйруқ санаси</label>
                            <input type="date"
                                   id="employee_date"
                                   class="form-control"
                                   name="employee_date"
                                   placeholder="Ишга қабул қилинганлиги тўғрисидаги буйруқ санасини киритинг"
                                   value="{{$dsc->employment['date']}}"
                                   required>
                        </div>
                    </div>
                </div>
                <input type="submit"
                       class="btn btn-primary btn-flat"
                       value="Сақлаш"/>
            </form>
        </div>
    </div>
@endsection
