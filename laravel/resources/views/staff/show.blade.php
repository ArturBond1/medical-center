@extends('layouts.app')

@section('content')
    <h1>Деталі працівника</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $staff->user->name }}</h5>
            <p class="card-text"><strong>Відділ:</strong> {{ $staff->department->name }}</p>
            <p class="card-text"><strong>Посада:</strong> {{ $staff->position }}</p>
            <a href="{{ route('staff.index') }}" class="btn btn-secondary">Назад до списку працівників</a>
        </div>
    </div>
@endsection
