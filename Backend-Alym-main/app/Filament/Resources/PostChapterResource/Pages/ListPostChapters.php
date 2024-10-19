<?php

namespace App\Filament\Resources\PostChapterResource\Pages;

use App\Filament\Resources\PostChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostChapters extends ListRecords
{
    protected static string $resource = PostChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
