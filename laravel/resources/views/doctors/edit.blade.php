@extends('layouts.app')

@section('content')
    <h1>Редагувати лікаря</h1>

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">Користувач:</label>
            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                <option value="">Виберіть користувача</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}" {{ $doctor->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="specialization">Спеціалізація:</label>
            <input type="text" class="form-control @error('specialization') is-invalid @enderror" id="specialization" name="specialization" value="{{ $doctor->specialization }}">
            @error('specialization')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="department_id">Відділення:</label>
            <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                <option value="">Виберіть відділення</option>
                @foreach($departments as $id => $name)
                    <option value="{{ $id }}" {{ $doctor->department_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @error('department_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
