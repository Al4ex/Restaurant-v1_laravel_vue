<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;
    protected $fillable = [
        'ped_id',
        'ped_order',
        'ped_product',
        'ped_cantidad',
        'ped_valor'
    ];

    public $timestamps = false;
}
