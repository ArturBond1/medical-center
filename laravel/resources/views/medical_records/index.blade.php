@extends('layouts.app')

@section('content')
    <h1>Керування медичними картками</h1>

    <a href="{{ route('medical_records.create') }}" class="btn btn-primary mb-3">Додати медичну картку</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('medical_records.index') }}" method="GET" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="patient_id">Пацієнт:</label>
                <select class="form-control" id="patient_id" name="patient_id">
                    <option value="">Виберіть пацієнта</option>
                    @foreach($patients as $id => $name)
                        <option value="{{ $id }}" {{ request('patient_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="diagnosis">Діагноз:</label>
                <input type="text" class="form-control" id="diagnosis" name="diagnosis" value="{{ request('diagnosis') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="treatment_plan">План лікування:</label>
                <input type="text" class="form-control" id="treatment_plan" name="treatment_plan" value="{{ request('treatment_plan') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="notes">Примітки:</label>
                <input type="text" class="form-control" id="notes" name="notes" value="{{ request('notes') }}">
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Фільтрувати</button>
                <a href="{{ route('medical_records.index') }}" class="btn btn-secondary mt-4">Очистити</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="perPage">Кількість елементів на сторінці:</label>
                <select name="perPage" class="form-control" id="perPage" onchange="this.form.submit()">
                    <option value="3" {{ request('perPage') == 3 ? 'selected' : '' }}>3</option>
                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Діагноз</th>
            <th>План лікування</th>
            <th>Примітки</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($medicalRecords as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->patient->user->name }}</td>
                <td>{{ Str::limit($record->diagnosis, 50) }}</td>
                <td>{{ Str::limit($record->treatment_plan, 50) }}</td>
                <td>{{ Str::limit($record->notes, 50) }}</td>
                <td>
                    <a href="{{ route('medical_records.show', $record->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('medical_records.edit', $record->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('medical_records.destroy', $record->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цю медичну картку?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Немає жодної медичної картки.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $medicalRecords->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
