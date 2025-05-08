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
                <li><a href="#">Сообщения</a></li>
                <li><a href="#">Настройки</a></li>
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
            <h2>Ближайшие мероприятия</h2>
            <table>
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата</th>
                    <th>Место</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Научная конференция</td>
                    <td>10 июня 2023</td>
                    <td>Конференц-зал</td>
                    <td><button class="btn btn-primary">Отметить посещаемость</button></td>
                </tr>
                <tr>
                    <td>Спортивные соревнования</td>
                    <td>15 июня 2023</td>
                    <td>Спортивный зал</td>
                    <td><button class="btn btn-primary">Отметить посещаемость</button></td>
                </tr>
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
                    <th>Дата</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Петров Алексей</td>
                    <td>Организационное собрание</td>
                    <td>1 июня 2023</td>
                    <td class="attendance-present">Присутствовал</td>
                </tr>
                <tr>
                    <td>Сидорова Мария</td>
                    <td>Организационное собрание</td>
                    <td>1 июня 2023</td>
                    <td class="attendance-absent">Отсутствовал</td>
                </tr>
                </tbody>
            </table>
        </div>
    </article>
</div>
</body>
</html>
