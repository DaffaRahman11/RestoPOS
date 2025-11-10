<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BaseModel extends Model
{
    use SoftDeletes;
    use HasUuids;
    protected $guarded = ['id'];
}
