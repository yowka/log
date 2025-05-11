<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/auth.css')}}">
    <title>Авторизация пользователя</title>
</head>
<body>
<div class="container">
    <h1>Авторизация пользователя</h1>
    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login" required><br>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required><br>
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="submit">
            <button type="submit">Войти</button>
        </div>
    </form>
</div>
</body>
</html>
