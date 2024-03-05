<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum GenderEnum: string implements HasLabel
{
    case MALE = "Male";
    case Female = "Female";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::Female => 'Female',
        };
    }
}
