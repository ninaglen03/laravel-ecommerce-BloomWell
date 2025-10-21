<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Authorization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'provider',
        'last_used_at',
        'scopes',
    ];

    protected function casts(): array
    {
        return [
            'last_used_at' => 'datetime',
            'scopes' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
