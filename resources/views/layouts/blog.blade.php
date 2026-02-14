<?php
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheCafé | Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased">

    <nav class="bg-white border-b-2 border-amber-800 py-4 shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-2xl font-extrabold text-amber-900 tracking-tight">TheCafé</h1>
            
            <div class="space-x-8 flex items-center font-medium">
                <a href="/" class="text-stone-600 hover:text-amber-800 transition">Home</a>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-stone-600 hover:text-amber-800 transition">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold ml-4">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-stone-600 hover:text-amber-800 transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-amber-800 text-white px-5 py-2 rounded-xl hover:bg-amber-900 transition shadow-sm">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="min-h-screen">
        @yield('content')
    </div>

    <footer class="bg-white border-t-2 border-amber-800 py-12 mt-20">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-stone-400 text-sm font-medium italic">
                &copy; 2026 TheCafé &bull; Authentic Cafe Hunting Blog
            </p>
        </div>
    </footer>

</body>
</html>