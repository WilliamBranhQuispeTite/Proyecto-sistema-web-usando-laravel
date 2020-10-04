<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'ped_entrada', 'ped_direccion', 'ped_referencia', 'cli_id','adm_id'
    ];
    protected $primaryKey  = 'ped_id';

}
