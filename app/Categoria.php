<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'cat_nombre', 'cat_descripcion', 'emp_id'
    ];

    protected $primaryKey  = 'cat_id';
}
