@extends('layouts.app')

@section('content')
    <h1>Відділення</h1>

    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Додати відділення</a>

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
            <th>Опис</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($departments as $department)
            <tr>
                <td>{{ $department->id }}</td>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити це відділення?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Немає жодного відділення.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $departments->links() }}
@endsection
