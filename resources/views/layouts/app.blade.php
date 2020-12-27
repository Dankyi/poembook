<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome Free -->
    <script src="{{ config ('services.fontawesome.url') }}" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-800 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <nav class="space-x-4 text-white text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div>
                            <button id="userBtn" class="block fa-sm focus:outline-none">
                                <i class="fas fa-user"></i><span class="text-base">  {{ Auth::user()->name }}  </span><i class="fas fa-caret-down"></i>
                            </button>


                            <button id="notUserBtn" class="hidden absolute focus:outline-none inset-0 h-full w-full cursor-default"></button>

                            <div id="dropdown" class="hidden absolute flex flex-col mt-2 py-2 w-48 text-black bg-blue-300 rounded-lg shadow-xl">
                                <a class="block px-4 py-2 hover:bg-blue-700 hover:text-white" href="#">My Profile</a>
                                <a class="block px-4 py-2 hover:bg-blue-700 hover:text-white" href="#">My Favorite Poems</a>
                                <a class="block px-4 py-2 hover:bg-blue-700 hover:text-white" href="{{ route('logout') }}"
                                   class="no-underline hover:underline"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>

                    @endguest
                </nav>
            </div>
        </header>

        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const userBtn = document.querySelector('#userBtn');
                const dropdown = document.querySelector('#dropdown');
                const notUserBtn = document.querySelector('#notUserBtn');

                userBtn.addEventListener('click', () => {
                    dropdown.classList.toggle('hidden');
                    dropdown.classList.toggle('flex');
                    notUserBtn.classList.toggle('hidden');
                });

                notUserBtn.addEventListener('click', () => {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('flex');
                    notUserBtn.classList.toggle('hidden');
                });
            })
        </script>

        @yield('header')
        @yield('content')

    </div>
</body>
</html>
