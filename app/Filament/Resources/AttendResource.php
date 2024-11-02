<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendResource\Pages;
use App\Filament\Resources\AttendResource\RelationManagers;
use  App\Models\User;
use App\Models\Attend;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Unique;

class AttendResource extends Resource
{
    protected static ?string $model = Attend::class;
    protected static ?string $label = 'Absensi Siswa';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Absensi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('user_id')
                    ->label('Siswa')
                    ->options(User::get()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    //use Illuminate\Validation\Rules\Unique;
                    ->unique(modifyRuleUsing: function (unique $rule) {
                        return $rule->where(function ($query) {
                            $query->whereDate('created_at', now());
                        });
                    }),
                \Filament\Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'Sakit' => 'Sakit',
                        'Izin' => 'Izin',
                        'Alfa' => 'Alfa'
                    ])
                    ->required(),
                \Filament\Forms\Components\DatePicker::make('date')
                    ->required()
                    ->default(now())
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('user.name'),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'sakit' => 'success',
                        'izin' => 'warning',
                        'alfa' => 'danger'
                    }),
                \Filament\Tables\Columns\TextColumn::make('date'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttends::route('/'),
            'create' => Pages\CreateAttend::route('/create'),
            'edit' => Pages\EditAttend::route('/{record}/edit'),
        ];
    }
}
