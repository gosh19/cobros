<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
  protected $fillable = [
    'id','numero_operacion','tipo','cant_cuotas','monto','cuenta',
    'fecha'
  ];
}
