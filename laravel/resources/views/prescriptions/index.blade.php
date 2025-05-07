@extends('layouts.app')

@section('content')
    <h1>Список рецептів</h1>
    <form action="{{ route('prescriptions.index') }}" method="GET" class="mb-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="doctor_id">Лікар:</label>
                <select class="form-control" id="doctor_id" name="doctor_id">
                    <option value="">Виберіть лікаря</option>
                    @foreach($doctors as $id => $name)
                        <option value="{{ $id }}" {{ request('doctor_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="patient_id">Пацієнт:</label>
                <select class="form-control" id="patient_id" name="patient_id">
                    <option value="">Виберіть пацієнта</option>
                    @foreach($patients as $id => $name)
                        <option value="{{ $id }}" {{ request('patient_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="medication_id">Ліки:</label>
                <select class="form-control" id="medication_id" name="medication_id">
                    <option value="">Виберіть ліки</option>
                    @foreach($medications as $id => $name)
                        <option value="{{ $id }}" {{ request('medication_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="notes">Примітки:</label>
                <input type="text" class="form-control" id="notes" name="notes" value="{{ request('notes') }}">
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Фільтрувати</button>
                <a href="{{ route('prescriptions.index') }}" class="btn btn-secondary mt-4">Очистити</a>
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
        <div class="d-flex justify-content-center mt-4">
            {{ $prescriptions->appends(request()->query())->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
        </div>
    @endif
@endsection
