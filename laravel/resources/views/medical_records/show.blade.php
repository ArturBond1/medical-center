@extends('layouts.app')

@section('content')
    <h1>Деталі медичної картки</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Медична картка #{{ $medicalRecord->id }}</h5>
            <p class="card-text"><strong>Пацієнт:</strong> {{ $medicalRecord->patient->user->name }}</p>
            <p class="card-text"><strong>Діагноз:</strong> {{ $medicalRecord->diagnosis }}</p>
            <p class="card-text"><strong>План лікування:</strong> {{ $medicalRecord->treatment_plan }}</p>
            <p class="card-text"><strong>Примітки:</strong> {{ $medicalRecord->notes }}</p>
            <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">Назад до списку медичних карток</a>
        </div>
    </div>
@endsection
