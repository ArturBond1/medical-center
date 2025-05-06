@extends('layouts.app')

@section('content')
    <h1>Редагувати медикамент</h1>

    <form action="{{ route('medications.update', $medication->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $medication->name }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="dosage">Дозування:</label>
            <input type="text" class="form-control @error('dosage') is-invalid @enderror" id="dosage" name="dosage" value="{{ $medication->dosage }}">
            @error('dosage')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $medication->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="cost">Вартість:</label>
            <input type="number" step="0.01" class="form-control @error('cost') is-invalid @enderror" id="cost" name="cost" value="{{ $medication->cost }}">
            @error('cost')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('medications.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
