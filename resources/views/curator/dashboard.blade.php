<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </article>
</div>
</body>
</html>
