@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('users.index')}}">
    <meta name="filter" content="{{route('users.index')}}">
@endsection
@section('title', 'Пользователи')
@section('content-header', 'Пользователи')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Главная страница</a></li>
    <li class="breadcrumb-item active">Пользователи</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="search-block w-25 mb-3">
                <div class="input-group input-group">
                    @php($param = request('filter', '')['full_name'] ?? '')
                    <input class="form-control"
                           id="search-input"
                           type="search"
                           value="{{$param}}"
                           placeholder="Поиск..."
                           aria-label="Поиск">
                    <div class="input-group-append">
                        <button class="btn btn-info" onclick="filter(this, 'full_name')" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-default" onclick="filter(this, '')" type="submit">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            @include('partials.messages')
            @php($sort = request('sort',false))
            <table class="table table-striped text-center" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 60px" data-type="number">
                        Id
                        <i @class([
                                    'cursor-pointer',
                                    'fas',
                                    'text-right',
                                    'ml-1',
                                    'fa-sort-down' => $sort === '-id',
                                    'fa-sort-up' => $sort === 'id',
                                    'fa-sort' => !in_array($sort,['id','-id']),
                            ])
                           onclick="sort(this,'id','users')"></i>
                    </th>
                    <th data-type="string">
                        ФИО
                        <i @class([
                                    'cursor-pointer',
                                    'fas',
                                    'text-right',
                                    'ml-1',
                                    'fa-sort-down' => $sort === '-full_name',
                                    'fa-sort-up' => $sort === 'full_name',
                                    'fa-sort' => !in_array($sort,['full_name','-full_name']),
                            ])
                           onclick="sort(this,'full_name','users')"></i>
                    </th>
                    <th class="" data-type="string">Должность</th>
                    <th class="" data-type="wfixed">Номер телефона</th>
                    <th class="" data-type="wfixed"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->full_name}}</td>
                        <td>
                            {{$user->full_post}}
                        </td>
                        <td>{{$user->phone_formatted}}</td>
                        <td>
                            <a href="#" class="btn btn-dark btn-flat btn-sm">
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{route('users.edit', $user->username)}}" class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links('components.pagination')}}
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
