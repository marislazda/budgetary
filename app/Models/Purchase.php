<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'product',
        'type_id',
        'price',
        'created_at'
    ];

}
