@extends('layouts.app')

@section('content')
    <h1>Редагувати користувача</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Ім'я:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Залиште це поле порожнім, якщо не хочете змінювати пароль.</small>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Підтвердіть пароль:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="role_id">Роль:</label>
            <select class="form-control" id="role_id" name="role_id" required>
                <option value="">Виберіть роль</option>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}" {{ $user->role_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection

