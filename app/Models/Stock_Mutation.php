<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock_Mutation extends BaseModel
{
    /** @use HasFactory<\Database\Factories\StockMutationFactory> */
    use HasFactory;

    protected $table = 'stock_mutations';
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }


}
