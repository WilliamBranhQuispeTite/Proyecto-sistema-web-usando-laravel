<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    protected $fillable = [
        'rep_nombre',
        'rep_dni',
        'rep_celular',
        'emp_id',
        'usu_id',
    ];

    protected $primaryKey  = 'rep_id';
}
