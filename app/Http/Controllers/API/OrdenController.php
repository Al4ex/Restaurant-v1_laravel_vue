<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Orden;
use App\Models\Pedidos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    //
    public function create_order(Request $request){

        // obetner un array de pedidos
        $pedido = $request->input("pedidos");

        $orderdata['ord_estado'] = 1;
        $orderdata['ord_mesa']   = $request->input("mesa");
        $orderdata['ord_valor'] = $request->input("total");
        // guarda el pedido
        $order = Orden::create($orderdata);

        foreach (json_decode($pedido) as $item){

          $itemped['ped_product'] = $item->id;
          $itemped['ped_order']   = $order->id;
          $itemped['ped_cantidad'] = $item->cant;
          $itemped['ped_valor'] = $item->precio;

          Pedidos::create($itemped);

        }

        $response['success'] = true;
        $response['message'] = "Guardo exitosamente";
    }

    public function list_order(){

        // fecha hoy / today date
        $fecha_hoy = Carbon::now()->format('Y-m-d') ;

        // get order per today
        $order = Orden::whereDate("ord_fecha",$fecha_hoy)->get();

        foreach ($order as $value) {
          // add value show
          $value['show'] = false;
          // add day details for order
          $value['pedidos'] = Pedidos::join('productos', 'productos.prod_id', '=', 'pedidos.ped_product')
          ->where("ped_order",$value->ord_id)->get();
        }
        return $order;
    }
}
