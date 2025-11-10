<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock_Mutation extends BaseModel
{
    /** @use HasFactory<\Database\Factories\StockMutationFactory> */
    use HasFactory;
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }


}
