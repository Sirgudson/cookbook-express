<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ingredient.index', [
            'ingredients' => Ingredient::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description'=> 'nullable|string|max:255'
        ]);

        $ingredients = Ingredient::all();
        foreach($ingredients as $ingredient) {
            if($ingredient->name == $request->name) {
                return redirect()->route('ingredient.index')->with('error', 'O ingrediente "'.$request->name.'" já foi cadastrado!');
            }
        }

        Ingredient::create($data);

        return redirect()->route('ingredient.index')->with('success', 'Ingrediente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $ingredient = Ingredient::find($request->id);

        if($ingredient->recipes->count() > 0) {
            return redirect()->route('ingredient.index')->with('error', 'O ingrediente "'.$ingredient->name.'" não pode ser editado porque está sendo utilizado em uma receita!');
        }

        $ingredient->name = $request->name;
        $ingredient->description = $request->description;
        $ingredient->save();

        return redirect()->route('ingredient.index')->with('success', 'O ingrediente "'.$ingredient->name.'" foi editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $ingredient = Ingredient::find($request->id);

        if($ingredient->recipes->count() > 0) {
            return redirect()->route('ingredient.index')->with('error', 'O ingrediente "'.$ingredient->name.'" não pode ser deletado porque está sendo utilizado em uma receita!');
        }

        $ingredient->delete();

        return redirect()->route('ingredient.index')->with('success', 'O ingrediente "'.$ingredient->name.'" foi deletado com sucesso!');
    }
}
