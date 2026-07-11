<?php

namespace App\Models;

use Database\Factories\TitherFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read HasMany<Payment, $this> $payments
 */
#[Fillable(['name', 'email', 'phone', 'address', 'birth_date', 'partner_name'])]
class Tither extends Model
{
    /** @use HasFactory<TitherFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    /** @return HasMany<Payment, $this> */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
