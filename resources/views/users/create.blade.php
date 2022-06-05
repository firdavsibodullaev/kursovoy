@extends('layout')
@section('title', 'Янги фойдаланувчи')
@section('content-header', 'Янги фойдаланувчи')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Фойдаланувчилар</a></li>
    <li class="breadcrumb-item active">Янги фойдаланувчи</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('users.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <h4 class="text-bold">Шахсий маълумотлар</h4>
                        <hr>
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="last_name"
                                   required
                                   placeholder="Фамилияни киритинг"
                                   value="{{old('last_name')}}"
                                   name="last_name">
                        </div>
                        <div class="form-group">
                            <label for="first_name">Исм</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="first_name"
                                   required
                                   placeholder="Исмни киритинг"
                                   value="{{old('first_name')}}"
                                   name="first_name">
                        </div>
                        <div class="form-group">
                            <label for="patronymic">Отасининг исми</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="patronymic"
                                   required
                                   placeholder="Отасининг исмини киритинг"
                                   value="{{old('patronymic')}}"
                                   name="patronymic">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Туғилган санаси</label>
                            <input type="date"
                                   @class([
                                        'form-control',
                                    ])
                                   id="birthdate"
                                   value="{{old('birthdate')}}"
                                   name="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон рақами</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   data-inputmask='"mask": "+\\9\\98999999999"'
                                   data-mask
                                   id="phone"
                                   required
                                   placeholder="Телефон рақамини киритинг"
                                   value="{{old('phone')}}"
                                   name="phone">
                        </div>
                    </div>
                    <div class="col-4">
                        <h4 class="text-bold">Аутентификация маълумотлари</h4>
                        <hr>
                        <div class="form-group">
                            <label for="username">Логин</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="username"
                                   required
                                   placeholder="Логинни киритинг"
                                   value="{{old('username')}}"
                                   name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="password"
                                   required
                                   placeholder="Парольни киритинг"
                                   value="{{old('password')}}"
                                   name="password">
                        </div>
                        <button type="button"
                                onclick="generatePassword('#password')"
                                class="btn btn-secondary btn-sm btn-flat">Парольни яратиш
                        </button>
                    </div>
                    <div class="col-4">
                        <h4 class="text-bold">Бошқа маълумотлар</h4>
                        <hr>
                        <div class="form-group">
                            <label for="faculty_id">Факультет</label>
                            <select name="faculty_id"
                                    id="faculty_id"
                                    onchange="requests.prof.getDepartments(this)"
                                    class="custom-select">
                                <option value="">Факультетни танланг</option>
                                @foreach($faculties as $faculty)
                                    <option value="{{$faculty->id}}">
                                        {{$faculty->full_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Кафедра</label>
                            <select name="department_id"
                                    id="department_id"
                                    class="custom-select">
                                <option value="">Кафедрани танланг</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="post">Лавозим</label>
                            <select name="post"
                                    id="post"
                                    required
                                    class="custom-select">
                                <option value="">Лавозимини танланг</option>
                                @foreach($roles as $key => $role)
                                    <option
                                        value="{{$key}}" {{old('post') == $key ? 'selected' : ''}}>
                                        {{$role}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-flat">Сақлаш</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('[data-mask]').inputmask();
    </script>
@endsection
