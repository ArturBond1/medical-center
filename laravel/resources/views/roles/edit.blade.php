@extends('layouts.app')

@section('content')
    <h1>Редагувати роль</h1>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Назва ролі:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $role->name }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
