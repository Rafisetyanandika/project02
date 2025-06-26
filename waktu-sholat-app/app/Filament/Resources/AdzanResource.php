<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdzanResource\Pages;
use App\Models\Adzan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ViewColumn;

class AdzanResource extends Resource
{
    protected static ?string $model = Adzan::class;

    protected static ?string $navigationIcon = 'heroicon-o-musical-note';
    protected static ?string $navigationLabel = 'Adzan';
    protected static ?string $slug = 'adzans';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->label('🎙️ Nama Adzan')
                ->required()
                ->maxLength(255),

            Forms\Components\FileUpload::make('audio_path')
                ->label('📂 File Audio')
                ->disk('public') // Tersimpan di storage/app/public/audio
                ->directory('audio')
                ->acceptedFileTypes([
                    'audio/mpeg', 'audio/mp3', 'audio/MP3', 'audio/x-mpeg'
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('🎙️ Nama Adzan')
                    ->sortable()
                    ->searchable(),

                ViewColumn::make('audio_path')
                    ->label('▶️ Putar Adzan')
                    ->view('tables.columns.play-audio'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('✏️ Edit'),
                Tables\Actions\DeleteAction::make()->label('🗑️ Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->label('🗑️ Hapus Terpilih'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAdzans::route('/'),
            'create' => Pages\CreateAdzan::route('/create'),
            'edit'   => Pages\EditAdzan::route('/{record}/edit'),
        ];
    }
}
