<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsResource extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Users Total", User::count()),
            Stat::make("Admins Total", User::where("role", 1)->count()),
            Stat::make("Editors Total", User::where("role", 2)->count()),
        ];
    }
}
