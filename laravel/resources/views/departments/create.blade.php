@extends('layouts.app')

@section('content')
    <h1>Додати відділення</h1>

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Назва:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
