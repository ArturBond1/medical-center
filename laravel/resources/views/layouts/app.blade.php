<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('roles.index') }}">Ролі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">Користувачі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patients.index') }}">Пацієнти</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('doctors.index') }}">Лікарі</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staff.index') }}">Персонал</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('departments.index') }}">Відділення</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appointments.index') }}">Прийоми</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('treatments.index') }}">Лікування</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('prescriptions.index') }}">Рецепти</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medical_records.index') }}">Мед картки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('medications.index') }}">Ліки</a>
                    </li>


                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 container">
        @yield('content')
    </main>

    <footer class="text-center py-3">
        &copy; {{ date('Y') }} Система управління медичним центром - Житомир
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
