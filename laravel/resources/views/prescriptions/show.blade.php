@extends('layouts.app')

@section('content')
    <h1>Деталі рецепта #{{ $prescription->id }}</h1>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>ID прийому:</strong> {{ $prescription->appointment_id }}</li>
        <li class="list-group-item"><strong>Лікар:</strong> {{ $prescription->doctor->user->name ?? '—' }}</li>
        <li class="list-group-item"><strong>Пацієнт:</strong> {{ $prescription->patient->user->name ?? '—' }}</li>
        <li class="list-group-item"><strong>Ліки:</strong> {{ $prescription->medication->name ?? '—' }}</li>
        <li class="list-group-item"><strong>Примітки:</strong> {{ $prescription->notes }}</li>
    </ul>

    <div class="d-flex gap-2">
        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Назад до списку</a>
        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning">Редагувати</a>
        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Ви впевнені?')">Видалити</button>
        </form>
    </div>
@endsection
