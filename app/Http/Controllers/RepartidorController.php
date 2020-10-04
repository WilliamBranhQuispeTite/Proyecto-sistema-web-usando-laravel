<?php

namespace App\Http\Controllers;


use App\Empresa;
use App\Http\Requests\RepartidorRequest;
use App\Repartidor;
use Illuminate\Support\Facades\Auth;

class RepartidorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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

        $usu = Repartidor::select('repartidors.*','usuarios.email')
            ->join('usuarios','usuarios.id','=','repartidors.usu_id')
            ->join('empresas','empresas.emp_id','=','repartidors.emp_id')
            ->where('empresas.emp_id',$emp->emp_id)
            ->get();
        
        return $usu;
    }

    public function store(RepartidorRequest $request)
    { 
        //return $request['emp_razonSocial'];
        $request->crearRep();
        return 'Agregado con exito';
          
    }
}
