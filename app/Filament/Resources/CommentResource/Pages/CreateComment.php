<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateComment extends CreateRecord
{
    protected static string $resource = CommentResource::class;
    protected function afterCreate()
    {
        Cache::flush();
    }
}
