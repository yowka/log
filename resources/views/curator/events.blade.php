<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/group.css')}}">
    <link rel="icon" href="{{ asset('book.ico') }}">
    <title>Мероприятия</title>
</head>
<body>
<div class="wrapper">
    @include('components.navigate')
    <article class="article">
        <div class="header">
            <h1 class="page-title">Мероприятия</h1>
            <?php date_default_timezone_set('Asia/Tomsk'); ?>
            <div class="date">Сегодня, {{ date("j F Y H:i") }}</div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Локация</th>
                <th>Описание</th>
                <th>Приказ</th>
                <th>Дата приказа</th>
                <th>Ответственный</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->event_id }}</td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->description }}</td>
                    <td>
                        {{ $event->orders->number }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($event->orders->date)->format('d.m.Y') }}
                    </td>
                    <td>{{ $event->manager->login }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </article>
</div>
</body>
</html>
