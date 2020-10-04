<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'pro_nombre', 'pro_descripcion', 'pro_stock','cat_id','pro_precio','pro_promo','pro_imagen',
    ];
}
