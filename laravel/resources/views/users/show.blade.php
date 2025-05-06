@extends('layouts.app')

@section('content')
    <h1>Деталі користувача</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text"><strong>ID:</strong> {{ $user->id }}</p>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Роль:</strong> {{ $user->role->name }}</p>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Назад до списку користувачів</a>
        </div>
    </div>
@endsection

