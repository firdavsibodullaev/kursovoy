var createScientificArticlesPieChart__var = null,
    getScientificArticleByFacultyPieChart__var = null,
    scientificArticleCitationsByFacultyPieChart__var = null,
    createScientificArticleCitationsPieChart__var = null,
    oakScientificArticleCitationsByFacultyPieChart__var = null,
    createOakScientificArticleCitationsPieChart__var = null,
    createScientificResearchEffectivenessPieChart__var = null,
    scientificResearchEffectivenessByFacultyPieChart__var = null;

const getScientificArticlePieChart = function (is_update = false) {

    let scientificArticlesPieChart = $('#scientificArticlesPieChart');
    let year = $('#scientificArticlesPieChart_year').val();
    scientificArticlesPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-articles-report?year=${year ? year : ''}`,
        type: 'get',
        success({data}) {
            scientificArticlesPieChart.parent().prev().addClass('d-none');
            scientificArticlesPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                createScientificArticlesPieChart__var = createScientificArticlesPieChart(scientificArticlesPieChart, data);
                return;
            }

            updateScientificArticlesPieChart(createScientificArticlesPieChart__var, data);
        }
    });
}

const getScientificArticleByFacultyPieChart = function (is_update = false) {
    let scientificArticlesByFacultyPieChart = $('#scientificArticlesByFacultyPieChart');
    let year = $('#scientificArticlesByFacultyPieChart_year').val();
    let faculty = $('#scientificArticlesByFacultyPieChart_faculty').val();
    scientificArticlesByFacultyPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-articles-report-by-faculty?yaer=${year ? year : ''}&faculty=${faculty ? faculty : ''}`,
        type: 'get',
        success({data}) {
            scientificArticlesByFacultyPieChart.parent().prev().addClass('d-none');
            scientificArticlesByFacultyPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                getScientificArticleByFacultyPieChart__var = createScientificArticlesPieChart(scientificArticlesByFacultyPieChart, data);
                return;
            }
            updateScientificArticlesPieChart(getScientificArticleByFacultyPieChart__var, data);
        }
    });
}

const getScientificArticleCitationPieChart = function (is_update = false) {
    let scientificArticlesPieChart = $('#scientificArticleCitationsPieChart');
    let year = $('#scientificArticleCitationsPieChart_year').val();
    scientificArticlesPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-article-citations-report?year=${year ? year : ''}`,
        type: 'get',
        success({data}) {
            scientificArticlesPieChart.parent().prev().addClass('d-none');
            scientificArticlesPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                createScientificArticleCitationsPieChart__var = createScientificArticlesPieChart(scientificArticlesPieChart, data);
                return;
            }

            updateScientificArticlesPieChart(createScientificArticleCitationsPieChart__var, data);
        }
    });
}

const getScientificArticleCitationByFacultyPieChart = function (is_update = false) {
    let scientificArticleCitationsByFacultyPieChart = $('#scientificArticleCitationsByFacultyPieChart');
    let year = $('#scientificArticleCitationsByFacultyPieChart_year').val();
    let faculty = $('#scientificArticleCitationsByFacultyPieChart_faculty').val();
    scientificArticleCitationsByFacultyPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-article-citations-report-by-faculty?yaer=${year ? year : ''}&faculty=${faculty ? faculty : ''}`,
        type: 'get',
        success({data}) {
            scientificArticleCitationsByFacultyPieChart.parent().prev().addClass('d-none');
            scientificArticleCitationsByFacultyPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                scientificArticleCitationsByFacultyPieChart__var = createScientificArticlesPieChart(scientificArticleCitationsByFacultyPieChart, data);
                return;
            }
            updateScientificArticlesPieChart(scientificArticleCitationsByFacultyPieChart__var, data);
        }
    });
}

const getOakScientificArticlePieChart = function (is_update = false) {
    let scientificArticlesPieChart = $('#oakScientificArticlePieChart');
    let year = $('#oakScientificArticlePieChart_year').val();
    scientificArticlesPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-oak-article-report?year=${year ? year : ''}`,
        type: 'get',
        success({data}) {
            scientificArticlesPieChart.parent().prev().addClass('d-none');
            scientificArticlesPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                createOakScientificArticleCitationsPieChart__var = createScientificArticlesPieChart(scientificArticlesPieChart, data);
                return;
            }

            updateScientificArticlesPieChart(createOakScientificArticleCitationsPieChart__var, data);
        }
    });
}

const getOakScientificArticleByFacultyPieChart = function (is_update = false) {
    let scientificArticleCitationsByFacultyPieChart = $('#oakScientificArticleByFacultyPieChart');
    let year = $('#oakScientificArticleByFacultyPieChart_year').val();
    let faculty = $('#oakScientificArticleByFacultyPieChart_faculty').val();
    scientificArticleCitationsByFacultyPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-oak-article-report-by-faculty?yaer=${year ? year : ''}&faculty=${faculty ? faculty : ''}`,
        type: 'get',
        success({data}) {
            scientificArticleCitationsByFacultyPieChart.parent().prev().addClass('d-none');
            scientificArticleCitationsByFacultyPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                oakScientificArticleCitationsByFacultyPieChart__var = createScientificArticlesPieChart(scientificArticleCitationsByFacultyPieChart, data);
                return;
            }
            updateScientificArticlesPieChart(oakScientificArticleCitationsByFacultyPieChart__var, data);
        }
    });
}

const getScientificResearchEffectivenessPieChart = function (is_update = false) {
    let scientificArticlesPieChart = $('#scientificResearchEffectivenessPieChart');
    let year = $('#scientificResearchEffectivenessPieChart_year').val();
    scientificArticlesPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-scientific-research-effectiveness?year=${year ? year : ''}`,
        type: 'get',
        success({data}) {
            scientificArticlesPieChart.parent().prev().addClass('d-none');
            scientificArticlesPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                createScientificResearchEffectivenessPieChart__var = createScientificArticlesPieChart(scientificArticlesPieChart, data);
                return;
            }

            updateScientificArticlesPieChart(createScientificResearchEffectivenessPieChart__var, data);
        }
    });
}

const getScientificResearchEffectivenessByFacultyPieChart = function (is_update = false) {
    let scientificArticleCitationsByFacultyPieChart = $('#scientificResearchEffectivenessByFacultyPieChart');
    let year = $('#scientificResearchEffectivenessByFacultyPieChart_year').val();
    let faculty = $('#scientificResearchEffectivenessByFacultyPieChart_faculty').val();
    scientificArticleCitationsByFacultyPieChart.parent().prev().removeClass('d-none');
    $.ajax({
        url: `${location.origin}/report/get-scientific-research-effectiveness-by-faculty?yaer=${year ? year : ''}&faculty=${faculty ? faculty : ''}`,
        type: 'get',
        success({data}) {
            scientificArticleCitationsByFacultyPieChart.parent().prev().addClass('d-none');
            scientificArticleCitationsByFacultyPieChart.parent().next('p').find('.number').text(data.all);
            if (!is_update) {
                scientificResearchEffectivenessByFacultyPieChart__var = createScientificArticlesPieChart(scientificArticleCitationsByFacultyPieChart, data);
                return;
            }
            updateScientificArticlesPieChart(scientificResearchEffectivenessByFacultyPieChart__var, data);
        }
    });
}

const updateScientificArticlesPieChart = function (scientificArticlesPieChart, data) {
    scientificArticlesPieChart.data.labels = data.donutData.labels;
    scientificArticlesPieChart.data.datasets[0].data = data.donutData.datasets[0].data;
    scientificArticlesPieChart.update();
}

const createScientificArticlesPieChart = function (scientificArticlesPieChart, data) {
    var scientificArticlesPieChartCanvas = scientificArticlesPieChart.get(0).getContext('2d')
    var pieData = data.donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }

    return new Chart(scientificArticlesPieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    });

}
