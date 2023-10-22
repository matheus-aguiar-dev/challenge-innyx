<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

	public function show($id)
	{
		$product = Produto::find($id);

		if (!$product) {
			return response()->json(['error' => 'Product not found'], 404);
		}
		return response()->json(['data' => $product], 200);
	}

	public function show_all()
	{
		$products = Produto::paginate(5); // Paginate the products with 5 items per page

		return response()->json(['data' => $products], 200);
	}
	public function destroy($id)
	{
		// Find the product by ID
		$produto = Produto::find($id);

		// If the product does not exist, return an error response
		if (!$produto) {
			return response()->json(['error' => 'Product not found'], 404);
		}

		// Delete the product
		$produto->delete();

		// Return a success response
		return response()->json(['message' => 'Product deleted successfully'], 200);
	}

	public function update(Request $request, $id)
	{
		// Validate the incoming data
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|max:50',
			'descricao' => 'nullable|string|max:200',
			'preco' => 'required|numeric|gt:0',
			'data_validade' => 'required|date|after_or_equal:today',
			'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
			'categoria_id' => 'required|exists:categorias,id',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		// Find the product by ID
		$produto = Produto::find($id);

		// If the product does not exist, return an error response
		if (!$produto) {
			return response()->json(['error' => 'Product not found'], 404);
		}

		// Update product attributes with the new data
		$produto->nome = $request->nome;
		$produto->descricao = $request->descricao;
		$produto->preco = $request->preco;
		$produto->data_validade = $request->data_validade;
		$produto->categoria_id = $request->categoria_id;

		// Handle image update if provided in the request
		if ($request->hasFile('imagem')) {
			// Upload the new image and update the product's image attribute
			$imageName = time() . '.' . $request->imagem->extension();
			$request->imagem->move(public_path('images'), $imageName);
			$produto->imagem = $imageName;
		}

		// Save the updated product
		$produto->save();

		// Return a success response with the updated product data
		return response()->json(['message' => 'Product updated successfully', 'data' => $produto], 200);
	}


	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|max:50',
			'descricao' => 'nullable|string|max:200',
			'preco' => 'required|numeric|gt:0',
			'data_validade' => 'required|date|after_or_equal:today',
			'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
			'categoria_id' => 'required|exists:categorias,id',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}


		$imageName = time() . '.' . $request->imagem->extension();
		$request->imagem->move(public_path('images'), $imageName);

		$product = Produto::create([
			'nome' => $request->nome,
			'descricao' => $request->descricao,
			'preco' => $request->preco,
			'data_validade' => $request->data_validade,
			'imagem' => $imageName,
			'categoria_id' => $request->categoria_id,
		]);

		return response()->json(['message' => 'Product created successfully', 'data' => $product], 201);
	}
}
