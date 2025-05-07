@extends('layouts.app')

@section('content')
    <h1>Керування медикаментами</h1>

    <a href="{{ route('medications.create') }}" class="btn btn-primary mb-3">Додати медикамент</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('medications.index') }}" method="GET" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="id">ID:</label>
                <input type="number" class="form-control" id="id" name="id" value="{{ request('id') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="name">Назва:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="dosage">Дозування:</label>
                <input type="text" class="form-control" id="dosage" name="dosage" value="{{ request('dosage') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="description">Опис:</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ request('description') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="cost">Вартість:</label>
                <input type="number" class="form-control" id="cost" name="cost" value="{{ request('cost') }}">
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Фільтрувати</button>
                <a href="{{ route('medications.index') }}" class="btn btn-secondary mt-4">Очистити</a>
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
            <th>Назва</th>
            <th>Дозування</th>
            <th>Опис</th>
            <th>Вартість</th>
            <th>Кількість рецептів</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($medications as $medication)
            <tr>
                <td>{{ $medication->id }}</td>
                <td>{{ $medication->name }}</td>
                <td>{{ $medication->dosage }}</td>
                <td>{{ Str::limit($medication->description, 50) }}</td>
                <td>{{ $medication->cost }}</td>
                <td>{{ $medication->prescriptions()->count() }}</td>
                <td>
                    <a href="{{ route('medications.show', $medication->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('medications.edit', $medication->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('medications.destroy', $medication->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей медикамент?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7">Немає жодного медикаменту.</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $medications->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
