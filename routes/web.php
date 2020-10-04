<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//INICIO SIN SESSION
Route::get('/', function () {
    return view('welcome');
});

Route::get('/registro',function(){
    return view('/registro');
})->name('registro');
Route::post('/registraremp','EmpresaController@crearemp')->name('registraremp');

//EN EL DASHBOAR
Route::resource('/categoria','CategoriaController',[
    'except' => ['edit', 'show',]
]);
Route::resource('/empresa','EmpresaController',[
    'except' => ['edit', 'show',]
]);
Route::resource('/producto','ProductoController',[
    'except' => ['edit', 'show',]
]);
Route::resource('/rol','RolController',[
    'except' => ['edit', 'show','store','update','destroy','create']
]);
Route::resource('/usuario','UsuarioController',[
    'except' => ['edit', 'show']
]);
Route::resource('/repartidor','RepartidorController',[
    'except' => ['edit', 'show']
]);
Route::resource('/cliente','ClienteController',[
    'except' => ['edit', 'show']
]);
Route::resource('/pedido','PedidoController',[
    'except' => ['edit', 'show']
]);


//Route::post('/registarPro','ProductoController@crearPro')->name('registarPro');

/*Route::resource('/home', 'CategoriaController', [
    'except' => ['edit', 'show', 'store']
  ]);
*/
//Route::get('registro','EmpresaController@registro')->name('registro');

//Route::get('obtenerPro','ProductoController@obtenerPro')->name('obtenerPro');


Auth::routes();

Route::prefix('home')->name('home.')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('articulos', 'HomeController@viewArticulos')->name('articulos');
    Route::get('usuarios', 'HomeController@viewUsuarios')->name('usuarios');
    Route::get('delivery', 'HomeController@viewDelivery')->name('usuarios');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
