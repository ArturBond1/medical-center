@extends('layouts.app')

@section('content')
    <h1>Деталі лікаря</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $doctor->user->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $doctor->id }}</p>
            <p class="card-text"><strong>Спеціалізація:</strong> {{ $doctor->specialization }}</p>
            <p class="card-text"><strong>Відділення:</strong> {{ $doctor->department->name }}</p>
            <p class="card-text"><strong>Кількість прийомів:</strong> {{ $doctor->appointments()->count() }}</p>
            <p class="card-text"><strong>Кількість рецептів:</strong> {{ $doctor->prescriptions()->count() }}</p>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Назад до списку лікарів</a>
        </div>
    </div>
@endsection
