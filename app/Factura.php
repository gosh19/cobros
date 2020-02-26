<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
  protected $fillable = [
    'id','numero_factura','provincia'
  ];
}
