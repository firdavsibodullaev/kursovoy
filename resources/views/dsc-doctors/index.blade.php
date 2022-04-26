@extends('layout')
@section('meta')
    <meta name="sort" content="{{route('dsc_doctors.index')}}">
    <meta name="filter" content="{{route('dsc_doctors.index')}}">
@endsection
@section('title', 'Фан номзодлари')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item active">Фан номзодлари</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    @php($param = request('filter', '')['user'] ?? '')
                    <div class="search-block w-100 mb-3">
                        <div class="input-group input-group">
                            @php($param = request('filter', '')['user'] ?? '')
                            <input class="form-control"
                                   id="search-input"
                                   type="text"
                                   value="{{$param}}"
                                   placeholder="Поиск..."
                                   aria-label="Поиск">
                            <div class="input-group-append">
                                <button class="btn btn-info" onclick="filter(this, 'user')" type="submit">
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
                                    <option value="user" {{$col === 'user' ? 'selected' : ''}}>ФИО</option>
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
                Навоий давлат кончилик институтида
                фан доктори (DSc-фан доктори) илмий даражасига эга (шунингдек, илмий даражага эга бўлмай профессор
                илмий унвонини олган ёки унга тенглаштирилган) профессор-ўқитувчилар ҳақида
                МАЪЛУМОТ
            </h3>
            @include('partials.messages')
            <table class="table table-striped text-center table-bordered" id="users-list">
                <thead class="thead-dark">
                <tr>
                    <th style="width: 60px" data-type="number" class="position-relative">
                        <div class="d-flex justify-content-between align-items-center absolute-positions">
                            Id
                        </div>
                    </th>
                    <th data-type="string">
                            Асосий штатдаги профессор-ўқитувчиларнинг Ф.И.Ш (алфавит тартибида тўлиқ ёзилади)
                    </th>
                    <th class="" data-type="string">
                        Фан номзоди дипломи
                    </th>
                    <th class="w-25" data-type="string">
                        Илмий даражага эга бўлмай доцент
                        илмий унвонини олган ёки унга тенглаштирилганнинг дипломи
                    </th>
                    <th class="position-relative" style="width: 15%;">
                        <span class="d-flex absolute-positions justify-content-center align-items-center">
                            Мутахассислиги номи
                        </span>
                    </th>
                    <th style="width: 15%;">
                        Ишга қабул қилинганлиги тўғрисидаги буйруқ рақами ва санаси
                    </th>
                    <th style="width: 8%;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{$doctor->id}}</td>
                        <td>
                            {{$doctor->user_full_name}}
                        </td>
                        <td>
                            {{$doctor->diploma_formatted}}
                        </td>
                        <td>
                            {{$doctor->diploma_without_science_degree_formatted}}
                        </td>
                        <td>
                            {{$doctor->speciality_name}}
                        </td>
                        <td>
                            {{$doctor->employment_formatted}}
                        </td>
                        <td>
                            <a href="{{route('dsc_doctors.edit', $doctor->id)}}" class="btn btn-warning btn-flat btn-sm">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="javascript:void(0)"
                               data-toggle="modal"
                               data-target="#modal-delete"
                               onclick="setFormAction('{{$doctor->id}}')"
                               class="btn btn-danger btn-flat btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$doctors->links('components.pagination')}}
        </div>
    </div>
    <x-delete :url="route('dsc_doctors.delete', 'ID')"/>
@endsection
