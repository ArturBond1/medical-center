@extends('layouts.app')

@section('content')
    <h1>Керування медикаментами</h1>

    <a href="{{ route('medications.create') }}" class="btn btn-primary mb-3">Додати медикамент</a>

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
            <th>Назва</th>
            <th>Дозування</th>
            <th>Опис</th>
            <th>Вартість</th>
            <th>Кількість рецептів</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($medications as $medication)
            <tr>
                <td>{{ $medication->id }}</td>
                <td>{{ $medication->name }}</td>
                <td>{{ $medication->dosage }}</td>
                <td>{{ Str::limit($medication->description, 50) }}</td>
                <td>{{ $medication->cost }}</td>
                <td>{{ $medication->prescriptions()->count() }}</td>
                <td>
                    <a href="{{ route('medications.show', $medication->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('medications.edit', $medication->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей медикамент?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Немає жодного медикаменту.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $medications->links() }}
@endsection
