<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel, HasDescription
{
    case ISSUED = "Issued";
    case RETURNED = "Returned";

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ISSUED => "Issued",
            self::RETURNED => "Returned"
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::ISSUED => 'This has not finished being issued yet.',
            self::RETURNED => 'This is ready for a member to issue.',
        };
    }
}
