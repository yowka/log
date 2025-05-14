<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/group.css')}}">
    <link rel="icon" href="{{ asset('book.ico') }}">
    <title>Куратор</title>
</head>
<body>
<div class="wrapper">
    @include('components.navigate')
    <article>
        <div class="header">
            <h1 class="page-title">Главная</h1>
            <?php date_default_timezone_set('Asia/Tomsk'); ?>
            <div class="date">Сегодня, {{ date("j F Y H:i") }}</div>
        </div>
        <div class="card">
            <h2>Кураторы</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ФИО</th>
                    <th>Группа</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                @foreach($leaders as $leader)
                    <tr>
                        <td>{{ $leader->user_id }}</td>
                        <td>
                            {{ $leader->personalData->surname }}
                            {{ $leader->personalData->name }}
                            {{ $leader->personalData->patronomic ?? '' }}
                        </td>
                        <td>{{ $leader->group ? $leader->group->name : '-' }}</td>
                        <td>{{ $leader->personalData->telephone }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">

            <h2>Мероприятия</h2>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Локация</th>
                    <th>Описание</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->event_id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->description }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card">
            <h2>Посещаемость</h2>
            <table>
                <thead>
                <tr>
                    <th>ID студента</th>
                    <th>ФИО студента</th>
                    <th>Мероприятие</th>
                    <th>Посещение</th>
                </tr>
                </thead>
                <tbody>
                @foreach($attendances as $attendance)
                    <tr>
                        <td>
                            {{$attendance->student->personalData->surname}}
                            {{$attendance->student->personalData->name}}
                        </td>
                        <td>{{ $attendance->event->title }}</td>
                        <td>{{ $attendance->student->groupa->name}}</td>
                        <td>
                            @if($attendance->is_attended)
                                <span class="attendance-present">Присутствовал</span>
                            @else
                                <span class="attendance-absent">Отсутствовал</span>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card">
            <h2>Студенты</h2>
            <table>
                <thead>
                <tr>
                    <th>ID студента</th>
                    <th>ФИО</th>
                    <th>Дата рождения</th>
                    <th>Телефон</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>
                            {{ $student->personalData->surname }}
                            {{ $student->personalData->name }}
                            {{ $student->personalData->patronomic ?? '' }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($student->personalData->date_of_birth)->format('d.m.Y') }}</td>
                        <td>{{ $student->personalData->telephone }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">Нет студентов в группе</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </article>
</div>
</body>
</html>
