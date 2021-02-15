<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesInvoice extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'name',
        'uploaded_at',
    ];

}
