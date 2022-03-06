<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} | Авторизация</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <style>
        body {
            background-image: url('./img/login-background.jpg');
            background-size: cover;
            background-position-y: bottom;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>{{config('app.name')}}</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Вход в систему</p>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text"
                           @class([
                                'form-control',
                                'is-invalid' => $errors->any()
                            ])
                           required
                           id="username"
                           name="username"
                           value="{{old('username')}}"
                           placeholder="Логин">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('username')
                    <span id="username-error" class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password"
                           @class([
                               'form-control',
                               'is-invalid' => $errors->any()
                           ])
                           id="password"
                           name="password"
                           placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span id="password-error" class="error invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">
                                Запомнить
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
<!-- /.login-box -->

<script src="{{mix('js/combine.js')}}"></script>
</body>
</html>
