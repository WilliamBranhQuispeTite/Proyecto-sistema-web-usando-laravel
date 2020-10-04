<?php

namespace App\Http\Controllers;
use App\Administrador;
use App\Categoria;
use App\Empresa;
use App\Producto;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
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
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();

        $pro = Producto::select('productos.*')
            ->join('categorias', 'categorias.cat_id', '=', 'productos.cat_id')
            ->join('empresas','categorias.emp_id','=','empresas.emp_id')
            ->where('empresas.emp_id', $emp->emp_id)
            ->get();


        return $pro;
    }

    public function store(Request $request){

        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();
        $emp = Empresa::select('empresas.*')
            ->join('administradors', 'administradors.emp_id', '=', 'empresas.emp_id')
            ->where('administradors.usu_id', $adm->usu_id)
            ->get()
            ->first();


        if($request->file('imagen')){
 
            $imagenRuta = $emp->emp_id;
            $path = Storage::disk('public')->put('DocEmp/'.$imagenRuta.'/imagenes',$request->file('imagen'));      
            return Producto::create([
                'pro_nombre' => $request['nombre'],
                'pro_descripcion' => $request['descripcion'],
                'pro_stock' => $request['stock'],
                'pro_precio'=> $request['precio'],
                'pro_promo'=> $request['promo'],
                'pro_imagen'=> asset($path),
                'cat_id' => $request['categoria'],
            
            ]);
    
        }

    }
    public function crearPro(Request $request)
    {
        return Producto::create([
            'pro_nombre' => $request['nombre'],
            'pro_descipcion' => $request['descripcion'],
            'pro_stock' => $request['stock'],
            'cat_id' => $request['categoria'],
            'emp_id' => $request['empresa'],
        ]);
    }

    public function obtenerPro(){
        $user = Auth::user();
        $adm = Administrador::where('usu_id', $user->id)->get()->first();

        $emp = Empresa::select('empresas.emp_id')
                ->join('administradors','administradors.emp_id', '=', 'empresas.emp_id')
                ->where('administradors.usu_id',$adm->usu_id)
                ->get()
                ->first();
        $productos = Producto::select('productos.*')
                ->where('emp_id',$emp->emp_id)
                ->get();
        
        return $productos;
    }
}
