<div class="card card-primary">
    <div class="card-body">
        <div class="col-12">
            <h4>Илмий мақолаларга иқтибослар (1.5-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="scientificArticleCitationsPieChart_year"
                                        onchange="getScientificArticleCitationPieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="scientificArticleCitationsPieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="scientificArticleCitationsByFacultyPieChart_faculty"
                                                onchange="getScientificArticleCitationByFacultyPieChart(true)"
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
                                        @php($year = get_year_select_options())
                                        <select id="scientificArticleCitationsByFacultyPieChart_year"
                                                onchange="getScientificArticleCitationByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
                                    <canvas id="scientificArticleCitationsByFacultyPieChart"
                                            class="charts mb-3"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h4>Илмий мақолалар (1.6.1-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="scientificArticlesPieChart_year"
                                        onchange="getScientificArticlePieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
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
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
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
                                        @php($year = get_year_select_options())
                                        <select id="scientificArticlesByFacultyPieChart_year"
                                                onchange="getScientificArticleByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
        <div class="col-12">
            <h4>Илмий мақолалар (ОАК рўйхатидаги) (1.6.2-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="oakScientificArticlePieChart_year"
                                        onchange="getOakScientificArticlePieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="oakScientificArticlePieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="oakScientificArticleByFacultyPieChart_faculty"
                                                onchange="getOakScientificArticleByFacultyPieChart(true)"
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
                                        @php($year = get_year_select_options())
                                        <select id="oakScientificArticleByFacultyPieChart_year"
                                                onchange="getOakScientificArticleByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
                                    <canvas id="oakScientificArticleByFacultyPieChart" class="charts mb-3"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h4>Илмий-тадқиқот ишларининг самарадорлиги (1.9.1-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="scientificResearchEffectivenessPieChart_year"
                                        onchange="getScientificResearchEffectivenessPieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="scientificResearchEffectivenessPieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="scientificResearchEffectivenessByFacultyPieChart_faculty"
                                                onchange="getScientificResearchEffectivenessByFacultyPieChart(true)"
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
                                        @php($year = get_year_select_options())
                                        <select id="scientificResearchEffectivenessByFacultyPieChart_year"
                                                onchange="getScientificResearchEffectivenessByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
                                    <canvas id="scientificResearchEffectivenessByFacultyPieChart"
                                            class="charts mb-3"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h4>Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар (1.9.2-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="obtainedIndustrialSamplePatentPieChart_year"
                                        onchange="obtainedIndustrialSamplePatentPieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="obtainedIndustrialSamplePatentPieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="obtainedIndustrialSamplePatentByFacultyPieChart_faculty"
                                                onchange="obtainedIndustrialSamplePatentByFacultyPieChart(true)"
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
                                        @php($year = get_year_select_options())
                                        <select id="obtainedIndustrialSamplePatentByFacultyPieChart_year"
                                                onchange="obtainedIndustrialSamplePatentByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
                                    <canvas id="obtainedIndustrialSamplePatentByFacultyPieChart"
                                            class="charts mb-3"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h4>Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар (1.9.3-жадвал)</h4>
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
                                @php($year = get_year_select_options())
                                <select id="copyrightProtectedVariousInformationPieChart_year"
                                        onchange="getCopyrightProtectedVariousInformationPieChart(true)"
                                        class="custom-select">
                                    <option value="">Барчаси</option>
                                    @foreach($year as $option)
                                        {!! $option !!}
                                    @endforeach
                                </select>
                            </div>
                            <div class="small-box">
                                <!-- Loading (remove the following to stop the loading)-->
                                <div class="overlay">
                                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                                </div>
                                <!-- end loading -->
                                <div class="inner">
                                    <canvas id="copyrightProtectedVariousInformationPieChart" class="mb-3 charts"></canvas>
                                </div>
                                <p class="p-3"><strong>Умумий сони:</strong> <span class="number"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-gradient-primary text-center">
                            <div class="card-title">
                                Кафедралар миқёсида
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select id="copyrightProtectedVariousInformationByFacultyPieChart_faculty"
                                                onchange="getCopyrightProtectedVariousInformationByFacultyPieChart(true)"
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
                                        @php($year = get_year_select_options())
                                        <select id="copyrightProtectedVariousInformationByFacultyPieChart_year"
                                                onchange="getCopyrightProtectedVariousInformationByFacultyPieChart(true)"
                                                class="custom-select">
                                            <option value="">Барчаси</option>
                                            @foreach($year as $option)
                                                {!! $option !!}
                                            @endforeach
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
                                    <canvas id="copyrightProtectedVariousInformationByFacultyPieChart"
                                            class="charts mb-3"></canvas>
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
            getScientificArticleCitationByFacultyPieChart();
            getScientificArticleCitationPieChart();
            getOakScientificArticlePieChart();
            getOakScientificArticleByFacultyPieChart();
            getScientificResearchEffectivenessPieChart();
            getScientificResearchEffectivenessByFacultyPieChart();
            obtainedIndustrialSamplePatentPieChart();
            obtainedIndustrialSamplePatentByFacultyPieChart();
            getCopyrightProtectedVariousInformationPieChart();
            getCopyrightProtectedVariousInformationByFacultyPieChart();
        });
    </script>
@endsection
