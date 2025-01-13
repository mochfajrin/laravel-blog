<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\CommentsRelationManager;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Main Content")->schema([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->required()
                        ->minLength(3)
                        ->maxLength(100)
                        ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                            if ($operation === 'create') {
                                $set("slug", Str::slug($state));
                            }
                        }),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true)->minLength(3)->maxLength(100),
                    RichEditor::make('body')->required()->fileAttachmentsDirectory("posts/images")->columnSpanFull()
                ])->columns(2),
                Section::make("Meta")->schema([
                    FileUpload::make("image")->image()->directory("posts/thumbnails"),
                    DateTimePicker::make("published_at")->nullable(),
                    Checkbox::make("featured"),
                    Select::make("user_id")->relationship("author", "name")
                        ->searchable()
                        ->required(),
                    Select::make("categories")->relationship("categories", "title")
                        ->multiple()
                        ->searchable()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("image"),
                TextColumn::make("title")->sortable()->searchable(),
                TextColumn::make("slug")->sortable()->searchable(),
                TextColumn::make("author.name")->sortable()->searchable(),
                TextColumn::make("published_at")->date("Y-m-d")->sortable()->searchable(),
                CheckboxColumn::make("featured")->sortable()->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->after(function () {
                        Cache::flush();
                    }),
                    Tables\Actions\ForceDeleteBulkAction::make()->after(function () {
                        Cache::flush();
                    }),
                    Tables\Actions\RestoreBulkAction::make()->after(function () {
                        Cache::flush();
                    }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CommentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
