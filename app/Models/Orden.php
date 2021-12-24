<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;
    protected $table = "orden";
    protected $fillable = [
        'ord_id',
        'ord_mesa',
        'ord_valor',
        'ord_estado',
        'ord_fecha'
    ];
    public $timestamps = false;
}
