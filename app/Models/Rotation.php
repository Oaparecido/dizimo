<?php

namespace App\Models;

use Database\Factories\RotationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Agent|null $agent
 * @property-read Community|null $community
 */
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

    /** @return BelongsTo<Agent, $this> */
    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    /** @return BelongsTo<Community, $this> */
    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
}
