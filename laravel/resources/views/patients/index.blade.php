@extends('layouts.app')

@section('content')
    <h1>Керування пацієнтами</h1>

    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Додати пацієнта</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

    {{ $patients->links() }}
@endsection

