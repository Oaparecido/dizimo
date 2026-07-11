<?php

namespace App\Models;

use Database\Factories\RotationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rotation extends Model
{
    /** @use HasFactory<RotationFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'week_occurrence' => 'integer',
            'day_of_week' => 'integer',
        ];
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
}
