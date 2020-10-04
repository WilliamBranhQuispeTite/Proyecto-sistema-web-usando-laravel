<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Pedido;
use App\Repartidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function  index()
    {
        $user = Auth::user();
        $pedidos = Pedido::select(
            'pedidos.*',
            'productos.pro_nombre',
            'detalles.det_cantidad',
            'detalles.det_total',
            'clientes.cli_nombre'
        )
            ->join('clientes', 'pedidos.cli_id', '=', 'clientes.cli_id')
            ->join('empresas', 'clientes.emp_id', '=', 'empresas.emp_id')
            ->join('administradors', 'empresas.emp_id', '=', 'administradors.emp_id')
            ->join('usuarios', 'administradors.usu_id', '=', 'usuarios.id')
            ->join('detalles', 'pedidos.ped_id', '=', 'detalles.ped_id')
            ->join('productos', 'detalles.pro_id', '=', 'productos.pro_id')
            ->where('usuarios.id', $user->id)
            ->get();

        return $pedidos;
    }


    public function store(PedidoRequest $request)
    {
        $request->crearPed();
        return 'Agregado con exito';
    }

    public function update(Request $request, $id)
    {
        $ped = Pedido::find($id);
        $ped->rep_id = $request->repartidor;
        $ped->ped_estado = 'En Camino';
        $ped->save();

        $rep = Repartidor::find($request->repartidor);
        $rep->rep_dispo = 'Ocupado';
        $rep->save();
        return ['mensaje', 'Categoria editada!'];
    }
    public function destroy($id)
    {
        /* $cat = Categoria::find($id);
        $cat->delete();
        return 'Seguro que quiers eliminar'; */
    }
}
