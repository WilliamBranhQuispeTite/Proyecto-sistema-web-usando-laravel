<?php

namespace App\Http\Controllers;
use App\Administrador;
use App\Categoria;
use App\Empresa;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();

        $emp = Empresa::select('empresas.emp_nombre', 'empresas.emp_ruc')
                ->join('administradors','administradors.emp_id', '=', 'empresas.emp_id')
                ->where('administradors.usu_id',$adm->usu_id)
                ->get()
                ->first();
        return view('home', compact('user','adm','emp'));
    }
    
    public function viewArticulos(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();

        $cat = Categoria::select('categorias.*')->get();
        
        return view('home.articulos', compact('user', 'adm', 'emp', 'cat'));
    }
    public function viewUsuarios(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();
        return view('home.usuarios', compact('user', 'adm', 'emp'));
    }
    public function viewDelivery(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();
        return view('home.delivery', compact('user', 'adm', 'emp'));
    }
}
