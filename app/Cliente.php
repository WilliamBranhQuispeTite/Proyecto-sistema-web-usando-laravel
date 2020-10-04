<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'cli_nombre', 'cli_celular', 'emp_id', 'usu_id',
    ];
}
