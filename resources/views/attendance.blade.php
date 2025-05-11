<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/attendance.css')}}">
    <link rel="stylesheet" href="{{asset('/public/styles/group.css')}}">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
    @include('components.navigate')
    <article class="article">
        <div class="header">
            <h1 class="page-title">Посещаемость</h1>
            <div class="date">Сегодня, {{ date("j F Y H:i") }}</div>
        </div>

        <form id="attendanceForm">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО студента</th>
                    <th>Название мероприятия</th>
                    <th>Имя куратора</th>
                    <th>Посещение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $attendance->event_order_id }}</td>
                        <td>
                            {{ $attendance->student->personalData->surname }}
                            {{ $attendance->student->personalData->name }}
                            {{ $attendance->student->personalData->patronomic }}
                        </td>
                        <td>{{ $attendance->event->title }}</td>
                        <td>
                            {{ $attendance->user->personalData->surname }}
                            {{ $attendance->user->personalData->name }}
                            {{ $attendance->user->personalData->patronomic }}
                        </td>
                        <td class="checkbox-container">
                            <input type="checkbox"
                                   class="checkbox-lg attendance-checkbox"
                                   data-id="{{ $attendance->event_order_id }}"
                                   @if($attendance->is_attended) checked @endif>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="button" id="saveBtn" class="btn-save">Сохранить изменения</button>
            <div id="statusMessage" class="status-message"></div>
        </form>
    </article>
</div>
</body>
</html>
