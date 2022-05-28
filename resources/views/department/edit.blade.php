@extends('layout')
@section('title', 'Тахрирлаш')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош сахифа</a></li>
    <li class="breadcrumb-item"><a href="{{route('department.index')}}">Факультетлар</a></li>
    <li class="breadcrumb-item active">Тахрирлаш</li>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="text-center">
                {{$department->full_name}}
            </h3>
            @include('partials.messages')
            <form action="{{route('department.update', $department->id)}}" method="post">
                @method('put')
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
                                {{$department->faculty_id == $faculty->id ? 'selected' : ''}}
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
                                   value="{{$department->getTranslation('full_name','uz', false)}}"
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
                                   value="{{$department->getTranslation('full_name','oz', false)}}"
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
                                   value="{{$department->getTranslation('full_name','ru', false)}}"
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
                                   value="{{$department->getTranslation('full_name','en', false)}}"
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
                                   value="{{$department->getTranslation('short_name','uz', false)}}"
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
                                   value="{{$department->getTranslation('short_name','oz', false)}}"
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
                                   value="{{$department->getTranslation('short_name','ru', false)}}"
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
                                   value="{{$department->getTranslation('short_name','en', false)}}"
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
