<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>PirateGram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
        <!-- Fonts -->

        <!-- Styles -->
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-4xl font-black">
                    PirateGram
                </a>
               <form method="GET" action="" class="flex items-center">
                    @csrf
                    <div class="relative w-full">
                        <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar" required>
                    </div>
                    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-gray-700 rounded-lg border border-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>      
                        <span class="sr-only">Search</span>
                    </button>
                </form>
                @auth
                    <nav class="flex gap-5">
                        <a href="{{ route('posts.create')}}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                            </svg>
                          Crear</a>
                        <a class="font-bold uppercase text-gray-600 p-2" href="{{route('posts.index', auth()->user()->username)}}">Hola: <span class="font-normal">{{ auth()->user()->username }}</span></a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-bold uppercase text-gray-600 p-2">Cerrar Sesión</button>
                        </form>
                    </nav>
                @endauth

                @guest
                    <nav class="flex gap-16">
                        <a class="font-bold uppercase text-gray-600" href="{{ route('login')}}">Login</a>
                        <a class="font-bold uppercase text-gray-600" href="{{ route('register') }}">Crear Cuenta</a>
                    </nav>
                @endguest

            </div>
        </header>

        <main class="container mx-auto mt-10 mb-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>

        <footer class="text-center p-5 text-gray-500 font-bold uppercase">
            Devstagram - Todos los derechos Reservados 
            {{ now() -> year}}
        </footer>
        
        @livewireScripts
    </body>

</html>