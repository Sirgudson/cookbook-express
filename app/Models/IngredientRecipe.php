<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientRecipe extends Model
{
    use Timestamp;

    protected $fillable = [
        "recipe_id",
        "ingredient_id",
        "measure_id",
        "quantity",
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function measure()
    {
        return $this->belongsTo(Measure::class);
    }
}
