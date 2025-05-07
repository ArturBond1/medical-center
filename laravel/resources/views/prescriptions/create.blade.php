@extends('layouts.app')

@section('content')
    <h1>Створити рецепт</h1>

    <form action="{{ route('prescriptions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="appointment_id">ID:</label>
            <input type="number" name="appointment_id" id="appointment_id" class="form-control @error('appointment_id') is-invalid @enderror" required>
            @error('appointment_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="doctor_id">Лікар:</label>
            <select name="doctor_id" id="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" required>
                <option value="">Оберіть лікаря</option>
                @foreach($doctors as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('doctor_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                <option value="">Оберіть пацієнта</option>
                @foreach($patients as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('patient_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="medication_id">Препарат:</label>
            <select name="medication_id" id="medication_id" class="form-control @error('medication_id') is-invalid @enderror" required>
                <option value="">Оберіть препарат</option>
                @foreach($medications as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            @error('medication_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="notes">Примітки:</label>
            <textarea name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"></textarea>
            @error('notes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Відмінити</a>
    </form>
@endsection
