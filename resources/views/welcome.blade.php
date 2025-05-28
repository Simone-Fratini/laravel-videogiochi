<!DOCTYPE html>
<html lang="En">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GameHub</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="container mx-auto px-4 py-8 min-h-screen flex flex-col">
            <!-- Navigation -->
            <header class="max-w-4xl mx-auto">
                <img class="w-12 h-12 md:w-24 md:h-24 transition-transform hover:scale-110 duration-300" src="{{asset('images/logo.svg')}}" alt="GameHub Logo">
            </header>

            <!-- Main Content -->
            <main class="flex-1 flex items-center justify-center">
                <div class="max-w-4xl w-full">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 md:p-12">
                        <div class="text-center">
                            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-6">
                                Welcome to GameHub
                            </h1>
                            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                                Your ultimate gaming platform control panel
                            </p>
                            <div class="space-y-6">
                                @auth
                                    <a href="{{ url('/dashboard') }}" 
                                       class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        Go to Dashboard
                                    </a>
                                @else
                                    <div class="flex flex-col md:flex-row items-center justify-center gap-4">
                                        <a href="{{ route('login') }}" 
                                           class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                            Login to Dashboard
                                        </a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                               class="w-full md:w-auto px-8 py-3 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white rounded-lg font-semibold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300">
                                                Create Account
                                            </a>
                                        @endif
                                    </div>
                                @endauth
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">
                                    Manage your gaming content
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
