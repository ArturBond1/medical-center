@extends('layouts.app')

@section('content')
    <h1>Керування лікарями</h1>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Додати лікаря</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="GET" action="{{ route('doctors.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="id" class="form-control" placeholder="ID лікаря"
                       value="{{ request('id') }}">
            </div>
            <div class="col">
                <input type="text" name="user_name" class="form-control" placeholder="Ім'я користувача"
                       value="{{ request('user_name') }}">
            </div>
            <div class="col">
                <input type="text" name="specialization" class="form-control" placeholder="Спеціалізація"
                       value="{{ request('specialization') }}">
            </div>
            <div class="col">
                <input type="text" name="department_name" class="form-control" placeholder="Відділення"
                       value="{{ request('department_name') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('doctors.index') }}" class="btn btn-light">Очистити</a>
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
            <th>Ім'я користувача</th>
            <th>Спеціалізація</th>
            <th>Відділення</th>
            <th>Кількість прийомів</th>
            <th>Кількість рецептів</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($doctors as $doctor)
            <tr>
                <td>{{ $doctor->id }}</td>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->department->name }}</td>
                <td>{{ $doctor->appointments()->count() }}</td>
                <td>{{ $doctor->prescriptions()->count() }}</td>
                <td>
                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цього лікаря?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Немає жодного лікаря.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $doctors->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>

@endsection
