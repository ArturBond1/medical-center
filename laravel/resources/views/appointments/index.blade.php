@extends('layouts.app')

@section('content')
    <h1>Прийоми</h1>
    <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Записати на прийом</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Дата</th>
            <th>Час</th>
            <th>Причина</th>
            <th>Статус</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->patient->user->name }}</td>
                <td>{{ $appointment->doctor->user->name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->reason }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
@endsection
