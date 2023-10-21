<?php

namespace Database\Factories;
use App\Models\Produto;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Import the HasFactory trait
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
	use HasFactory; // Make sure this trait is added to the model
	protected $model = Produto::class;

	public function definition()
	{
		$imageName = 'product_' . Str::random(10) . '.jpg'; // Generate a random image name
		return [
			'nome' => $this->faker->word,
			'descricao' => $this->faker->sentence,
			'preco' => $this->faker->randomFloat(2, 1, 1000),
			'data_validade' => $this->faker->date,
			'imagem' => $imageName,
			'categoria_id' => $this->faker->numberBetween(1, 10), // Assuming you have 10 categories
		];
	}

}
