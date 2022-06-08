@extends('layout')
@section('title', 'Илмий тадқиқотлар маблағлари')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('scientific_research_conduct.index')}}">Илмий тадқиқотлар
            маблағлари</a>
    </li>
    <li class="breadcrumb-item active">Маблағ қўшиш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('scientific_research_conduct.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label for="year">Буюртма йили</label>
                    @php($year = get_year_select_options(old('year')))
                    <select name="year"
                            data-placeholder="Буюртма йилини танланг"
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
                    <label for="name">Буюртма номи</label>
                    <textarea name="name"
                              id="name"
                              cols="30"
                              rows="5"
                              class="form-control"
                              placeholder="Буюртма номини киритинг"
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
                    <label for="user_id">Лойиҳа раҳбари</label>
                    <select name="user_id" data-placeholder="Лойиҳа раҳбарини танланг" id="user_id"
                            class="select2 w-100">
                        <option></option>
                        @foreach($users as $user)
                            <option
                                {{(old('user_id') == $user->id) ? 'selected' : ''}}
                                value="{{$user->id}}"
                            >{{$user->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-flat" value="Сақлаш">
                </div>
            </form>
        </div>
    </div>
@endsection
