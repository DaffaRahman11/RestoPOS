<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;
    protected $keyType = 'string';
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
