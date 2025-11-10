<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    public function transaction_detail()
    {
        return $this->hasMany(Transaction_Detail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $date = now()->format('dmY');

            $lastCode = static::whereDate('created_at', now())
                ->orderBy('transaction_code', 'desc')
                ->value('transaction_code');

            if ($lastCode) {
                $lastNumber = intval(substr($lastCode, -4));
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '0001';
            }

            $model->transaction_code = 'TK' . $date . $newNumber;
        });
    }
}
