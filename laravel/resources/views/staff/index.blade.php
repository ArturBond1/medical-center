@extends('layouts.app')

@section('content')
    <h1>Працівники</h1>

    <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Додати працівника</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Ім'я користувача</th>
            <th>Відділ</th>
            <th>Посада</th>
            <th>Дії</th>
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

    {{ $staffMembers->links() }}
@endsection
