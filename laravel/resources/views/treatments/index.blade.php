@extends('layouts.app')

@section('content')
    <h1>Лікування</h1>

    <a href="{{ route('treatments.create') }}" class="btn btn-primary mb-3">Додати лікування</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Діагноз</th>
            <th>Опис</th>
            <th>Дата початку</th>
            <th>Дата закінчення</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($treatments as $treatment)
            <tr>
                <td>{{ $treatment->id }}</td>
                <td>{{ $treatment->patient && $treatment->patient->user ? $treatment->patient->user->name : 'Не вказано' }}</td>
                <td>{{ $treatment->doctor && $treatment->doctor->user ? $treatment->doctor->user->name : 'Не вказано' }}</td>

                <td>{{ $treatment->diagnosis }}</td>
                <td>{{ $treatment->description }}</td>
                <td>{{ $treatment->start_date }}</td>
                <td>{{ $treatment->end_date }}</td>
                <td>
                    <a href="{{ route('treatments.show', $treatment->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити це лікування?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Немає жодного лікування.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $treatments->links() }}
@endsection

