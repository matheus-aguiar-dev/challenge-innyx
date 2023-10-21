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
	//
}
