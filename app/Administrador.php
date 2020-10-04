<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $fillable = [
        'adm_nombre',
        'adm_dni',
        'adm_celular',
        'emp_id',
        'usu_id',
    ];

    protected $primaryKey  = 'adm_id';
}
