@php use Illuminate\Support\Facades\Auth; @endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/general.css')}}">
    <title>Главная страница</title>
</head>
<body>
<main>
    @auth
        @php
            $role = Auth::user()->role->name ?? null;
        @endphp

        @if ($role === 'староста')
            @include('components.leader')
        @elseif ($role === 'куратор')
            @include('components.curator')
        @else
            <p>Добро пожаловать!</p>
        @endif
    @else
        <p>Пожалуйста, <a href="{{ route('login') }}">войдите</a>, чтобы продолжить.</p>
    @endauth
</main>
</body>
</html>
