@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('users.index')}}">
    <meta name="filter" content="{{route('users.index')}}">
@endsection
@section('title', 'Пользователи')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Пользователи</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    @php($param = request('filter', '')['full_name'] ?? '')
                    <div class="search-block w-100 mb-3">
                        <div class="input-group input-group">
                            @php($param = request('filter', '')['full_name'] ?? '')
                            <input class="form-control"
                                   id="search-input"
                                   type="text"
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
                </div>
                <div class="col-8">
                    <div class="sort-block">
                        <div class="row">
                            @php($sort = request('sort'))
                            @php($col = preg_replace('/^-/','', $sort))
                            @php($direction = $sort && $sort[0] === '-' ? 'desc' : 'asc')
                            <div class="col-6">
                                <select onchange="sort()" class="custom-select" id="sort-columns">
                                    <option disabled {{!$col ? 'selected' : ''}}>Сортировать по...</option>
                                    <option value="id" {{$col === 'id' ? 'selected' : ''}}>Id</option>
                                    <option value="full_name" {{$col === 'full_name' ? 'selected' : ''}}>ФИО</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group">
                                    <select onchange="sort()" class="custom-select" name="" id="sort-directions">
                                        <option {{$direction === 'asc' ? 'selected' : ''}} value="asc">По возрастанию
                                        </option>
                                        <option {{$direction === 'desc' ? 'selected' : ''}} value="desc">По убыванию
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-center">
                Фойдаланувчилар
            </h3>
            @include('partials.messages')
            <table class="table table-striped text-center" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 60px" data-type="number">
                        Id
                    </th>
                    <th data-type="string">
                        ФИО
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
                            @can($permissions['roles'])
                                <a href="javascript:"
                                   onclick="setRolesFormAction('{{$user->username}}')"
                                   class="btn btn-success btn-flat btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endcan
                            @can($permissions['edit'])
                                <a href="{{route('users.edit', $user->username)}}"
                                   class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endcan
                            @can($permissions['delete'])
                                @if(auth()->id() === $user->id)
                                    <button disabled
                                            class="btn btn-danger btn-flat btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                    <a href="javascript:void(0)"
                                       data-toggle="modal"
                                       data-target="#modal-delete"
                                       onclick="setFormAction('{{$user->username}}')"
                                       class="btn btn-danger btn-flat btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links('components.pagination')}}
        </div>
    </div>
    @can($permissions['delete'])
        <x-delete :url="route('users.delete', 'ID')"/>
    @endcan
    @can($permissions['roles'])
        <div class="modal fade" data-url="{{route('users.save_role', 'ID')}}" id="modal-permissions">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ваколатлар!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ваколатлар рўйҳати?</p>
                        <form action="" id="permissions-form" method="post">
                            @csrf
                            <div class="form-body"></div>
                        </form>

                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button"
                                onclick="document.querySelector('#permissions-form').submit()"
                                class="btn btn-primary btn-flat">Сақлаш
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endcan
@endsection
