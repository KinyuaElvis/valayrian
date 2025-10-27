<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind CSS via CDN -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <h1 class="text-2xl font-bold text-green-700">PestGuard - Admin Panel</h1>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @yield('content')
        </div>
    </div>


    <script src="{{ asset('js/custom.js') }}"></script>

     <!-- USER LINK -->
        <div class="group fixed bottom-5 right-5 z-50">
            <a href="{{ route('login') }}"
               class="flex items-center justify-center p-3 bg-gray-700 rounded-full shadow-lg
                      hover:bg-gray-800 transition-all duration-300">
                <!-- SVG Icon -->
                <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286Zm0 13.036h.008v.008h-.008v-.008Z" />
                </svg>

                <!-- Hidden Text Label -->
                <span class="absolute right-14 whitespace-nowrap text-white bg-gray-800 px-3 py-1 rounded-md
                             opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-sm">
                    User Login
                </span>
            </a>
        </div>
        <!-- END OF USER LINK SECTION -->
</body>
</html>