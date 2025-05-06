@extends('layouts.app')

@section('content')
    <h1>Деталі прийому</h1>
    <p><strong>ID:</strong> {{ $appointment->id }}</p>
    <p><strong>Пацієнт:</strong> {{ $appointment->patient->user->name }}</p>
    <p><strong>Лікар:</strong> {{ $appointment->doctor->user->name }}</p>
    <p><strong>Дата прийому:</strong> {{ $appointment->appointment_date }}</p>
    <p><strong>Час прийому:</strong> {{ $appointment->appointment_time }}</p>
    <p><strong>Причина:</strong> {{ $appointment->reason }}</p>
    <p><strong>Статус:</strong> {{ $appointment->status }}</p>
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Назад</a>
@endsection
