<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dato extends Model
{
  protected $fillable = [
    'id','nombre','dni','mail', 'telefono','tarjeta','tipo_tarjeta','fechaingreso'
  ];

}
