@extends('layout')
@section('title', 'Янги кафедра')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('department.index')}}">Кафедралар</a></li>
    <li class="breadcrumb-item active">Янги кафедра</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            @include('partials.messages')
            <form action="{{route('department.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="faculty_id">Факультет</label>
                    <select name="faculty_id"
                            id="faculty_id"
                            class="select2 w-100"
                            data-placeholder="Факультетни танланг"
                            required>
                        <option></option>
                        @foreach($faculties as $faculty)
                            <option
                                {{old('faculty_id') == $faculty->id ? 'selected' : ''}}
                                value="{{$faculty->id}}">{{$faculty->full_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full_name_uz">Тўлиқ номи (лотинча)</label>
                            <input type="text"
                                   name="full_name_uz"
                                   id="full_name_uz"
                                   class="form-control"
                                   placeholder="Тўлиқ номини (лотинча) киритинг"
                                   value="{{old('full_name_uz')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full_name_oz">Тўлиқ номи (кирилча)</label>
                            <input type="text"
                                   name="full_name_oz"
                                   id="full_name_oz"
                                   class="form-control"
                                   placeholder="Тўлиқ номини (кирилча) киритинг"
                                   value="{{old('full_name_oz')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full_name_ru">Тўлиқ номи (руча)</label>
                            <input type="text"
                                   name="full_name_ru"
                                   id="full_name_ru"
                                   class="form-control"
                                   placeholder="Тўлиқ номини (руча) киритинг"
                                   value="{{old('full_name_ru')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="full_name_en">Тўлиқ номи (инглизча)</label>
                            <input type="text"
                                   name="full_name_en"
                                   id="full_name_en"
                                   class="form-control"
                                   placeholder="Тўлиқ номини (инглизча) киритинг"
                                   value="{{old('full_name_en')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="short_name_uz">Қисқа номи (лотинча)</label>
                            <input type="text"
                                   name="short_name_uz"
                                   id="short_name_uz"
                                   class="form-control"
                                   placeholder="Қисқа номини (лотинча) киритинг"
                                   value="{{old('short_name_uz')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="short_name_oz">Қисқа номи (кирилча)</label>
                            <input type="text"
                                   name="short_name_oz"
                                   id="short_name_oz"
                                   class="form-control"
                                   placeholder="Қисқа номини (кирилча) киритинг"
                                   value="{{old('short_name_oz')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="short_name_ru">Қисқа номи (руча)</label>
                            <input type="text"
                                   name="short_name_ru"
                                   id="short_name_ru"
                                   class="form-control"
                                   placeholder="Қисқа номини (руча) киритинг"
                                   value="{{old('short_name_ru')}}"
                                   required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="short_name_en">Қисқа номи (инглизча)</label>
                            <input type="text"
                                   name="short_name_en"
                                   id="short_name_en"
                                   class="form-control"
                                   placeholder="Қисқа номини (инглизча) киритинг"
                                   value="{{old('short_name_en')}}"
                                   required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-flat">Сақлаш</button>
                </div>
            </form>
        </div>
    </div>
@endsection
