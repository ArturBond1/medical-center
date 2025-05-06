@extends('layouts.app')

@section('content')
    <h1>Деталі медикаменту</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $medication->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $medication->id }}</p>
            <p class="card-text"><strong>Дозування:</strong> {{ $medication->dosage }}</p>
            <p class="card-text"><strong>Опис:</strong> {{ $medication->description }}</p>
            <p class="card-text"><strong>Вартість:</strong> {{ $medication->cost }}</p>
            <p class="card-text"><strong>Кількість рецептів:</strong> {{ $medication->prescriptions()->count() }}</p>
            <a href="{{ route('medications.index') }}" class="btn btn-secondary">Назад до списку медикаментів</a>
        </div>
    </div>
@endsection
