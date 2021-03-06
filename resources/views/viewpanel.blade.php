<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'admin panel') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- navbar -->
        @include('layouts/header')
        <!-- Sidebar -->
        @include('layouts/sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>???????????????? ????????????</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Projects</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">???????????????? ????????/????????????/??????????????/?????????????????????? ?????? ????????????????????????????</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 1%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        ????????????????
                                    </th>
                                    <th style="width: 30%">
                                        ?????????????????????????? ????????
                                    </th>
                                    <th>
                                        ???????????????? ???????????????????? ??????????????
                                    </th>
                                    <th style="width: 8%" class="text-center">
                                        ???????????? ??????????????
                                    </th>
                                    <th style="width: 20%">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <a>
                                                {{ $record->title }}
                                            </a>
                                            <br />
                                            <small>
                                                ???????? ???????????????? {{ Date::parse($record->created_at)->format('d-m-Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            {{ $record->author_id == 'admin' ? 'admin' : $record->author_id->role . ' , ' . $record->author_id->fullname . ' ' . $record->author_id->lastname }}
                                        </td>
                                        <td class="project_progress">
                                            <div class="progress progress-sm">
                                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                                </div>
                                            </div>
                                            <small>
                                                {{ rand(0, 99) }}% ????????????????????
                                            </small>
                                        </td>
                                        <td class="project-state">

                                            @if ($record->status == 'taken')
                                                <span class="badge badge-success">
                                                    ??????????????
                                                </span>
                                            @endif

                                            @if ($record->status == 'offered')
                                                <span class="badge badge-warning">
                                                    ???? ????????????????????????
                                                </span>
                                            @endif

                                            @if ($record->status == 'dismissed')
                                                <span class="badge badge-danger">
                                                    ??????????????????
                                                </span>
                                            @endif
                                        </td>

                                        <td class="project-actions text-right">
                                            <form action="{{ route('viewpanelTake') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $record->name }}" name="name">
                                                <input type="hidden" value="{{ $record->id }}" name="id">
                                                <input class="btn btn-primary btn-sm" type="submit" value="????????????">
                                            </form>
                                            <form action="{{ route('viewpanelOffer') }}" method="post">
                                                @csrf
                                                <input type="text" name="description" value="{{ $record->description }}">
                                                <input type="hidden" value="{{ $record->name }}" name="name">
                                                <input type="hidden" value="{{ $record->id }}" name="id">
                                                <input class="btn btn-info btn-sm" type="submit" value="??????????????????">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->




        <footer class="main-footer">


            <!-- jQuery -->
            <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <!-- ChartJS -->
            <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
            <!-- Sparkline -->
            <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
            <!-- JQVMap -->
            <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
            <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
            <!-- daterangepicker -->
            <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
            <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
            <!-- Summernote -->
            <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
            <!-- overlayScrollbars -->
            <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
            <!-- AdminLTE App -->
            <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
            <!-- AdminLTE for demo purposes -->

            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>

            <script>
                $(function() {
                    /* ChartJS
                     * -------
                     * Here we will create a few charts using ChartJS
                     */

                    //--------------
                    //- AREA CHART -
                    //--------------

                    // Get context with jQuery - using jQuery's .get() method.
                    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

                    var areaChartData = {
                        labels: ['????????????', '??????????????', '????????', '????????????', '??????', '????????', '????????'],
                        datasets: [{
                                label: 'Digital Goods',
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: false,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(60,141,188,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data: [28, 48, 40, 19, 86, 27, 90]
                            },
                            {
                                label: 'Electronics',
                                backgroundColor: 'rgba(210, 214, 222, 1)',
                                borderColor: 'rgba(210, 214, 222, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(210, 214, 222, 1)',
                                pointStrokeColor: '#c1c7d1',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data: [65, 59, 80, 81, 56, 55, 40]
                            },
                        ]
                    }

                    var areaChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }]
                        }
                    }

                    // This will get the first returned node in the jQuery collection.
                    new Chart(areaChartCanvas, {
                        type: 'line',
                        data: areaChartData,
                        options: areaChartOptions
                    })

                    //-------------
                    //- LINE CHART -
                    //--------------
                    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
                    var lineChartOptions = $.extend(true, {}, areaChartOptions)
                    var lineChartData = $.extend(true, {}, areaChartData)
                    lineChartData.datasets[0].fill = false;
                    lineChartData.datasets[1].fill = false;
                    lineChartOptions.datasetFill = false

                    var lineChart = new Chart(lineChartCanvas, {
                        type: 'line',
                        data: lineChartData,
                        options: lineChartOptions
                    })

                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                    var donutData = {
                        labels: [
                            'Chrome',
                            'IE',
                            'FireFox',
                            'Safari',
                            'Opera',
                            'Navigator',
                        ],
                        datasets: [{
                            data: [700, 500, 400, 600, 300, 100],
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }]
                    }
                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    })

                    //-------------
                    //- PIE CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var pieData = donutData;
                    var pieOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(pieChartCanvas, {
                        type: 'pie',
                        data: pieData,
                        options: pieOptions
                    })

                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    barChartData.datasets[0] = temp1
                    barChartData.datasets[1] = temp0

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false
                    }

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })

                    //---------------------
                    //- STACKED BAR CHART -
                    //---------------------
                    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                    var stackedBarChartData = $.extend(true, {}, barChartData)

                    var stackedBarChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                stacked: true,
                            }],
                            yAxes: [{
                                stacked: true
                            }]
                        }
                    }

                    new Chart(stackedBarChartCanvas, {
                        type: 'bar',
                        data: stackedBarChartData,
                        options: stackedBarChartOptions
                    })
                })
            </script>

</body>

</html>
