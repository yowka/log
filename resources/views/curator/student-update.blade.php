<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($student) ? 'Редактирование' : 'Добавление' }} студента</title>
    <link rel="stylesheet" href="{{ asset('styles/general.css') }}">
</head>
<body>
<div class="student-form">
    <h1 class="student-form__title">
        {{ isset($student) ? 'Редактирование студента' : 'Добавление нового студента' }}
    </h1>

    @if($errors->any())
        <div class="student-form__errors">
            @foreach($errors->all() as $error)
                <div class="student-form__error">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST"
          action="{{ isset($student) ? route('curator.students.update', $student->id_students) : route('curator.students.store') }}"
          class="student-form__form">
        @csrf
        @if(isset($student)) @method('PUT') @endif

        <div class="student-form__group">
            <label for="surname" class="student-form__label">Фамилия:</label>
            <input id="surname" type="text" name="surname"
                   class="student-form__input"
                   value="{{ old('surname', $student->personalData->surname ?? '') }}" required>
        </div>

        <div class="student-form__group">
            <label for="name" class="student-form__label">Имя:</label>
            <input id="name" type="text" name="name"
                   class="student-form__input"
                   value="{{ old('name', $student->personalData->name ?? '') }}" required>
        </div>

        <div class="student-form__group">
            <label for="patronomic" class="student-form__label">Отчество:</label>
            <input id="patronomic" type="text" name="patronomic"
                   class="student-form__input"
                   value="{{ old('patronomic', $student->personalData->patronomic ?? '') }}">
        </div>

        @unless(isset($student))
            <div class="student-form__group">
                <label for="email" class="student-form__label">Email:</label>
                <input id="email" type="email" name="email"
                       class="student-form__input"
                       value="{{ old('email') }}" required>
            </div>
        @endunless

        <div class="student-form__group">
            <label for="group_id" class="student-form__label">Группа:</label>
            <select id="group_id" name="group_id" class="student-form__select" required>
                <option value="">Выберите группу</option>
                @foreach($groups as $group)
                    <option value="{{ $group->group_id }}"
                        {{ old('group_id', $student->id_group ?? '') == $group->group_id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="student-form__group">
            <label for="phone" class="student-form__label">Телефон:</label>
            <input id="telephone" type="tel" name="telephone" value="{{ old('telephone') }}" required>
        </div>
        <div class="student-form__group">
            <label for="date_of_birth" class="student-form__label">Дата рождения:</label>
            <input id="date_of_birth" type="date" name="date_of_birth"
                   class="student-form__input"
                   value="{{ old('date_of_birth') }}"
                   required>
        </div>
        <div class="student-form__buttons">
            <button type="submit" class="student-form__button student-form__button--submit">
                {{ isset($student) ? 'Обновить' : 'Добавить' }}
            </button>
            <a href="{{ route('curator.students.index') }}" class="student-form__button student-form__button--cancel">
                Отмена
            </a>
        </div>
    </form>
</div>
</body>
</html>
