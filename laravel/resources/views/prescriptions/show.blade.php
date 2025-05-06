@extends('layouts.app')

@section('content')
    <h1>Деталі рецепту</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Рецепт #{{ $prescription->id }}</h5>
            <p class="card-text"><strong>Пацієнт:</strong> {{ $prescription->appointment->patient->user->name }}</p>
            <p class="card-text"><strong>Лікар:</strong> {{ $prescription->doctor->user->name }}</p>
            <p class="card-text"><strong>Призначення:</strong> {{ $prescription->appointment->title }}</p>
            <p class="card-text"><strong>Ліки:</strong></p>
            <ul>
                @foreach($prescription->medications as $medication)
                    <li>{{ $medication->name }} ({{ $medication->pivot->dosage }}, {{ $medication->pivot->frequency }}, {{ $medication->pivot->duration }})</li>
                @endforeach
            </ul>
            <p class="card-text"><strong>Примітки:</strong> {{ $prescription->notes }}</p>
            <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Назад до списку рецептів</a>
        </div>
    </div>
@endsection
