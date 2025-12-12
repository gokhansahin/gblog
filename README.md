# GBlog - Çoklu Yazar Blog Sistemi

Laravel 12 ve Filament 4 kullanılarak geliştirilmiş çoklu yazar destekli blog sistemi.

## Özellikler

- ✅ Çoklu yazar sistemi (Admin, Editor, Author rolleri)
- ✅ Filament 4 ile yönetim paneli
- ✅ Yazı, kategori, etiket yönetimi
- ✅ Yorum sistemi (ayarlardan aç/kapat)
- ✅ Site haritası (sitemap.xml)
- ✅ SEO optimizasyonu (meta title, description)
- ✅ Medya yönetimi (kapak görselleri)
- ✅ Kullanıcı profil alanları

## Gereksinimler

- PHP 8.2+
- Composer
- MySQL/MariaDB
- Node.js & NPM

## Kurulum

1. Projeyi klonlayın:
```bash
git clone <repo-url>
cd gblog
```

2. Bağımlılıkları yükleyin:
```bash
composer install
npm install
```

3. `.env` dosyasını oluşturun ve veritabanı bilgilerini girin:
```bash
cp .env.example .env
php artisan key:generate
```

4. Veritabanını oluşturun ve migration'ları çalıştırın:
```bash
php artisan migrate
php artisan db:seed
```

5. Storage linkini oluşturun:
```bash
php artisan storage:link
```

## Varsayılan Kullanıcılar

Seeder çalıştırıldıktan sonra şu kullanıcılar oluşturulur:

- **Admin**: `admin@example.com` / `password`
- **Editor**: `editor@example.com` / `password`
- **Author**: `author@example.com` / `password`

## Kullanım

### Admin Panel

Admin paneline `/admin` adresinden erişebilirsiniz. Varsayılan kullanıcılardan biriyle giriş yapın.

### Frontend

- Ana sayfa: `/`
- Yazı detay: `/post/{slug}`
- Kategori: `/category/{slug}`
- Etiket: `/tag/{slug}`
- Sayfa: `/page/{slug}`
- Site haritası: `/sitemap.xml`

## Roller ve İzinler

- **Admin**: Tüm yetkilere sahip
- **Editor**: Tüm içerikleri yönetebilir
- **Author**: Sadece kendi yazılarını yönetebilir

## Teknolojiler

- Laravel 12
- Filament 4
- Spatie Permission
- Spatie Media Library
- Spatie Sitemap
- Spatie Settings
- Spatie Sluggable
- Tailwind CSS

## Lisans

MIT
