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
        @elseif ($user->isLeader())
            <p>Староста группы</p>
        @else
            <p>Студент</p>
        @endif
    </div>

    <nav>
        <ul>
            <li>
                <a href="{{ $user->isCurator() ? route('curator.main') : route('starosta.main') }}" class="{{ request()->routeIs('*main') ? 'active' : '' }}">
                    Главная
                </a>
            </li>

            @if($user->isCurator())
                <li>
                    <a href="{{ route('curator.groups') }}" class="{{ request()->routeIs('curator.groups.*') ? 'active' : '' }}">
                        Мои группы
                    </a>
                </li>
                <li>
                    <a href="{{ route('curator.students.index') }}" class="{{ request()->routeIs('curator.students.*') ? 'active' : '' }}">
                        Студенты
                    </a>
                </li>
                <li>
                    <a href="{{ route('curator.events.index') }}" class="{{ request()->routeIs('curator.events.*') ? 'active' : '' }}">
                        Мероприятия
                    </a>
                </li>
                <li>
                    <a href="{{ route('curator.attendance.index') }}" class="{{ request()->routeIs('curator.attendance.*') ? 'active' : '' }}">
                        Посещаемость
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('starosta.group') }}" class="{{ request()->routeIs('starosta.group') ? 'active' : '' }}">
                        Моя группа
                    </a>
                </li>
                <li>
                    <a href="{{ route('starosta.events') }}" class="{{ request()->routeIs('starosta.events') ? 'active' : '' }}">
                        Мероприятия
                    </a>
                </li>
                <li>
                    <a href="{{ route('starosta.attendance') }}" class="{{ request()->routeIs('starosta.*') ? 'active' : '' }}">
                        Посещаемость
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('logout') }}" >
                    Выход
                </a>
            </li>
        </ul>
    </nav>
</aside>
