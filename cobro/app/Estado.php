<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
  protected $fillable = [
    'id','tipo','valor_cuota','cant_cuotas','cuotas_pagas','valor_restante',
    'fecha_siguiente_cobro','anexos'
  ];
}
