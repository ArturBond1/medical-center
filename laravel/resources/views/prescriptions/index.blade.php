@extends('layouts.app')

@section('content')
    <h1>Рецепти</h1>

    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary mb-3">Створити рецепт</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Призначення</th>
            <th>Ліки</th>
            <th>Примітки</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->id }}</td>
                <td>{{ $prescription->appointment->patient->user->name }}</td>
                <td>{{ $prescription->doctor->user->name }}</td>
                <td>{{ $prescription->appointment->title }}</td>
                <td>
                    @foreach($prescription->medications as $medication)
                        {{ $medication->name }} ({{ $medication->pivot->dosage }}, {{ $medication->pivot->frequency }}, {{ $medication->pivot->duration }})<br>
                    @endforeach
                </td>
                <td>{{ $prescription->notes }}</td>
                <td>
                    <a href="{{ route('prescriptions.show', $prescription->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('prescriptions.edit', $prescription->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('prescriptions.destroy', $prescription->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей рецепт?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Немає жодних рецептів.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $prescriptions->links() }}
@endsection
