@extends('layout')
@section('title', 'Excel')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('index')}}">Бош саҳифа</a></li>
    <li class="breadcrumb-item active">Excel</li>
@endsection
@section('content')
    @php($current_year = date('Y'))
    <div class="card">
        <div class="card-body">
            <form action="{{route('excel_export')}}" method="get">
                <div class="col-12">
                    <h4>Илмий мақолаларга иқтибослар (1.5-жадвал)</h4>
                    <div class="form-group">
                        <label for="citation_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="citation_year"
                                name="citation_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Илмий мақолалар (1.6.1-жадвал)</h4>
                    <div class="form-group">
                        <label for="scientific_article_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="scientific_article_year"
                                name="scientific_article_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Илмий мақолалар (ОАК рўйхатидаги) (1.6.2-жадвал)</h4>
                    <div class="form-group">
                        <label for="oak_scientific_article_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="oak_scientific_article_year"
                                name="oak_scientific_article_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Грантлар ва илмий фондлар маблағлари (1.7.1-жадвал)</h4>
                    <div class="form-group">
                        <label for="grant_fund_order_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="grant_fund_order_year"
                                name="grant_fund_order_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Илмий тадқиқотлар маблағлари (1.7.2-жадвал)</h4>
                    <div class="form-group">
                        <label for="scientific_research_conduct_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="scientific_research_conduct_year"
                                name="scientific_research_conduct_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Давлат грантлари асосида ўтказилган тадқиқотлар маблағлар (1.7.3-жадвал)</h4>
                    <div class="form-group">
                        <label for="state_grant_fund_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="state_grant_fund_year"
                                name="state_grant_fund_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Илмий-тадқиқот ишларининг самарадорлиги (1.9.1-жадвал)</h4>
                    <div class="form-group">
                        <label for="scientific_research_effectiveness_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="scientific_research_effectiveness_year"
                                name="scientific_research_effectiveness_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Профессор-ўқитувчилар томонидан ихтиролари учун олинган патентлар (1.9.2-жадвал)</h4>
                    <div class="form-group">
                        <label for="obtained_industrial_sample_patent_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="obtained_industrial_sample_patent_year"
                                name="obtained_industrial_sample_patent_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <h4>Гувоҳномалар, муаллифлик ҳуқуқи билан ҳимоя қилинадиган турли материаллар (1.9.3-жадвал)</h4>
                    <div class="form-group">
                        <label for="copyright_protected_various_material_information_year">Йил бўйича</label>
                        @php($year = get_year_select_options($current_year))
                        <select id="copyright_protected_various_material_information_year"
                                name="copyright_protected_various_material_information_year"
                                class="custom-select">
                            <option value="">Барчаси</option>
                            @foreach($year as $option)
                                {!! $option !!}
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-flat">Юклаб олиш</button>
                </div>
            </form>
        </div>
    </div>
@endsection
