@extends('layouts.app')

@section('content')
    <h1>Деталі ролі</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $role->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $role->id }}</p>
            <p class="card-text"><strong>Кількість користувачів:</strong> {{ $role->users()->count() }}</p>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Назад до списку ролей</a>
        </div>
    </div>
@endsection
