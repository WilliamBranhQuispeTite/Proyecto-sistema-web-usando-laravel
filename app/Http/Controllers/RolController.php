<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function  index()
    {
        $rol = Rol::take(2)->get();
        return $rol;
    }
}
