<link rel="stylesheet" href="{{asset('/public/styles/general.css')}}">
<aside>
    <div class="user-info">
        @foreach($leaders as $leader)
            <h3>
                {{ $leader->personalData->surname }}
                {{ $leader->personalData->name }}
            </h3>
            @if ($leader->group)
                <p>Староста группы {{ $leader->group->name}}</p>
            @else
                <p>Куратор</p>
            @endif
        @endforeach
    </div>
    <nav>
        <ul>
            <li>
                <a href="{{ auth()->user()->role->name === 'куратор' ? route('curator') : route('starosta') }}" class="active">
                    Главная
                </a>
            </li>
            <li><a href="{{route('group')}}">Моя группа</a></li>
            <li><a href="{{route('events')}}">Мероприятия</a></li>
            <li><a href="{{route('attendance')}}">Посещаемость</a></li>
            <li><a href="{{route('logout')}}">Выход</a></li>
        </ul>
    </nav>
</aside>
