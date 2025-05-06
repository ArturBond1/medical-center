@extends('layouts.app')

@section('content')
    <h1>Додати користувача</h1>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Ім'я:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Підтвердіть пароль:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="role_id">Роль:</label>
            <select class="form-control" id="role_id" name="role_id" required>
                <option value="">Виберіть роль</option>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection

