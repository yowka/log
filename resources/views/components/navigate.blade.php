<link rel="stylesheet" href="{{ asset('styles/general.css') }}">
<link rel="icon" href="{{ asset('book.ico') }}">
<aside>
    <div class="user-info">
        @php($user = auth()->user())

        <h3>
            {{ $user->personalData->surname ?? '' }}
            {{ $user->personalData->name ?? '' }}
        </h3>

        @if ($user->isCurator())
            <p>Куратор</p>
        @elseif ($user->group)
            <p>Староста группы {{ $user->group->name }}</p>
        @else
            <p>Студент</p>
        @endif
    </div>

    <nav>
        <ul>
            <li>
                <a href="{{ $user->isCurator() ? route('curator.main') : route('starosta.main') }}" class="active">
                    Главная
                </a>
            </li>

            @if($user->isCurator())
                <li><a href="{{ route('curator.groups') }}">Мои группы</a></li>
                <li><a href="{{ route('curator.events') }}">Мероприятия</a></li>
                <li><a href="{{ route('curator.attendance') }}">Посещаемость</a></li>
            @else
                <li><a href="{{ route('starosta.group') }}">Моя группа</a></li>
                <li><a href="{{ route('starosta.events') }}">Мероприятия</a></li>
                <li><a href="{{ route('starosta.attendance') }}">Посещаемость</a></li>
            @endif

            <!-- Выход -->
            <li><a href="{{ route('logout') }}">Выход</a></li>
        </ul>
    </nav>
</aside>
