@extends('layouts.app')

@section('content')
    <h1>Керування пацієнтами</h1>

    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Додати пацієнта</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('patients.index') }}" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="id" class="form-control" placeholder="ID пацієнта"
                       value="{{ request('id') }}">
            </div>
            <div class="col">
                <input type="text" name="user_name" class="form-control" placeholder="Ім'я користувача"
                       value="{{ request('user_name') }}">
            </div>
            <div class="col">
                <select name="gender" class="form-control">
                    <option value="">Будь-яка стать</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Чоловіча</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Жіноча</option>
                    <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Інша</option>
                </select>
            </div>
            <div class="col">
                <input type="text" name="phone_number" class="form-control" placeholder="Номер телефону"
                       value="{{ request('phone_number') }}">
            </div>
            <div class="col">
                <button type="submit" class="btn btn-secondary">Фільтрувати</button>
                <a href="{{ route('patients.index') }}" class="btn btn-light">Очистити</a>
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


    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Ім'я користувача</th>
                <th>Дата народження</th>
                <th>Стать</th>
                <th>Адреса</th>
                <th>Номер телефону</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->user->name }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->address }}</td>
                    <td>{{ $patient->phone_number }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цього пацієнта?')">Видалити</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Немає жодного пацієнта.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $patients->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection

