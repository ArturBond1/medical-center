@extends('layouts.app')

@section('content')
    <h1>Користувачі</h1>

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Додати користувача</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я</th>
            <th>Email</th>
            <th>Роль</th>
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
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цього користувача?')">Видалити</button>
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

    {{ $users->links() }}
@endsection
