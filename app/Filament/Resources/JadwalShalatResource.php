<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalShalatResource\Pages;
use App\Models\JadwalShalat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalShalatResource extends Resource
{
    protected static ?string $model = JadwalShalat::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Jadwal Shalat';
    protected static ?string $pluralModelLabel = 'Jadwal Shalat';
    protected static ?string $slug = 'jadwal-shalats';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kota')
                    ->label('Kota')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TimePicker::make('subuh')
                    ->label('🌅 Subuh')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('H:i')
                    ->hoursStep(1)
                    ->minutesStep(1),

                Forms\Components\TimePicker::make('dzuhur')
                    ->label('🏞️ Dzuhur')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('H:i')
                    ->hoursStep(1)
                    ->minutesStep(1),

                Forms\Components\TimePicker::make('ashar')
                    ->label('🌇 Ashar')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('H:i')
                    ->hoursStep(1)
                    ->minutesStep(1),

                Forms\Components\TimePicker::make('maghrib')
                    ->label('🌆 Maghrib')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('H:i')
                    ->hoursStep(1)
                    ->minutesStep(1),

                Forms\Components\TimePicker::make('isya')
                    ->label('🌃 Isya')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('H:i')
                    ->hoursStep(1)
                    ->minutesStep(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kota')
                    ->label('🏙️ Kota')
                    ->sortable()
                    ->searchable()
                    ->color('primary')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('subuh')
                    ->label('🌅 Subuh'),

                Tables\Columns\TextColumn::make('dzuhur')
                    ->label('🏞️ Dzuhur'),

                Tables\Columns\TextColumn::make('ashar')
                    ->label('🌇 Ashar'),

                Tables\Columns\TextColumn::make('maghrib')
                    ->label('🌆 Maghrib'),

                Tables\Columns\TextColumn::make('isya')
                    ->label('🌃 Isya'),
            ])
            ->filters([
                // Tambahkan filter jika perlu
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalShalats::route('/'),
            'create' => Pages\CreateJadwalShalat::route('/create'),
            'edit' => Pages\EditJadwalShalat::route('/{record}/edit'),
        ];
    }
}
