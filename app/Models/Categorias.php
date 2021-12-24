<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $table = "categorias";

    protected $fillable = ['cat_id','cat_nombre', 'cat_delete','cat_active'];

    public $timestamps = false;

}
