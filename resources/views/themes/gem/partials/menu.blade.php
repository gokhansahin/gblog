@php
    /** @var \Illuminate\Support\Collection|\App\Models\Category[]|null $categories */
    $menuCategories = $categories ?? \App\Models\Category::select('id','name','slug')->orderBy('name')->get();
    $firstCategory = $menuCategories->first();
@endphp

<nav class="nav flex-column gap-2 my-4">
    <a class="nav-link-custom" href="{{ route('blog.index') }}">Yazılar</a>

    @if($menuCategories->count())
        <div class="dropdown">
            <a class="nav-link-custom dropdown-toggle" href="#" id="dropdownCategories" data-bs-toggle="dropdown" aria-expanded="false">Kategoriler
            </a>
            <ul class="dropdown-menu bg-dark border-secondary shadow" aria-labelledby="dropdownCategories">
                @foreach($menuCategories as $cat)
                    <li>
                        <a class="dropdown-item text-white" href="{{ route('blog.category', $cat->slug) }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <a class="nav-link-custom" href="{{ route('blog.category', $firstCategory?->slug ?? 'kategori') }}">Kategoriler</a>
    @endif

    @auth
        <a class="nav-link-custom" href="{{ url('/admin') }}">Admin</a>
    @endauth
</nav>

