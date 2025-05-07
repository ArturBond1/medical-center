@extends('layouts.app')

@section('content')
    <h1>Список рецептів</h1>

    <a href="{{ route('prescriptions.create') }}" class="btn btn-primary mb-3">Створити новий рецепт</a>

    @if($prescriptions->isEmpty())
        <p>Рецептів поки немає.</p>
    @else
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Лікар</th>
                <th>Пацієнт</th>
                <th>Ліки</th>
                <th>Примітки</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->id }}</td>
                    <td>{{ $prescription->doctor->user->name ?? '—' }}</td>
                    <td>{{ $prescription->patient->user->name ?? '—' }}</td>
                    <td>{{ $prescription->medication->name ?? '—' }}</td>
                    <td>{{ $prescription->notes }}</td>
                    <td>
                        <a href="{{ route('prescriptions.show', $prescription) }}" class="btn btn-info btn-sm">Переглянути</a>
                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="btn btn-warning btn-sm">Редагувати</a>

                        <!-- Delete form -->
                        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Ви впевнені, що хочете видалити цей рецепт?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
