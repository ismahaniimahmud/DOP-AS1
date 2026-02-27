<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheCafé Homepage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <a href="{{ route('dashboard') }}"><h1 class="text-xl font-bold">TheCafé</h1></a>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-500">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-500">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-10 px-6 text-center">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-10 py-6 bg-white text-center shadow-md">
        <p class="text-gray-600">&copy; 2026 TheCafé. All rights reserved.</p>
    </footer>
</body>
</html>
