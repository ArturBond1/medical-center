@extends('layouts.app')

@section('content')
    <h1>Записати на прийом</h1>
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select class="form-control" id="patient_id" name="patient_id" required>
                <option value="">Виберіть пацієнта</option>
                @foreach($patients as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="doctor_id">Лікар:</label>
            <select class="form-control" id="doctor_id" name="doctor_id" required>
                <option value="">Виберіть лікаря</option>
                @foreach($doctors as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="appointment_date">Дата прийому:</label>
            <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>
        <div class="form-group">
            <label for="appointment_time">Час прийому:</label>
            <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
        </div>
        <div class="form-group">
            <label for="reason">Причина:</label>
            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="status">Статус:</label>
            <select class="form-control" id="status" name="status">
                <option value="scheduled" selected>Заплановано</option>
                <option value="completed">Завершено</option>
                <option value="cancelled">Скасовано</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
