@extends('layouts.app')

@section('content')
    <h1>Працівники</h1>

    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Додати працівника</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Форма для фільтрації -->
    <form method="GET" action="{{ route('staff.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="id" class="form-control" placeholder="ID працівника"
                       value="{{ request('id') }}">
            </div>
            <div class="col">
                <input type="text" name="user_name" class="form-control" placeholder="Ім'я користувача"
                       value="{{ request('user_name') }}">
            </div>
            <div class="col">
                <input type="text" name="department_name" class="form-control" placeholder="Відділ"
                       value="{{ request('department_name') }}">
            </div>
            <div class="col">
                <input type="text" name="position" class="form-control" placeholder="Посада"
                       value="{{ request('position') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('staff.index') }}" class="btn btn-light">Очистити</a>
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
            <th>Відділ</th>
            <th>Посада</th>
        </tr>
        </thead>
        <tbody>
        @forelse($staffMembers as $staff)
            <tr>
                <td>{{ $staff->id }}</td>
                <td>{{ $staff->user->name }}</td>
                <td>{{ $staff->department->name }}</td>
                <td>{{ $staff->position }}</td>
                <td>
                    <a href="{{ route('staff.show', $staff->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цього працівника?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Немає жодного працівника.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $staffMembers->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
