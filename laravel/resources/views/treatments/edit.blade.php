@extends('layouts.app')

@section('content')
    <h1>Редагувати лікування</h1>

    <form action="{{ route('treatments.update', $treatment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select class="form-control" id="patient_id" name="patient_id" required>
                <option value="">Виберіть пацієнта</option>
                @foreach($patients as $id => $name)
                    <option value="{{ $id }}" {{ $treatment->patient_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Лікар:</label>
            <select class="form-control" id="doctor_id" name="doctor_id" required>
                <option value="">Виберіть лікаря</option>
                @foreach($doctors as $id => $name)
                    <option value="{{ $id }}" {{ $treatment->doctor_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="diagnosis">Діагноз:</label>
            <input type="text" class="form-control" id="diagnosis" name="diagnosis" value="{{ $treatment->diagnosis }}" required>
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $treatment->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="start_date">Дата початку:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $treatment->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">Дата закінчення:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $treatment->end_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('treatments.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
