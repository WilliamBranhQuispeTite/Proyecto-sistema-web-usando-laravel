<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Administrador;
use App\Empresa;
use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function  index()
    {
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();

        $cat = Categoria::where('emp_id',$emp->emp_id)->get();

        return $cat;
    }


    public function store(Request $request)
    {
        
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();

        return Categoria::create([
            'cat_nombre' => $request['nombre'],
            'cat_descripcion' => $request['descripcion'],
            'emp_id' => $emp->emp_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $cat = Categoria::find($id);
        $cat->cat_nombre = $request->nombre;
        $cat->cat_descripcion = $request->descripcion;
        $cat->save();
        return ['mensaje', 'Categoria editada!'];
    }
    public function destroy($id)
    {
        $cat = Categoria::find($id);
        $cat->delete();
        return 'Seguro que quiers eliminar';
    }
}
