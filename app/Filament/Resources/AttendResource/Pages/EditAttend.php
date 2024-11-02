<?php

namespace App\Filament\Resources\AttendResource\Pages;

use App\Filament\Resources\AttendResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttend extends EditRecord
{
    protected static string $resource = AttendResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
