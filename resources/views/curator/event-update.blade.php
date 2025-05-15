<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/public/styles/group.css')}}">
    <title>Обновить события</title>
</head>
<body>
<div class="wrapper">
    @include('components.navigate')

    <article class="article">
        <div class="header">
            <h1 class="page-title">{{ $event ? 'Редактировать' : 'Добавить' }} мероприятие</h1>
        </div>

        <form action="{{ $event ? route('curator.events.update', $event->event_id) : route('curator.events.store') }}" method="POST" class="card">
            @csrf
            @if($event)
                @method('PUT')
            @endif

            <div class="form-group">
                <label>Название:</label>
                <input type="text" name="title" value="{{ old('title', $event->title ?? '') }}" required class="form-control">
            </div>

            <div class="form-group">
                <label>Локация:</label>
                <input type="text" name="location" value="{{ old('location', $event->location ?? '') }}" required class="form-control">
            </div>

            <div class="form-group">
                <label>Описание:</label>
                <textarea name="description" class="form-control">{{ old('description', $event->description ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label>Приказ:</label>
                <select name="order_id" required class="form-control">
                    @foreach ($orders as $order)
                        <option value="{{ $order->order_id }}"
                                {{ $event->manager->login }} {{ $event->manager->role->name }}   >
                        {{ $order->number }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Ответственный:</label>
                <input type="text"
                       value="{{ $event->manager->login ?? 'Не указан' }}"
                       class="form-control"
                       disabled>
                <input type="hidden" name="manager_id" value="{{ $event->manager_id ?? auth()->id() }}">
            </div>

            <button type="submit" class="btn-save">Сохранить</button>
        </form>
    </article>
</div>

</body>
</html>
