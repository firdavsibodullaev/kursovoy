var createScientificArticlesPieChart__var = null,
    getScientificArticleByFacultyPieChart__var = null;

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

const updateScientificArticlesPieChart = function (scientificArticlesPieChart, data) {
    scientificArticlesPieChart.data.labels = data.donutData.labels;
    scientificArticlesPieChart.data.datasets[0].data = data.donutData.datasets[0].data;
    scientificArticlesPieChart.data.datasets[0].backgroundColor = data.donutData.datasets[0].backgroundColor;
    scientificArticlesPieChart.update();
}
