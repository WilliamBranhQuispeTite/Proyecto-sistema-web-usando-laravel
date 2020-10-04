<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'emp_nombre', 'emp_correo', 'emp_ruc', 'emp_celular'
    ];
}
