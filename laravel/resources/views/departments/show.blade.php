@extends('layouts.app')

@section('content')
    <h1>Деталі відділення</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $department->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $department->id }}</p>
            <p class="card-text"><strong>Опис:</strong> {{ $department->description }}</p>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Назад до списку відділень</a>
        </div>
    </div>
@endsection
