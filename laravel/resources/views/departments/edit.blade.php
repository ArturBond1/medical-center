@extends('layouts.app')

@section('content')
    <h1>Редагувати відділення</h1>

    <form action="{{ route('departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $department->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control" id="description" name="description">{{ $department->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
