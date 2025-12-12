<?php

return [
    'class_namespace' => 'App\\Livewire',

    'view_path' => resource_path('views/livewire'),

    'layout' => 'components.layouts.app',

    'lazy_placeholder' => null,

    'temporary_file_upload' => [
        // Temp dosyalar için disk: local (storage/app)
        'disk' => 'public',
        // Temp klasörü
        'directory' => 'livewire-tmp',
        // Varsayılan kurallar
        'rules' => null,
        // Varsayılan middleware
        'middleware' => null,
        // Önizleme desteklenen mime’lar
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        // Upload geçerlilik süresi (dakika)
        'max_upload_time' => 5,
        // 24 saatten eski temp dosyaları temizle
        'cleanup' => true,
    ],

    'render_on_redirect' => false,

    'legacy_model_binding' => false,

    'inject_assets' => true,

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],

    'inject_morph_markers' => true,

    'smart_wire_keys' => false,

    'pagination_theme' => 'tailwind',

    'release_token' => 'a',
];

