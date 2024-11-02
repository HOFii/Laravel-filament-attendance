<?php

namespace App\Filament\Resources\AttendResource\Pages;

use App\Filament\Resources\AttendResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAttends extends ListRecords
{
    protected static string $resource = AttendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
