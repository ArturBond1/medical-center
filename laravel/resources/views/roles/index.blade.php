@extends('layouts.app')

@section('content')
    <h1>Керування ролями</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Додати роль</a>

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

    {{ $roles->links() }}
@endsection
