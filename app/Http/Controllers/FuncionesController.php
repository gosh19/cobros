<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacto;

class FuncionesController extends Controller
{
    public function cargarComentario(Request $request, $id)
    {
      Contacto::create([
        'id' => $id,
        'comentario' => $request['comentario']
      ]);

      if ($request['boton']=="Cargar") {
        return redirect('/cobro_id/'.$id);
      }
      return redirect()->route('alumnoid',['id' => $id]);
    }
}
