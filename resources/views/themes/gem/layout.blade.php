<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings->site_name ?? 'GBlog')</title>
    <meta name="description" content="@yield('description', $settings->site_description ?? '')">

    @livewireStyles

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --bg-color: #0a0a0a;
            --text-color: #e0e0e0;
            --accent-color: #dbf246;
            --border-color: #333;
            --secondary-accent: #ff4d00;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Space Mono', monospace;
            overflow-x: hidden;
        }

        h1, h2, h3, .display-font {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            letter-spacing: -1px;
        }
        .text-muted {
            color: rgb(181 182 183 / 75%) !important;
        }


        .sidebar-panel {
            min-height: 100vh;
            border-right: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand-logo {
            font-size: 3rem;
            line-height: 0.9;
            color: var(--accent-color);
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        .brand-logo:hover { transform: skewX(-8deg); }

        .nav-link-custom {
            font-size: 1.2rem;
            color: var(--text-color);
            text-transform: uppercase;
            border-bottom: 1px solid transparent;
            width: fit-content;
            transition: all 0.3s;
            display: block;
            padding: 0.35rem 0;
        }
        .nav-link-custom:hover {
            color: var(--accent-color);
            padding-left: 12px;
        }
        .nav-link-custom::before {
            content: "->";
            opacity: 0;
            margin-right: 10px;
            transition: opacity 0.3s;
        }
        .nav-link-custom:hover::before { opacity: 1; }

        .content-panel {
            margin-left: 0;
            min-height: 100vh;
            border-left: 1px solid var(--border-color);
        }

        .marquee-container {
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            background: var(--accent-color);
            color: var(--bg-color);
            overflow: hidden;
            white-space: nowrap;
        }
        .marquee-text {
            display: inline-block;
            animation: marquee 20s linear infinite;
            font-weight: bold;
            font-size: 1.05rem;
            text-transform: uppercase;
        }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .post-item {
            border-bottom: 1px solid var(--border-color);
            padding: 3rem 2rem;
            position: relative;
            transition: background 0.3s;
        }
        .post-item:hover { background-color: #111; }
        .post-meta {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 1rem;
            display: block;
        }
        .post-title {
            font-size: 2.8rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #fff;
            transition: color 0.3s;
        }
        .post-item:hover .post-title {
            color: var(--accent-color);
        }
        .post-image-wrapper {
            overflow: hidden;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }
        .post-image {
            width: 100%;
            height: 340px;
            object-fit: cover;
            filter: grayscale(100%);
            transition: transform 0.5s, filter 0.5s;
        }
        .post-item:hover .post-image {
            transform: scale(1.05);
            filter: grayscale(0%);
        }
        .read-btn {
            border: 1px solid var(--text-color);
            color: var(--text-color);
            padding: 10px 26px;
            text-decoration: none;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 1rem;
            transition: all 0.3s;
        }
        .read-btn:hover {
            background: var(--accent-color);
            color: var(--bg-color);
            border-color: var(--accent-color);
            box-shadow: 5px 5px 0px var(--secondary-accent);
        }

        /* Dropdown menu override */
        .dropdown-menu.bg-dark {
            background: #0f0f0f;
            border-color: var(--border-color);
        }
        .dropdown-menu.bg-dark .dropdown-item {
            color: var(--text-color);
        }
        .dropdown-menu.bg-dark .dropdown-item:hover,
        .dropdown-menu.bg-dark .dropdown-item:focus,
        .dropdown-menu.bg-dark .dropdown-item.active {
            background: #111;
            color: var(--accent-color);
        }
        .dropdown-toggle::after {
            vertical-align: middle;
        }

        @media (max-width: 991px) {
            .sidebar-panel {
                position: relative;
                height: auto;
                width: 100%;
                border-right: none;
                border-bottom: 1px solid var(--border-color);
                padding: 2rem;
            }
            .post-title { font-size: 2rem; }
            .content-panel { border-left: none; }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-lg-4">
            <div class="sidebar-panel">
                <div>
                    <a href="{{ route('blog.index') }}" class="text-decoration-none">
                        <div class="brand-logo">{{ $settings->site_name ?? 'GBlog' }}</div>
                    </a>
                    @if($settings->site_tagline)
                        <p class="text-muted">{{ $settings->site_tagline }}</p>
                    @endif
                </div>

                @include('themes.gem.partials.menu', [
                    'categories' => $categories ?? null,
                ])

                <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
                    <div class="socials d-flex gap-3">
                        @php($social = app(\App\Settings\SocialSettings::class)->links ?? [])
                        @forelse($social as $link)
                            <a href="{{ $link['url'] ?? '#' }}" class="text-white fs-5" target="_blank" rel="noopener">
                           
                                    <i class="{{ $link['icon'] }}"></i>
                          
                            </a>
                        @empty
                            <a href="#" class="text-muted fs-6">Sosyal ekle</a>
                        @endforelse
                    </div>
                    <div class="text-end text-muted" style="font-size: 0.7rem;">
                        © {{ date('Y') }}<br>{{ $settings->site_name ?? 'GBlog' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 content-panel">
            @yield('content')


        </div>
    </div>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

