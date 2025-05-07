@extends('layouts.app')

@section('content')
    <h1>Прийоми</h1>

    <form method="GET" action="{{ route('appointments.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="appointment_date" class="form-control" placeholder="Дата прийому"
                       value="{{ request('appointment_date') }}">
            </div>
            <div class="col">
                <select name="patient_id" class="form-control">
                    <option value="">Пацієнт</option>
                    @foreach($patients as $id => $name)
                        <option value="{{ $id }}" {{ request('patient_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="doctor_id" class="form-control">
                    <option value="">Лікар</option>
                    @foreach($doctors as $id => $name)
                        <option value="{{ $id }}" {{ request('doctor_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <select name="status" class="form-control">
                    <option value="">Статус</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Очікує</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Завершено</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Скасовано</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('appointments.index') }}" class="btn btn-light">Очистити</a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="per_page">Кількість елементів на сторінці:</label>
                <select name="per_page" class="form-control" id="per_page" onchange="this.form.submit()">
                    <option value="3" {{ request('per_page') == 3 ? 'selected' : '' }}>3</option>
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                </select>
            </div>
        </div>
    </form>

    <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Записати на прийом</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Дата</th>
            <th>Час</th>
            <th>Причина</th>
            <th>Статус</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>
                <td>{{ $appointment->patient->user->name }}</td>
                <td>{{ $appointment->doctor->user->name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->reason }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $appointments->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
