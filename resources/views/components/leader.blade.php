<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет старосты</title>

</head>
<body>
<div class="wrapper">
    <aside>
        <div class="user-info">
            @foreach($leaders as $leader)
            <h3>
                    {{ $leader->personalData->surname }}
                    {{ $leader->personalData->name }}
            </h3>
                @if ($leader->group)
                    <p>Староста группы {{ $leader->group->name }}</p>
                @else
                    <p>Группа не назначена</p>
                @endif
            @endforeach
        </div>
        <nav>
            <ul>
                <li><a href="#" class="active">Главная</a></li>
                <li><a href="#">Моя группа</a></li>
                <li><a href="#">Мероприятия</a></li>
                <li><a href="#">Посещаемость</a></li>
                <li><a href="/logout">Выход</a></li>
            </ul>
        </nav>
    </aside>
    <article>
        <div class="header">
            <h1 class="page-title">Главная</h1>
            <?php date_default_timezone_set('Asia/Tomsk'); ?>
            <div class="date">Сегодня, {{ date("j F Y H:i") }}</div>
        </div>

        <div class="card">
            <h2>Последние мероприятия</h2>
            <table>
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата</th>
                    <th>Место</th>
                    <th>Описание</th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>
                            {{ $event->orders->date }}
                        </td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Нет мероприятий</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>Последние отметки посещаемости</h2>
            <table>
                <thead>
                <tr>
                    <th>Студент</th>
                    <th>Мероприятие</th>
                    <th>Группа</th>
                    <th>Статус</th>
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
                        <td>{{ $attendance->student->group->name}}</td>
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
    </article>
</div>
</body>
</html>
