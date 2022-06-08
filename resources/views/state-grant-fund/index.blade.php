@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('state_grant_fund.index')}}">
    <meta name="filter" content="{{route('state_grant_fund.index')}}">
@endsection
@section('title', ' Давлат грантлари асосида ўтказилган тадқиқотлар маблағлар')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item active">Давлат грантлари асосида ўтказилган тадқиқотлар маблағлар</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    @php($param = request('filter', '')['name'] ?? '')
                    <div class="search-block w-100 mb-3">
                        <div class="input-group input-group">
                            @php($param = request('filter', '')['name'] ?? '')
                            <input class="form-control"
                                   id="search-input"
                                   type="text"
                                   value="{{$param}}"
                                   placeholder="Поиск..."
                                   aria-label="Поиск">
                            <div class="input-group-append">
                                <button class="btn btn-info" onclick="filter(this, 'name')" type="submit">
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
                            @php($direction = $sort && $sort{0} === '-' ? 'desc' : 'asc')
                            <div class="col-6">
                                <select onchange="sort()" class="custom-select" id="sort-columns">
                                    <option disabled {{!$col ? 'selected' : ''}}>Сортировать по...</option>
                                    <option value="id" {{$col === 'id' ? 'selected' : ''}}>Id</option>
                                    <option value="name" {{$col === 'name' ? 'selected' : ''}}>Грант ёки буюртма номи
                                    </option>
                                    <option value="year" {{$col === 'year' || !$sort ? 'selected' : ''}}>Грант ёки
                                        буюртма йил
                                    </option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group">
                                    <select onchange="sort()" class="custom-select" name="" id="sort-directions">
                                        <option {{$direction === 'asc'  || $sort ? 'selected' : ''}} value="asc">По
                                            возрастанию
                                        </option>
                                        <option
                                            {{$direction === 'desc' || !$sort ? 'selected' : ''}} value="desc">По
                                            убыванию
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-center">
                Давлат грантлари асосида ўтказилган тадқиқотлардан
                олинган маблағлар ҳақида
                <br>МАЪЛУМОТ
            </h3>
            @include('partials.messages')
            <table class="table table-striped text-center table-bordered" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th rowspan="3" style="width: 60px" data-type="number" class="position-relative">
                        <div class="d-flex justify-content-between align-items-center absolute-positions">
                            Id
                        </div>
                    </th>
                    <th colspan="4">Сўм ҳисобида</th>
                    <th rowspan="3" style="width: 8%;">Йил</th>
                    <th rowspan="3" style="width: 8%;"></th>
                </tr>
                <tr>
                    <th colspan="3">Давлат грантлари асосида ўтказилган тадқиқотлар*</th>
                    <th rowspan="2">Жами суммаси</th>
                </tr>
                <tr>
                    <th>Давлат гранти мавзуси номи</th>
                    <th>Суммаси</th>
                    <th>Лойиҳа раҳбари</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->user->full_name_abbr}}</td>
                        <td>{{$order->full_price}}</td>
                        <td>{{$order->year}}</td>
                        <td>
                            @can($permissions['edit'])
                                <a href="{{route('state_grant_fund.edit', $order->id)}}"
                                   class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endcan
                            @can($permissions['delete'])
                                <a href="javascript:void(0)"
                                   data-toggle="modal"
                                   data-target="#modal-delete"
                                   onclick="setFormAction('{{$order->id}}')"
                                   class="btn btn-danger btn-flat btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$orders->links('components.pagination')}}
        </div>
    </div>
    @can($permissions['delete'])
        <x-delete :url="route('state_grant_fund.delete', 'ID')"/>
    @endcan
@endsection
