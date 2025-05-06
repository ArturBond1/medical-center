@extends('layouts.app')

@section('content')
    <h1>Керування діагнозами</h1>

    <a href="{{ route('diagnoses.create') }}" class="btn btn-primary mb-3">Додати діагноз</a>

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
            <th>Кількість медкарток</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($diagnoses as $diagnosis)
            <tr>
                <td>{{ $diagnosis->id }}</td>
                <td>{{ $diagnosis->name }}</td>
                <td>{{ $diagnosis->description }}</td>
                <td>{{ $diagnosis->medicalRecords()->count() }}</td>
                <td>
                    <a href="{{ route('diagnoses.show', $diagnosis->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('diagnoses.edit', $diagnosis->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('diagnoses.destroy', $diagnosis->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цей діагноз?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Немає жодного діагнозу.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $diagnoses->links() }}
@endsection
