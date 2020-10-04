<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    //
    protected $fillable = [
        'det_precio', 'det_total', 'det_cantidad', 'pro_id','ped_id'
    ];
}
