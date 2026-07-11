<?php

namespace App\Models;

use Database\Factories\CommunityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'address'])]
class Community extends Model
{
    /** @use HasFactory<CommunityFactory> */
    use HasFactory;

    public function rotations(): HasMany
    {
        return $this->hasMany(Rotation::class);
    }
}
