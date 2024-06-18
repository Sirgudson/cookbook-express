<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Photo;
use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Measure;
use App\Models\IngredientRecipe;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('recipe.index', ['recipes' => Recipe::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $measures = Measure::all();

        return view ('recipe.create', compact('ingredients', 'categories', 'measures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'ingredient_ids' => 'required|array',
            'ingredient_ids.*' => 'required|integer',
            'employee_id' => 'required|integer',
            'portions' => 'required',
            'category_id' => 'required|integer',
        ]);

        $alreadyExists = Recipe::where('name', $request->name)->where('employee_id', $request->employee_id)->first();
        if ($alreadyExists) {
            return redirect()->route('recipe.create')->with('error','Você já publicou uma receita com o mesmo nome!');
        }

        $recipe = Recipe::create([
            'name'=> $request->name,
            'employee_id' => $request->employee_id,
            'portions' => $request->portions,
            'category_id' => $request->category_id,
        ]);

        $imageName = $request->name.'_'.time().'.'.$request->image->extension();
        $request->image->storeAs('recipe_images', $imageName, 'public');
        Photo::create([
            'name' => $imageName,
            'recipe_id' => $recipe->id
        ]);

        foreach ($request->ingredient_ids as $index => $ingredientId) {
            $ingredientRecipe = new IngredientRecipe();
            $ingredientRecipe->recipe_id = $recipe->id;
            $ingredientRecipe->ingredient_id = $ingredientId;
            $ingredientRecipe->measure_id = $request->measure_ids[$index];
            $ingredientRecipe->quantity = $request->quantities[$index];
            $ingredientRecipe->save();
        }

        return redirect()->route('recipe.index')->with('success','Receita cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('recipe.show', ['recipe' => Recipe::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $ingredients = Ingredient::all();
        $categories = Category::all();
        $measures = Measure::all();

        if(isset($recipe->published_at)) {
            return redirect()->route('recipe.index')->with('error','Receita já publicada, não é possível editar!');

        } else {
            return view('recipe.edit', compact('recipe', 'ingredients', 'categories', 'measures'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
            'ingredient_ids' => 'required|array',
            'ingredient_ids.*' => 'required|integer',
            'portions' => 'required',
            'category_id' => 'required|integer',
        ]);

        $recipe = Recipe::find($request->recipe_id);
        $recipe->name = $request->name;
        $recipe->portions = $request->portions;
        $recipe->category_id = $request->category_id;
        $recipe->save();

        if ($request->image) {

            if ($recipe->photos) {
                foreach($recipe->photos as $photo) {
                    $photo->delete();
                }
            }

            $imageName = $request->name.'_'.time().'.'.$request->image->extension();
            $request->image->storeAs('recipe_images', $imageName, 'public');
            Photo::create([
                'name' => $imageName,
                'recipe_id' => $recipe->id
            ]);
        }

        foreach($recipe->ingredientRecipes as $ingredientRecipe) {
            $ingredientRecipe->delete();
        }

        foreach ($request->ingredient_ids as $index => $ingredientId) {
            $ingredientRecipe = new IngredientRecipe();
            $ingredientRecipe->recipe_id = $recipe->id;
            $ingredientRecipe->ingredient_id = $ingredientId;
            $ingredientRecipe->measure_id = $request->measure_ids[$index];
            $ingredientRecipe->quantity = $request->quantities[$index];
            $ingredientRecipe->save();
        }

        return redirect()->route('recipe.index')->with('success','Receita atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if($recipe->employee_id != auth()->user()->id) {
            return redirect()->route('recipe.index')->with('error','Você não tem permissão para deletar essa receita!');
        }

        if($recipe->published_at) {
            return redirect()->route('recipe.index')->with('error','Receita já publicada, não é possível deletar!');
        }

        foreach($recipe->ingredientRecipes as $ingredientRecipe) {
            $ingredientRecipe->delete();
        }

        if($recipe->photos) {
            foreach($recipe->photos as $photo) {
                $photo->delete();
            }
        }

        $recipe->delete();
        return redirect()->route('recipe.index')->with('success','Receita deletada com sucesso!');
    }
}
