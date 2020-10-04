<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function  index()
    {
        $user = Auth::user();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->join('usuarios','usuarios.id','=','administradors.usu_id')
            ->where('usuarios.id', $user->id)
            ->get()
            ->first();

        $cli = Cliente::where('emp_id',$emp->emp_id)->orderBy('cli_id', 'desc')->get();

        return $cli;
    }


    public function store(Request $request)
    {
        return Cliente::create([
            'cli_nombre' => $request['nombre'],
            'cli_celular' => $request['numero'],
            'emp_id' => $request['empresa'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $cat = Cliente::find($id);
        $cat->cat_nombre = $request->nombre;
        $cat->cat_descripcion = $request->descripcion;
        $cat->save();
        return ['mensaje', 'Categoria editada!'];
    }
    public function destroy($id)
    {
        $cat = Cliente::find($id);
        $cat->delete();
        return 'Seguro que quiers eliminar';
    }
}
