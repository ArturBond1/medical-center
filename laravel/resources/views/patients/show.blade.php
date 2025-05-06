@extends('layouts.app')

@section('content')
    <h1>Деталі пацієнта</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $patient->user->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $patient->id }}</p>
            <p class="card-text"><strong>Дата народження:</strong> {{ $patient->date_of_birth }}</p>
            <p class="card-text"><strong>Стать:</strong> {{ $patient->gender }}</p>
            <p class="card-text"><strong>Адреса:</strong> {{ $patient->address }}</p>
            <p class="card-text"><strong>Номер телефону:</strong> {{ $patient->phone_number }}</p>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Назад до списку пацієнтів</a>
        </div>
    </div>
@endsection
