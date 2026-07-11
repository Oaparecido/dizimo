<?php

namespace App\Services;

use App\Models\Tither;

class TitherService
{
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
