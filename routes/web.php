<?php

use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\OrdenController;
use App\Http\Controllers\API\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/producto', function () {
    return view('producto');
});





Route::get('/categoria', function () {
    return view('categoria');
});
Route::get('/orden', function () {
    return view('orden');
});
// Categorias
Route::group(['prefix'=>'api/'],function(){
    Route::post('Producto/create',[ProductoController::class, 'create']);
    Route::get('Producto/list',[ProductoController::class,'list']);
    Route::post('Producto/change-status',[ProductoController::class,'change_status']);
    Route::get('Producto/visible',[ProductoController::class,'visible']);

    Route::post('Categoria/add', [CategoriaController::class , 'add']);
    Route::get('Categoria/list', [CategoriaController::class, 'list']);
    Route::get('Categoria/disponible',[CategoriaController::class,'avalaible']);
    Route::post('Categoria/change-status',[CategoriaController::class, 'change_status']);

    Route::post('Orden/create', [OrdenController::class, 'create_order']);
    Route::get('Orden/list', [OrdenController::class, 'list_order']);
  });
