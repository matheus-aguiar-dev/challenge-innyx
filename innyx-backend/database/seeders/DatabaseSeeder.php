<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Produto;

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
	 Categoria::create(['nome' => 'Cachorro']);
	 Categoria::create(['nome' => 'Gato']);
        Produto::create([
            'nome' => 'Lily',
            'descricao' => 'Meu primeiro animal de estimação, extremamente ranzinza.',
            'preco' => 99.99,
            'data_validade' => '2033-12-31', // Format: YYYY-MM-DD
            'imagem' => 'Lily.jpg',
            'categoria_id' => 2, // Replace with the ID of the corresponding category
        ]);
        Produto::create([
            'nome' => 'Salem',
            'descricao' => 'Um gato extremamente falante, porém muito carinhoso.',
            'preco' => 100.99,
            'data_validade' => '2031-12-31', // Format: YYYY-MM-DD
            'imagem' => 'Salem.jpg',
            'categoria_id' => 2, // Replace with the ID of the corresponding category
        ]);
        Produto::create([
            'nome' => 'Doce',
		'descricao' => 'Ela é Blogeira, segue ela lá @aumor_doce no instagram',
            'preco' => 29.99,
            'data_validade' => '2034-12-31', // Format: YYYY-MM-DD
            'imagem' => 'Doce.jpg',
            'categoria_id' => 1, // Replace with the ID of the corresponding category
        ]);
        Produto::create([
            'nome' => 'Fazuelly',
            'descricao' => 'Não julgue a coitada pelo nome.',
            'preco' => 99.99,
            'data_validade' => '2035-12-31', // Format: YYYY-MM-DD
            'imagem' => 'Fazuelly.jpg',
            'categoria_id' => 2, // Replace with the ID of the corresponding category
        ]);
        Produto::create([
            'nome' => 'Thomas',
            'descricao' => 'Esse gato só faz besteira, porém gosto muito dele',
            'preco' => 99.99,
            'data_validade' => '2036-12-31', // Format: YYYY-MM-DD
            'imagem' => 'Thomas.jpg',
            'categoria_id' => 1, // Replace with the ID of the corresponding category
        ]);
    }
}
