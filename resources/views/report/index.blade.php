<div class="card card-primary">
    <div class="card-body">
        <canvas id="pieChart"></canvas>
    </div>
</div>
@section('style')
    <style>
        #pieChart {
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
            // $.ajax({
            //     url: `${location.origin}/report/get-articles-report`,
            //     type: 'get',
            //     success(response) {
            //     }
            // });
            createPieChart();
        });

        const createPieChart = function (data) {
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [
                    {
                        data: [700, 500, 400, 600, 300, 100],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            }
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            });
        }
    </script>
@endsection
