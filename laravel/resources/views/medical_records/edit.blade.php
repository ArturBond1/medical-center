@extends('layouts.app')

@section('content')
    <h1>Редагувати медичну картку</h1>

    <form action="{{ route('medical_records.update', $medicalRecord->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select class="form-control @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                <option value="">Виберіть пацієнта</option>
                @foreach($patients as $id => $name)
                    <option value="{{ $id }}" {{ $medicalRecord->patient_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @error('patient_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="diagnosis">Діагноз:</label>
            <textarea class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis">{{ $medicalRecord->diagnosis }}</textarea>
            @error('diagnosis')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="treatment_plan">План лікування:</label>
            <textarea class="form-control @error('treatment_plan') is-invalid @enderror" id="treatment_plan" name="treatment_plan">{{ $medicalRecord->treatment_plan }}</textarea>
            @error('treatment_plan')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="notes">Примітки:</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ $medicalRecord->notes }}</textarea>
            @error('notes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('medical_records.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
