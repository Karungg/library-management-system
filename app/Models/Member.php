<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'age', 'gender', 'email', 'phone', 'address'
    ];

    public function book_issues(): HasMany
    {
        return $this->hasMany(BookIssue::class);
    }
}
