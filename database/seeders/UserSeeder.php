<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Anderson Siqueira',
            'email' => 'contato@andersonls.com.br',
            'password' => Hash::make('!@12QWqw'),
            'email_verified_at' => now(),
        ]);
    }
}