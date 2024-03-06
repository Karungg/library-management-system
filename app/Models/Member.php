<?php

namespace App\Models;

use App\Enums\GenderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'age', 'gender', 'email', 'phone', 'address'
    ];

    protected $casts = [
        'gender' => GenderEnum::class
    ];

    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }
}
