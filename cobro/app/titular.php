<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class titular extends Model
{
  protected $fillable = [
    'id','nombre','dni'
  ];
}
