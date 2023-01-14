<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{-- メッセージ --}}
            @if (session('message.success') || session('message.error') || $errors->any())
                @if (session('message.success'))
                    <div class="pt-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded"
                                role="alert">
                                {{ session('message.success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if (session('message.error'))
                    <div class="pt-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-red-100 border border-red-500 text-red-700 px-4 py-3 rounded" role="alert">
                                {{ session('message.error') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="pt-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-red-100 border border-red-500 text-red-700 px-4 py-3 rounded" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{ $slot }}
        </main>
    </div>
</body>

</html>
