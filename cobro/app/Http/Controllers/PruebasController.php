<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estado;
use Carbon\Carbon;

class PruebasController extends Controller
{
    public function fechas()
    {
      $estados = Estado::all();
      foreach ($estados as $estado) {
        if ($estado->fecha_siguiente_cobro != "completado") {
          $carbon = Carbon::createFromFormat('d-m-Y', $estado->fecha_siguiente_cobro);
          $carbon->format('Y-m-d');
          $estado->fecha = $carbon;
          $estado->save();
        }
      }
    }

}
