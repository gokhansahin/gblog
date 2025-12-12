<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GBlog') - {{ app(\App\Settings\BlogSettings::class)->site_name ?? 'GBlog' }}</title>
    <meta name="description" content="@yield('description', app(\App\Settings\BlogSettings::class)->site_description ?? '')">

    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('blog.index') }}" class="text-2xl font-bold text-gray-900">
                        {{ app(\App\Settings\BlogSettings::class)->site_name ?? 'GBlog' }}
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-gray-900">Ana Sayfa</a>
                    @auth
                        <a href="{{ url('/admin') }}" class="text-gray-700 hover:text-gray-900">Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <p class="text-center text-gray-600">
                &copy; {{ date('Y') }} {{ app(\App\Settings\BlogSettings::class)->site_name ?? 'GBlog' }}. Tüm hakları saklıdır.
            </p>
        </div>
    </footer>
</body>
</html>

