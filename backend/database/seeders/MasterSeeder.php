<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'master',
            'email' => 'master@example.com',
        ]);
    }
}
