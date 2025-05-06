@extends('layouts.app')

@section('content')
    <h1>Редагувати діагноз</h1>

    <form action="{{ route('diagnoses.update', $diagnosis->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва діагнозу:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $diagnosis->name }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $diagnosis->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('diagnoses.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
