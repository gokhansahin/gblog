<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentPostsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Post::query()
                    ->latest('created_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Kapak')
                    ->getStateUsing(fn (Post $record) => $record->getFirstMediaUrl('cover', 'thumb') ?: $record->getFirstMediaUrl('cover'))
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('title')
                    ->label('Başlık')
                    ->searchable()
                    ->limit(30)
                    ->url(fn (Post $record) => PostResource::getUrl('edit', ['record' => $record])),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Yazar')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'warning',
                        'published' => 'success',
                        'scheduled' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Taslak',
                        'published' => 'Yayınlandı',
                        'scheduled' => 'Zamanlanmış',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->heading('Son Yazılar')
            ->defaultSort('created_at', 'desc');
    }
}

