<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

    
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex">

    <div class="w-64 bg-white shadow-md">
        <div class="p-4 font-bold text-lg border-b">
            Hospital System
        </div>

        <ul class="p-4 space-y-2">

            <li>
                <a href="/dashboard"
                class="block p-2 rounded hover:bg-gray-200 {{ request()->is('dashboard') ? 'bg-gray-300' : '' }}">
                    🏠 Dashboard
                </a>
            </li>

            @if(in_array(auth()->user()->role, ['nurse','receptionist']))
            <li>
                <a href="/patients"
                class="block p-2 rounded hover:bg-gray-200 {{ request()->is('patients') ? 'bg-gray-300' : '' }}">
                    🧾 Patients
                </a>
            </li>
            @endif

           
            @if(in_array(auth()->user()->role, ['nurse','receptionist','doctor']))
            <li>
                <a href="/queue"
                class="block p-2 rounded hover:bg-gray-200 {{ request()->is('queue') ? 'bg-gray-300' : '' }}">
                    🚨 Queue
                </a>
            </li>
            @endif

          
            @if(auth()->user()->role === 'admin')
            <li>
                <a href="/users"
                class="block p-2 rounded hover:bg-gray-200 {{ request()->is('users') ? 'bg-gray-300' : '' }}">
                    👥 Users
                </a>
            </li>

            <li>
                <a href="/reports"
                class="block p-2 rounded hover:bg-gray-200 {{ request()->is('reports') ? 'bg-gray-300' : '' }}">
                    📊 Reports
                </a>
            </li>
            @endif

            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="w-full text-left block p-2 rounded hover:bg-gray-200">
                        🔒 Logout
                    </button>
                </form>
            </li>

        </ul>
    </div>
        
        <div class="flex-1">

            @include('layouts.navigation')

     
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>