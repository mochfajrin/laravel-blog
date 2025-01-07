<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRoles: int implements HasLabel
{
    case ADMIN = 1;
    case EDITOR = 2;
    case MEMBER = 3;
    public function getLabel(): ?string
    {
        return $this->name;
    }
}
