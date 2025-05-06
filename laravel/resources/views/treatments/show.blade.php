@extends('layouts.app')

@section('content')
    <h1>Деталі лікування</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Лікування #{{ $treatment->id }}</h5>
            <p class="card-text"><strong>Пацієнт:</strong> {{ $treatment->patient->user->name }}</p>
            <p class="card-text"><strong>Лікар:</strong> {{ $treatment->doctor->user->name }}</p>
            <p class="card-text"><strong>Діагноз:</strong> {{ $treatment->diagnosis }}</p>
            <p class="card-text"><strong>Опис:</strong> {{ $treatment->description }}</p>
            <p class="card-text"><strong>Дата початку:</strong> {{ $treatment->start_date }}</p>
            <p class="card-text"><strong>Дата закінчення:</strong> {{ $treatment->end_date }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Назад до списку лікувань</a>
        </div>
    </div>
@endsection
