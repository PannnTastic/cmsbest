<?php

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_blog')
                    ->label('Judul Blog')
                    ->searchable(),
                TextColumn::make('pdf_blog')
                    ->label('PDF Blog')
                    ->formatStateUsing(fn () => 'View PDF')
                    ->icon('heroicon-o-document-text')
                    ->url(fn (Blog $record) => Storage::url($record->pdf_blog))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->searchable(),
                ImageColumn::make('gambar_blog')
                    ->label('Gambar Blog')
                    ->disk('public')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
