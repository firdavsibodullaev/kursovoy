@extends('layout')
@section('title', 'Илмий тадқиқотлар маблағлари')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('scientific_research_conduct.index')}}">Илмий тадқиқотлар маблағлари</a>
    </li>
    <li class="breadcrumb-item active">Маблағни таҳрирлаш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('scientific_research_conduct.update', $order->id)}}" method="post" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="year">Грант ёки буюртма йили</label>
                    <select class="custom-select" name="year" id="year">
                        <option disabled>Грант ёки буюртма йилини танланг
                        </option>
                        @for($i = 2000; $i<=date('Y');$i++)
                            <option {{$order->year == $i ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                        @endfor
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
                              required>{{$order->name}}</textarea>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="price">Суммаси</label>
                            <input type="number"
                                   class="form-control"
                                   id="price"
                                   name="price"
                                   value="{{$order->price}}"
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
                                   value="{{$order->full_price}}"
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
