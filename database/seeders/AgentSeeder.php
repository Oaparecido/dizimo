<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        Agent::firstOrCreate([
            'email' => 'admin@dizimo.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
    }
}
