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

    <script src="{{ URL::asset('js/main.js') }}"></script>

    <style>
        table {
            border-collapse: collapse;
            text-align: center;
        }

        tr {
            background-color: #DCE6F1;
        }

        td,
        th {
            border: 1px solid black;
            min-width: 20px;
            min-height: 20px;
            padding: 1em;
            max-width: 12em;
        }

        td[contenteditable],
        th[contenteditable] {
            cursor: pointer;
        }

        td:not(.white, .grey):hover,
        th:hover {
            background-color: #ffffff;
        }

        .white {
            background-color: white;
        }

        .title {
            font-style: italic;
            color: grey;
        }

        .wrapper {
            /* position: absolute; */
            /* background-color: red; */
            width: 1.5em;
            height: 1.5em;
            position: relative;
        }

        .rotate {
            transform: rotate(-90deg);
            display: flex;
            justify-content: center;
            text-align: center;
            position: absolute;
            width: inherit;
            /* background: green; */
            white-space: nowrap;
            /* margin-left:-50%; */
        }

        .center {
            padding: 35% 0;
        }

        .grey {
            background-color: #D9D9D9;
            cursor: auto;
        }

        .rose {
            background-color: #FDE9D9;
        }

        .red {
            background-color: #FF0000;
        }

        .yellow {
            background-color: #EEF86C;
        }

        .lgreen {
            background-color: #A4D76B;
        }

        .green {
            background-color: #00B050;
        }
    </style>
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
        {{-- redirect()->{{ '(home.default)' }} --}}

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid" style="padding-left:100px">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Матрица</h2>
                        </div>
                    </div>
                    <div class="btn btn-primary my-5" id="matrix-button">Редактировать</div>
                    <!-- --------------------- -->
                    <table>
                        <?php
                        foreach ($matrix as $item) {
                            echo '<tr>';
                            foreach ($item as $key => $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <hr>
                    <!-- --------------------- -->

                    <h2 class="h2">Цели/задачи</h2>
                    <table>
                        <?php
                        foreach ($rt_1['view'] as $item) {
                            echo '<tr>';
                            foreach ($item as $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <hr>
                    <h2 class="h2">Проекты/задачи</h2>
                    <table>
                        <?php
                        foreach ($rt_2['view'] as $item) {
                            echo '<tr>';
                            foreach ($item as $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <hr>
                    <h2 class="h2">Люди/задачи</h2>
                    <table>
                        <?php
                        foreach ($rt_3['view'] as $item) {
                            echo '<tr>';
                            foreach ($item as $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <hr>
                    <h2 class="h2">Цели/результаты</h2>
                    <table>
                        <?php
                        foreach ($rt_4['view'] as $item) {
                            echo '<tr>';
                            foreach ($item as $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>
                    <hr>
                    <h2 class="h2">Проекты/результаты</h2>
                    <table>
                        <?php
                        foreach ($rt_5['view'] as $item) {
                            echo '<tr>';
                            foreach ($item as $value2) {
                                echo $value2;
                            }
                            echo '</tr>';
                        }
                        ?>
                    </table>

                </div>
            </section>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        let tableItems = document.querySelectorAll('td:not(.white,.grey)');
        let valuesData = {};
        let s, c, t;
        tableItems.forEach(element => {
            fillColor(element);
            element.addEventListener('input', function(e) {
                fillColor(element);
                t = element.dataset.relation;
                s = element.dataset.string;
                c = element.dataset.column;
                v = element.innerText;

                valuesData[t + '_' + s + '_' + c] = {
                    't': t,
                    's': s,
                    'c': c,
                    'v': v
                };
            });
        });


        document.querySelector('#matrix-button').addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-primary')) {
                tableItems.forEach(element => {
                    element.setAttribute('contenteditable', 'true');
                });
                e.target.innerText = "Сохранить";
            } else {
                tableItems.forEach(element => {
                    element.removeAttribute('contenteditable');
                });
                let csrf = "{{ csrf_token() }}";
                sendData('/update-matrix', {
                        "_token": csrf,
                        data: JSON.stringify(valuesData)
                    })
                    .then((response) => {
                        // console.log(response);
                        valuesData = {};
                    })
                    .catch((error) => {});
                e.target.innerText = "Редактировать";
            }
            e.target.classList.toggle('btn-primary');
            e.target.classList.toggle('btn-secondary');


        })

        function fillColor(element) {
            switch (parseInt(element.innerText)) {
                case 0:
                    element.className = "rose";
                    break;
                case 1:
                    element.className = "yellow";
                    break;
                case 2:
                    element.className = "lgreen";
                    break;
                case 3:
                    element.className = "green";
                    break;
                case 4:
                    element.className = "red";
                    break;

                default:
                    element.className = "";
                    break;
            }
        }
    </script>

    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    {{-- <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script> --}}
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
    {{-- <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
    <!-- overlayScrollbars -->
    {{-- <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script> --}}
</body>

</html>
