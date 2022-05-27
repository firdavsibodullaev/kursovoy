@extends('layout')
@section('title', 'Грантлар ва илмий фондлар маблағлари')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('grant_fund_order.index')}}">Грантлар ва илмий фондлар маблағлари</a>
    </li>
    <li class="breadcrumb-item active">Маблағ қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('grant_fund_order.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="year">Грант ёки буюртма йили</label>
                    @php($year = get_year_select_options(old('year')))
                    <select name="year"
                            data-placeholder="Грант ёки буюртма йилини танланг"
                            class="select2 w-100"
                            required
                            id="year">
                        <option></option>
                        @foreach($year as $option)
                            {!! $option !!}
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Грант ёки буюртма номи</label>
                    <textarea name="name"
                              id="name"
                              cols="30"
                              rows="5"
                              class="form-control"
                              placeholder="Грант ёки буюртма номини киритинг"
                              required>{{old('name')}}</textarea>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="price">Суммаси</label>
                            <input type="number"
                                   class="form-control"
                                   id="price"
                                   name="price"
                                   value="{{old('price')}}"
                                   placeholder="Суммасини киритинг">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="full_price">Жами суммаси</label>
                            <input type="number"
                                   class="form-control"
                                   id="full_price"
                                   name="full_price"
                                   value="{{old('full_price')}}"
                                   placeholder="Жами суммасини киритинг">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-flat" value="Сақлаш">
                </div>
            </form>
        </div>
    </div>
@endsection
