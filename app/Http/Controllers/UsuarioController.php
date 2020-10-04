<?php

namespace App\Http\Controllers;

use App\Administrador;
use App\Empresa;
use App\Http\Requests\UsuarioRequest;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function  index()
    {
        
        $user = Auth::user();
        //$hla = response()->json($user);
        $id =  $user->id;
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->join('usuarios','usuarios.id','=','administradors.usu_id')
            ->where('usuarios.id', $user->id)
            ->get()
            ->first();

        $usu =Administrador::select('administradors.*','usuarios.email','usuarios.rol_id')
            ->join('usuarios','usuarios.id','=','administradors.usu_id')
            ->join('empresas','empresas.emp_id','=','administradors.emp_id')
            ->where('empresas.emp_id',$emp->emp_id)
            ->get();

        return $usu;
    }


    public function store(UsuarioRequest $request)
    { 
        //return $request['emp_razonSocial'];
        $request->crearUsu();
        return 'Agregado con exito';
          
    }

    public function update(Request $request, $id)
    {
        $adm = Administrador::find($id);
        $adm->adm_nombre = $request->nombre;
        $adm->adm_dni = $request->dni;
        $adm->adm_celular = $request->numero;
        $adm->save();

        $usu = Usuario::find($request->password);
        $usu->rol_id =  $request->rol;
        $usu->save();

        return ['Actualizao', 'Se actualiso los datos!'];
    }
    public function destroy($id)
    {
        $adm = Administrador::find($id);
        $usu = Usuario::select('usuarios.*')
            ->join('administradors', 'administradors.usu_id', '=','usuarios.id')
            ->where('administradors.adm_id',$adm->adm_id)
            ->get()
            ->first();
        $adm->delete();
        $usu->delete();
        return 'Se elimino con exito';
    }
}
