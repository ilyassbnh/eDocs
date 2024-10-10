<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        return response()->json(Categorie::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categorie::create($validated);
        return response()->json($category, 201);
    }

    public function show(Categorie $category)
    {
        return response()->json($category);
    }

    public function update(Request $request, Categorie $category)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    public function destroy(Categorie $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }
}
