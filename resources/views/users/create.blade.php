@extends('layout')
@section('title', 'Новый пользователь')
@section('content-header', 'Новый пользователь')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Главная страница</a></li>
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Пользователи</a></li>
    <li class="breadcrumb-item active">Новый пользователь</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('users.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <h4 class="text-bold">Личная информация</h4>
                        <hr>
                        <div class="form-group">
                            <label for="last_name">Фамилия</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="last_name"
                                   required
                                   placeholder="Введите фамилию"
                                   value="{{old('last_name')}}"
                                   name="last_name">
                        </div>
                        <div class="form-group">
                            <label for="first_name">Имя</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="first_name"
                                   required
                                   placeholder="Введите имя"
                                   value="{{old('first_name')}}"
                                   name="first_name">
                        </div>
                        <div class="form-group">
                            <label for="patronymic">Отчество</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="patronymic"
                                   required
                                   placeholder="Введите отчество"
                                   value="{{old('patronymic')}}"
                                   name="patronymic">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Дата рождения</label>
                            <input type="date"
                                   @class([
                                        'form-control',
                                    ])
                                   id="birthdate"
                                   value="{{old('birthdate')}}"
                                   name="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   data-inputmask='"mask": "+\\9\\98999999999"'
                                   data-mask
                                   id="phone"
                                   required
                                   placeholder="Введите номер телефона"
                                   value="{{old('phone')}}"
                                   name="phone">
                        </div>
                    </div>
                    <div class="col-4">
                        <h4 class="text-bold">Данные аутентификации</h4>
                        <hr>
                        <div class="form-group">
                            <label for="username">Логин</label>
                            <input type="text"
                                   @class([
                                        'form-control',
                                    ])
                                   id="username"
                                   required
                                   placeholder="Введите логин"
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
                                   placeholder="Введите пароль"
                                   value="{{old('password')}}"
                                   name="password">
                        </div>
                        <button type="button"
                                onclick="generatePassword('#password')"
                                class="btn btn-secondary btn-sm btn-flat">Сгенерировать пароль
                        </button>
                    </div>
                    <div class="col-4">
                        <h4 class="text-bold">Другие данные</h4>
                        <hr>
                        <div class="form-group">
                            <label for="faculty_id">Факультет</label>
                            <select name="faculty_id"
                                    id="faculty_id"
                                    onchange="requests.prof.getDepartments(this)"
                                    class="custom-select">
                                <option value="">Выберите факультет</option>
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
                                <option value="">Выберите кафедру</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="post">Должность</label>
                            <select name="post"
                                    id="post"
                                    required
                                    class="custom-select">
                                <option value="">Выберите должность</option>
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
                    <button type="submit" class="btn btn-primary btn-flat">Сохранить</button>
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
