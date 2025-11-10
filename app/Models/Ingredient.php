<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends BaseModel
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }

    public function stock_mutation()
    {
        return $this->hasMany(Stock_Mutation::class);
    }
}
