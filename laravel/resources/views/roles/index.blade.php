@extends('layouts.app')

@section('content')
    <h1>Керування ролями</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Додати роль</a>
    <form method="GET" action="{{ route('roles.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="id" class="form-control" placeholder="ID"
                       value="{{ request('id') }}">
            </div>
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Назва"
                       value="{{ request('name') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('roles.index') }}" class="btn btn-light">Очистити</a>
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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Кількість користувачів</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->users()->count() }}</td>
                <td>
                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цю роль?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Немає жодної ролі.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $roles->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>

@endsection
