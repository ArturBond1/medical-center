@extends('layouts.app')

@section('content')
    <h1>Додати працівника</h1>

    <form action="{{ route('staff.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Користувач:</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Виберіть користувача</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="department_id">Відділ:</label>
            <select class="form-control" id="department_id" name="department_id" required>
                <option value="">Виберіть відділ</option>
                @foreach($departments as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="position">Посада:</label>
            <input type="text" class="form-control" id="position" name="position" required>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('staff.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
