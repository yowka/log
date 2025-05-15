<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентов</title>
    <link rel="stylesheet" href="{{ asset('styles/group.css') }}">
</head>
<body>
<div class="wrapper">
    @include('components.navigate')
    <article>
        <div class="students">
            <div class="students__header">
                <h1 class="students__title">Список студентов</h1>
                <a href="{{ route('curator.students.create') }}" class="students__add-button">
                    + Добавить студента
                </a>
            </div>

            @if(session('success'))
                <div class="students__alert students__alert--success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="students__table-container">
                <table class="students__table">
                    <thead class="students__table-head">
                    <tr class="students__table-row">
                        <th class="students__table-header">Id</th>
                        <th class="students__table-header">ФИО</th>
                        <th class="students__table-header">Группа</th>
                        <th class="students__table-header">Телефон</th>
                        <th class="students__table-header">Действия</th>
                    </tr>
                    </thead>
                    <tbody class="students__table-body">
                    @forelse($students as $student)
                        <tr class="students__table-row">
                            <td class="students__table-cell">{{ $student->groupa->group_id}}</td>
                            <td class="students__table-cell">
                                {{ $student->personalData->surname ?? '' }}
                                {{ $student->personalData->name ?? '' }}
                                {{ $student->personalData->patronomic ?? '' }}
                            </td>
                            <td class="students__table-cell">{{ $student->groupa->name ?? '—' }}</td>
                            <td class="students__table-cell">{{ $student->personalData->telephone ?? '—' }}</td>
                            <td class="students__table-cell students__actions">
                                <a href="{{ route('curator.students.edit', $student->id_students) }}"
                                   class="students__action-button students__action-button--edit">
                                    Редактировать
                                </a>
                                <form action="{{ route('curator.students.destroy', $student->id_students) }}"
                                      method="POST" class="students__action-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="students__action-button students__action-button--delete"
                                            onclick="return confirm('Удалить этого студента?')">
                                        Удалить
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="students__table-row">
                            <td colspan="4" class="students__table-cell students__table-cell--empty">Нет студентов</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="students__pagination">
                {{ $students->links() }}
            </div>
        </div>
    </article>
</div>

</body>
</html>
