<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews System - Vinh Web</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/css_revert.css') }}">
    <style>
        .btn-primary {
            @apply bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded shadow transition-all;
        }

        .input-field {
            @apply border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-indigo-500 w-full;
        }

        .filter-item {
            @apply bg-white border border-gray-200 px-4 py-2 rounded-md font-medium text-gray-600 hover:bg-gray-50 transition-all cursor-pointer;
        }

        .filter-active {
            @apply bg-indigo-50 border-indigo-500 text-indigo-700 !important;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 font-sans antialiased min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('books.index') }}" class="text-2xl font-bold text-indigo-600 tracking-tight">
                📚 Book<span class="text-gray-800">Reviews</span>
            </a>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">
                    <form action="/logout" method="POST">@csrf
                        <button type="submit">Đăng xuất</button>
                    </form>
                    Xin chào {{ auth()->user()->name }}
                </span>
            </div>
        </div>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-8">
        @yield('content')
    </main>
    <footer class="text-center py-8 text-sm text-gray-400 border-t border-gray-200 mt-12 bg-white">
        &copy; {{ date('Y') }} Dự án Book Reviews - Kênh học lập trình Vinh Web.
    </footer>
</body>

</html>