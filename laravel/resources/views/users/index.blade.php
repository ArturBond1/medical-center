@extends('layouts.app')

@section('content')
    <h1>Користувачі</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Додати користувача</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('users.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="id" class="form-control" placeholder="ID"
                       value="{{ request('id') }}">
            </div>
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Ім'я"
                       value="{{ request('name') }}">
            </div>
            <div class="col">
                <input type="text" name="email" class="form-control" placeholder="Email"
                       value="{{ request('email') }}">
            </div>
            <div class="col">
                <select name="role_id" class="form-control">
                    <option value="">Усі ролі</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('users.index') }}" class="btn btn-light">Очистити</a>
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

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Email</th>
            <th>Роль</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Ви впевнені, що хочете видалити цього користувача?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Немає жодного користувача.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $users->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
