<?php

namespace App\Filament\Resources\AttendResource\Pages;

use App\Filament\Resources\AttendResource;
use App\Models\Attend;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class CreateAttend extends CreateRecord
{
    protected static string $resource = AttendResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // cek apakah absensi sudah ada pada hari ini apa belum
        $attend_today = Attend::where('user_id', $data['user_id'])
            ->whereDate('created_at', $data['date'])
            ->first();

        if ($attend_today == null) {
            return static::getModel()::create($data);
        }

        return $attend_today;
    }
}
