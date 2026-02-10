<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    protected $fillable = [
        'type', 'subject', 'description',
        'activityable_type', 'activityable_id', 'user_id', 'happened_at',
    ];

    protected function casts(): array
    {
        return ['happened_at' => 'datetime'];
    }

    public function activityable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
