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
                            <h1>Сотрудники</h1>
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
                                    <h3 class="card-title">Добавить сотрудник </h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" action="{{ route('personalStore') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Login</label>
                                            <input type="text" class="form-control" name="login">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label>Имя </label>
                                            <input type="text" class="form-control" name="fullname">
                                        </div>
                                        <div class="form-group">
                                            <label>Фамилия</label>
                                            <input type="text" class="form-control" name="lastname">
                                        </div>
                                        <div class="form-group">
                                            <label>Должность</label>
                                            <select class="custom-select" name="role">
                                                <option value="director">Директор </option>
                                                <option value="manager_goals">Менеджер целей </option>
                                                <option value="manager_tactic">Менеджер задач </option>
                                                <option value="manager_projects">Менеджер мероприятий </option>
                                                <option value="manager_members">Менеджер персонала </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Добавить</button>
                                    </div>
                            </div>
                            <!-- /.card-body -->


                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Login</th>
                                                <th>Password</th>
                                                <th>Имя</th>
                                                <th>Фамилия</th>
                                                <th>Должность</th>
                                                <th>Действие</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($personals as $personal)
                                                <tr>
                                                    <td>{{ $personal->id }}</td>
                                                    <td>{{ $personal->login }}</td>
                                                    <td>{{ $personal->password }}</td>
                                                    <td>{{ $personal->fullname }}</td>
                                                    <td>{{ $personal->lastname }}</td>
                                                    <td>{{ $personal->role }}</td>
                                                    <td>
                                                        <form action="{{ route('personalDelete', $personal->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" value="Удалить">
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
                        </div>
                    </div>
                    <!-- Control Sidebar -->
                    <aside class="control-sidebar control-sidebar-dark">
                        <!-- Control sidebar content goes here -->
                    </aside>
                    <!-- /.control-sidebar -->
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
