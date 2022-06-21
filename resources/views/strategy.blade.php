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
                            <h1>Стратегии компании</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">General Form</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Создание стратегий </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('strategyStore') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Название стратегии</label>
                                            <input type="text" class="form-control" placeholder="Название цели" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Описание</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Опиание">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Прикрепить файл</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Ответсвтенное лицо</label>
                                                <select class="form-control">
                                                    <option>Андрей Иванович Старчеков</option>
                                                    <option>Груздев Максим Алекеевич</option>
                                                    <option>Краснов Игорь Михайлович </option>
                                                    <option>Даниленок Илья Вадимович</option>
                                                    <option>Баринов Максим Евгеньевич</option>
                                                </select>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Загрузить</span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Сроки исполнения</label>
                                                <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Введите количество дней">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Создать стратегию</button>
                                    </div>
                            </div>
                            <!-- /.card-body -->


                            </form>
                        </div>
                        <!-- /.card -->

                        <!-- Control Sidebar -->
                        <aside class="control-sidebar control-sidebar-dark">
                            <!-- Control sidebar content goes here -->
                        </aside>
                        <!-- /.control-sidebar -->
                    </div>
                    <!-- ./wrapper -->

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
</body>

</html>
