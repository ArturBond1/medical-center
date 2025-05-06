@extends('layouts.app')

@section('content')
    <h1>Редагувати прийом</h1>
    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select class="form-control" id="patient_id" name="patient_id" required>
                <option value="">Виберіть пацієнта</option>
                @foreach($patients as $id => $name)
                    <option value="{{ $id }}" {{ $appointment->patient_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Лікар:</label>
            <select class="form-control" id="doctor_id" name="doctor_id" required>
                <option value="">Виберіть лікаря</option>
                @foreach($doctors as $id => $name)
                    <option value="{{ $id }}" {{ $appointment->doctor_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_date">Дата прийому:</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ $appointment->appointment_date }}" required>
        </div>
        <div class="form-group">
            <label for="appointment_time">Час прийому:</label>
            <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="{{ $appointment->appointment_time }}" required>
        </div>
        <div class="form-group">
            <label for="reason">Причина:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3">{{ $appointment->reason }}</textarea>
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <select class="form-control" id="status" name="status">
                <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Заплановано</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Скасовано</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
