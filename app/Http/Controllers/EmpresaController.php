<?php

namespace App\Http\Controllers;
use App\{Empresa,Administrador};
use Illuminate\Support\Facades\Auth;
//use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
 

    public function index(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
                ->join('administradors','administradors.emp_id', '=', 'empresas.emp_id')
                ->where('administradors.usu_id',$adm->usu_id)
                ->get()
                ->first();

        return $emp;
    }


    public function CrearEmp(EmpresaRequest $request)
    {
        //return $request['emp_razonSocial'];
        $request->crearEmp();
        return redirect()->route('login');
    }
    public function miEmpresa(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();

        return $emp;
    }
    
}
