<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Validator;

class CategoriaController extends Controller
{
	// Get all categories
	public function index()
	{
		$categories = Categoria::orderByDesc('id')->get();
		return response()->json(['data' => $categories], 200);
	}

	// Get a specific category by ID
	public function show($id)
	{
		$category = Categoria::find($id);

		if (!$category) {
			return response()->json(['error' => 'Category not found'], 404);
		}

		return response()->json(['data' => $category], 200);
	}

	// Create a new category
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|max:50|unique:categorias',
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$category = new Categoria();
		$category->nome = $request->input('nome');
		$category->save();

		return response()->json(['message' => 'Category created successfully', 'data' => $category], 201);
	}

	// Update an existing category
	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'nome' => 'required|string|max:50|unique:categorias,nome,' . $id,
		]);

		if ($validator->fails()) {
			return response()->json(['error' => $validator->errors()], 400);
		}

		$category = Categoria::find($id);

		if (!$category) {
			return response()->json(['error' => 'Category not found'], 404);
		}

		$category->nome = $request->input('nome');
		$category->save();

		return response()->json(['message' => 'Category updated successfully', 'data' => $category], 200);
	}

	// Delete a category by ID
	public function destroy($id)
	{
		$category = Categoria::find($id);

		if (!$category) {
			return response()->json(['error' => 'Category not found'], 404);
		}

		$category->delete();

		return response()->json(['message' => 'Category deleted successfully'], 200);
	}
}

