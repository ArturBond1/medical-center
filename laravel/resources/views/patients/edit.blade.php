@extends('layouts.app')

@section('content')
    <h1>Редагувати пацієнта</h1>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        {{-- Користувач --}}
        <div class="form-group">
            <label for="user_id">Користувач:</label>
            <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                <option value="">Виберіть користувача</option>
                @foreach($users as $id => $name)
                    <option value="{{ $id }}" {{ $patient->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">Будь ласка, виберіть користувача.</div>
            @error('user_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Дата народження --}}
        <div class="form-group">
            <label for="date_of_birth">Дата народження:</label>
            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $patient->date_of_birth) }}">
            @error('date_of_birth')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Стать --}}
        <div class="form-group">
            <label for="gender">Стать:</label>
            <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                <option value="">Виберіть стать</option>
                <option value="male" {{ old('gender', $patient->gender) == 'male' ? 'selected' : '' }}>Чоловік</option>
                <option value="female" {{ old('gender', $patient->gender) == 'female' ? 'selected' : '' }}>Жінка</option>
                <option value="other" {{ old('gender', $patient->gender) == 'other' ? 'selected' : '' }}>Інше</option>
            </select>
            @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Адреса --}}
        <div class="form-group">
            <label for="address">Адреса:</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $patient->address) }}">
            @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Номер телефону --}}
        <div class="form-group">
            <label for="phone_number">Номер телефону:</label>
            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $patient->phone_number) }}">
            @error('phone_number')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Кнопки --}}
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
