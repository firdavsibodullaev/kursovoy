<div class="card card-primary">
    <div class="card-body">
        <div class="col-12">
            <h4>Илмий мақолалар</h4>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Факультетлар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select id="scientificArticlesPieChart_year"
                                        onchange="getScientificArticlePieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @for($i = 2015; $i <= date('Y'); $i++)
                                        <option value="{{$i}}">{{$i}} йил</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="scientificArticlesPieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-tools">
                                <div class="card-title">
                                    Кафедралар миқёсида
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="scientificArticlesByFacultyPieChart_faculty"
                                                onchange="getScientificArticleByFacultyPieChart(true)"
                                                class="custom-select">
                                            @foreach($faculties as $faculty)
                                                <option
                                                    {{$loop->first ? 'selected' : ''}}
                                                    value="{{$faculty->id}}">{{$faculty->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="scientificArticlesByFacultyPieChart_year"
                                                onchange="getScientificArticleByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @for($i = 2015; $i <= date('Y'); $i++)
                                                <option value="{{$i}}">{{$i}} йил</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="scientificArticlesByFacultyPieChart" class="charts mb-3"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('style')
    <style>
        .charts {
            min-height: 250px;
            height: 250px;
            max-height: 250px;
            max-width: 100%;
        }
    </style>
@endsection
@section('js')
    <script>
        $(function () {
            getScientificArticlePieChart();
            getScientificArticleByFacultyPieChart();
        });
    </script>
@endsection
