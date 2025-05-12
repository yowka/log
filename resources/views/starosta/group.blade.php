<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/group.css')}}">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    @include('components.navigate')
    <article class="article">
        <div class="header">
            <h1 class="page-title">Моя группа</h1>
            <?php date_default_timezone_set('Asia/Tomsk'); ?>
            <div class="date">Сегодня, {{ date("j F Y H:i") }}</div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Дата рождения</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id_students}}</td>
                    <td>
                        {{ $student->personalData->surname }}
                        {{ $student->personalData->name}}
                        {{ $student->personalData->patronomic }}
                    </td>
                    <td>{{ $student->personalData->telephone }}</td>
                    <td>
                        @if(isset($student->personalData->date_of_birth))
                            {{ \Carbon\Carbon::parse($student->personalData->date_of_birth)->format('d.m.Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </article>
</div>
</body>
</html>
