<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BlogStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Toplam Yazı', Post::count())
                ->description('Tüm yazılar')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary'),
            
            Stat::make('Yayınlanan Yazılar', Post::where('status', 'published')->count())
                ->description('Yayında olan yazılar')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
            
            Stat::make('Toplam Kategori', Category::count())
                ->description('Kategoriler')
                ->descriptionIcon('heroicon-o-folder')
                ->color('info'),
            
            Stat::make('Toplam Yorum', Comment::count())
                ->description('Tüm yorumlar')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->color('warning'),
            
            Stat::make('Bekleyen Yorumlar', Comment::where('status', 'pending')->count())
                ->description('Onay bekleyen yorumlar')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
            
            Stat::make('Toplam Görüntülenme', Post::sum('views'))
                ->description('Tüm yazıların görüntülenme sayısı')
                ->descriptionIcon('heroicon-o-eye')
                ->color('success'),
        ];
    }
}

