<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'prod_id',
        'prod_name',
        'prod_price',
        'prod_categoria',
        'prod_description',
        'prod_visible',
        'prod_delete',
        'prod_image'
      ];

      public $timestamps = false;
}
