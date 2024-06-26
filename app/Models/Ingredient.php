<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function ingredientRecipes()
    {
        return $this->hasMany(IngredientRecipe::class);
    }
}
