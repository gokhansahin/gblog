# Tema Sistemi

GBlog, birden fazla tema desteği ile gelir. Admin panelinden kolayca tema değiştirebilirsiniz.

## Tema Yapısı

Temalar `resources/views/themes/` klasörü altında bulunur. Her tema kendi klasöründe yer alır:

```
resources/views/themes/
├── gem/
│   ├── layout.blade.php
│   ├── index.blade.php
│   ├── post.blade.php
│   ├── category.blade.php
│   ├── tag.blade.php
│   ├── page.blade.php
│   └── theme.json
└── labirent/
    ├── layout.blade.php
    ├── index.blade.php
    ├── post.blade.php
    ├── category.blade.php
    ├── tag.blade.php
    ├── page.blade.php
    └── theme.json
```

## Tema Oluşturma

Yeni bir tema oluşturmak için:

1. `resources/views/themes/` altında yeni bir klasör oluşturun (örn: `my-theme`)
2. Gerekli view dosyalarını oluşturun:
   - `layout.blade.php` - Ana layout dosyası
   - `index.blade.php` - Ana sayfa
   - `post.blade.php` - Yazı detay sayfası
   - `category.blade.php` - Kategori sayfası
   - `tag.blade.php` - Etiket sayfası
   - `page.blade.php` - Statik sayfa
   - `theme.json` - Tema bilgileri

3. `theme.json` dosyası örneği:

```json
{
    "name": "Tema Adı",
    "description": "Tema açıklaması",
    "version": "1.0.0",
    "author": "Yazar Adı"
}
```

## Tema Seçimi

Admin panelinden **Ayarlar > Tema Ayarları** bölümünden aktif temayı seçebilirsiniz.

## Tema Geliştirme İpuçları

- Tüm temalar aynı view dosyalarını içermelidir
- Layout dosyasında `@yield('content')` kullanın
- Tema dosyalarında `$settings` değişkeni mevcuttur
- Controller'larda `ThemeService` kullanılarak tema view'ları yüklenir
