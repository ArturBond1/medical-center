@extends('layouts.app')

@section('content')
    <h1>Деталі діагнозу</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $diagnosis->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $diagnosis->id }}</p>
            <p class="card-text"><strong>Опис:</strong> {{ $diagnosis->description }}</p>
            <p class="card-text"><strong>Кількість медкарток:</strong> {{ $diagnosis->medicalRecords()->count() }}</p>
            <a href="{{ route('diagnoses.index') }}" class="btn btn-secondary">Назад до списку діагнозів</a>
        </div>
    </div>
@endsection
