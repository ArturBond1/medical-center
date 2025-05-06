@extends('layouts.app')

@section('content')
    <h1>Керування лікарями</h1>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Додати лікаря</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я користувача</th>
            <th>Спеціалізація</th>
            <th>Відділення</th>
            <th>Кількість прийомів</th>
            <th>Кількість рецептів</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($doctors as $doctor)
            <tr>
                <td>{{ $doctor->id }}</td>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->department->name }}</td>
                <td>{{ $doctor->appointments()->count() }}</td>
                <td>{{ $doctor->prescriptions()->count() }}</td>
                <td>
                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цього лікаря?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Немає жодного лікаря.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $doctors->links() }}
@endsection
