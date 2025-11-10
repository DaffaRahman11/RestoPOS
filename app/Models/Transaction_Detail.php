<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction_Detail extends BaseModel
{
    /** @use HasFactory<\Database\Factories\TransactionDetailFactory> */
    use HasFactory;

    protected $table = 'transaction_details';
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
