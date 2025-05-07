@extends('layouts.app')

@section('content')
    <h1>Лікування</h1>
    <form method="GET" action="{{ route('treatments.index') }}" class="mb-3">
        <div class="row">
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
                <input type="text" name="diagnosis" class="form-control" placeholder="Діагноз"
                       value="{{ request('diagnosis') }}">
            </div>
            <div class="col">
                <input type="date" name="start_date" class="form-control" placeholder="Дата початку"
                       value="{{ request('start_date') }}">
            </div>
            <div class="col">
                <input type="date" name="end_date" class="form-control" placeholder="Дата закінчення"
                       value="{{ request('end_date') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('treatments.index') }}" class="btn btn-light">Очистити</a>
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

    <a href="{{ route('treatments.create') }}" class="btn btn-primary mb-3">Додати лікування</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Діагноз</th>
            <th>Опис</th>
            <th>Дата початку</th>
            <th>Дата закінчення</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($treatments as $treatment)
            <tr>
                <td>{{ $treatment->id }}</td>
                <td>{{ $treatment->patient && $treatment->patient->user ? $treatment->patient->user->name : 'Не вказано' }}</td>
                <td>{{ $treatment->doctor && $treatment->doctor->user ? $treatment->doctor->user->name : 'Не вказано' }}</td>
                <td>{{ $treatment->diagnosis }}</td>
                <td>{{ $treatment->description }}</td>
                <td>{{ $treatment->start_date }}</td>
                <td>{{ $treatment->end_date }}</td>
                <td>
                    <a href="{{ route('treatments.show', $treatment->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити це лікування?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Немає жодного лікування.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $treatments->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
