<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends BaseModel
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;


    public function detail_transaction()
    {
        return $this->hasMany(Transaction_Detail::class);
    }

    public function recipe()
    {
        return $this->hasMany(Recipe::class);
    }
}
