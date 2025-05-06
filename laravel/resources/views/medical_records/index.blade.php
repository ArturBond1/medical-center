@extends('layouts.app')

@section('content')
    <h1>Керування медичними картками</h1>

    <a href="{{ route('medical_records.create') }}" class="btn btn-primary mb-3">Додати медичну картку</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пацієнт</th>
            <th>Діагноз</th>
            <th>План лікування</th>
            <th>Примітки</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($medicalRecords as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->patient->user->name }}</td>
                <td>{{ Str::limit($record->diagnosis, 50) }}</td>
                <td>{{ Str::limit($record->treatment_plan, 50) }}</td>
                <td>{{ Str::limit($record->notes, 50) }}</td>
                <td>
                    <a href="{{ route('medical_records.show', $record->id) }}" class="btn btn-info btn-sm">Перегляд</a>
                    <a href="{{ route('medical_records.edit', $record->id) }}" class="btn btn-primary btn-sm">Редагувати</a>
                    <form action="{{ route('medical_records.destroy', $record->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені, що хочете видалити цю медичну картку?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Немає жодної медичної картки.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $medicalRecords->links() }}
@endsection
