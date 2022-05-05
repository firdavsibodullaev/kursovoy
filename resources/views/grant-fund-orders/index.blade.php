@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('grant_fund_order.index')}}">
    <meta name="filter" content="{{route('grant_fund_order.index')}}">
@endsection
@section('title', ' Грантлар ва илмий фондлар маблағлари')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item active">Грантлар ва илмий фондлар маблағлари</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
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
                                        <option {{$direction === 'asc'  || $sort ? 'selected' : ''}} value="asc">По возрастанию
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
                Навоий давлат кончилик институтида
                Хорижий илмий тадқиқот марказлари грантлари ва хорижий
                илмий фондлари буюртмалари ҳисобига олинган маблағлар бўйича
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
                    <th colspan="3">Сўм ҳисобида</th>
                    <th rowspan="3" style="width: 8%;">Йил</th>
                    <th rowspan="3" style="width: 8%;"></th>
                </tr>
                <tr>
                    <th colspan="2">Хорижий илмий тадқиқот марказлари грантлари ва хорижий илмий фондлари буюртмалари*
                    </th>
                    <th rowspan="2">Жами суммаси</th>
                </tr>
                <tr>
                    <th>Грант ёки буюртма номи</th>
                    <th>Суммаси</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->full_price}}</td>
                        <td>{{$order->year}}</td>
                        <td>
                            <a href="{{route('grant_fund_order.edit', $order->id)}}"
                               class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$order->id}}')"
                               class="btn btn-danger btn-flat btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$orders->links('components.pagination')}}
        </div>
    </div>
    <x-delete :url="route('grant_fund_order.delete', 'ID')"/>
@endsection
