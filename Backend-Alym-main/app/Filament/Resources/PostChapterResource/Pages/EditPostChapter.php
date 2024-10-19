<?php

namespace App\Filament\Resources\PostChapterResource\Pages;

use App\Filament\Resources\PostChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostChapter extends EditRecord
{
    protected static string $resource = PostChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
