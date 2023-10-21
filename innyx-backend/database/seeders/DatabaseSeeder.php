<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
	 \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@innyx.com.br',
            'password' => Hash::make('admin'),
        ]);

        \App\Models\Categoria::factory(10)->create();
        \App\Models\Produto::factory(30)->create();

    }
}
