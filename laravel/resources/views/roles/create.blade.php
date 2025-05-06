@extends('layouts.app')

@section('content')
    <h1>Додати нову роль</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Назва ролі:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
