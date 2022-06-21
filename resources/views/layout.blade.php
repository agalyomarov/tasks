<!DOCTYPE html>
<html lang="ru">

<head>
    <style>
        .sidebar {
            width: 200px;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: lightgrey;
        }

        .main {
            margin-left: 200px;
            padding: 2em;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="{{ URL::asset('js/main.js') }}"></script>
</head>

<body>
    <div class="sidebar">
        <div class="btn-group-vertical">
            <a href="{{ route('home') }}" class="btn btn-primary">Матрица</a>
            <a href="{{ route('page', ['id' => 'goal']) }}" class="btn btn-primary">+ цель</a>
            <a href="{{ route('page', ['id' => 'task']) }}" class="btn btn-primary">+ задача</a>
            <a href="{{ route('page', ['id' => 'project']) }}" class="btn btn-primary">+ проект</a>
            <a href="{{ route('page', ['id' => 'member']) }}" class="btn btn-primary">+ человек</a>
            <a href="{{ route('page', ['id' => 'result']) }}" class="btn btn-primary">+ результат</a>

            <a href="{{ route('PhotoController.index') }}" class="btn btn-primary">НАЗАД</a>
        </div>
    </div>
    <div class="main">
        <div class="container">
            @yield('content')
        </div>
    </div>

</body>

</html>
