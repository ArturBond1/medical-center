@extends('layouts.app')

@section('content')
    <h1>Редагувати рецепт</h1>

    <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="appointment_id">Призначення:</label>
            <select class="form-control @error('appointment_id') is-invalid @enderror" id="appointment_id" name="appointment_id" required>
                <option value="">Виберіть призначення</option>
                @foreach($appointments as $id => $appointment)
                    <option value="{{ $id }}" {{ $prescription->appointment_id == $id ? 'selected' : '' }}>{{ $appointment }}</option>
                @endforeach
            </select>
            @error('appointment_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Ліки:</label>
            @foreach($medications as $id => $name)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="medication_ids[]" value="{{ $id }}" id="medication_{{ $id }}" {{ in_array($id, $prescriptionMedicationIds) ? 'checked' : '' }}>
                    <label class="form-check-label" for="medication_{{ $id }}">
                        {{ $name }}
                    </label>
                    <div class="form-row ml-4">
                        <div class="col-4">
                            <label for="dosage_{{ $id }}">Дозування:</label>
                            <input type="text" class="form-control @error('dosage.'.$id) is-invalid @enderror" id="dosage_{{ $id }}" name="dosage[{{ $id }}]" value="{{ $prescription->medications->find($id)->pivot->dosage ?? '' }}">
                            @error('dosage.'.$id)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="frequency_{{ $id }}">Частота:</label>
                            <input type="text" class="form-control @error('frequency.'.$id) is-invalid @enderror" id="frequency_{{ $id }}" name="frequency[{{ $id }}]"  value="{{ $prescription->medications->find($id)->pivot->frequency ?? '' }}">
                            @error('frequency.'.$id)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="duration_{{ $id }}">Тривалість:</label>
                            <input type="text" class="form-control @error('duration.'.$id) is-invalid @enderror" id="duration_{{ $id }}" name="duration[{{ $id }}]"  value="{{ $prescription->medications->find($id)->pivot->duration ?? '' }}">
                            @error('duration.'.$id)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            @endforeach
            @error('medication_ids')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="notes">Примітки:</label>
            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ $prescription->notes }}</textarea>
            @error('notes')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
