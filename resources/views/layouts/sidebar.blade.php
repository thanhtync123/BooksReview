<!DOCTYPE html>
<html>
<body>
    The content of the body element is displayed in your browser.
</body>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/css_revert.css') }}">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-900 text-white p-5">
            <h1 class="text-2xl font-bold mb-6">ADMIN</h1>

            <nav class="space-y-3">
                <a href="#" class="block p-2 rounded hover:bg-gray-700">
                    🏠 Dashboard
                </a>

                <a href="{{ route('admin.books.index') }}"
                    class="block p-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.books.*') ? 'bg-gray-700 text-white' : '' }}">
                    📚 Books
                </a>

                <a href="#" class="block p-2 rounded hover:bg-gray-700">
                    👤 Users
                </a>
                <a href="#" class="block p-2 rounded hover:bg-gray-700">
                    ⚙️ Settings
                </a>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow p-4 flex justify-between">
                <div class="text-sm text-gray-600">Chào {{ Auth::user()->name }}</div>
            </header>
            <!-- CONTENT -->
            <main class="p-6 space-y-6">
                @include('partials.alert')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
</html>