<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'return_date', 'status', 'return_day', 'fine'
    ];

    protected $casts = [
        'status' => StatusEnum::class
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
