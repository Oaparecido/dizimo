<?php

namespace App\Services;

use App\Models\Tither;

class TitherService
{
    /** @param array<string, mixed> $data */
    public function create(array $data): Tither
    {
        return Tither::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'partner_name' => $data['partner_name'] ?? null,
        ]);
    }
}
