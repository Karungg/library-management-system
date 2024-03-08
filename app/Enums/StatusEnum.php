<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel, HasIcon, HasColor
{
    case Borrowed = "Borrowed";
    case Returned = "Returned";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Borrowed => "Borrowed",
            self::Returned => "Returned"
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Borrowed => "heroicon-m-no-symbol",
            self::Returned => "heroicon-m-check-circle"
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Borrowed => "danger",
            self::Returned => "success"
        };
    }
}
