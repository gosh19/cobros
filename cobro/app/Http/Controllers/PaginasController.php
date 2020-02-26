<?php

namespace App\Http\Controllers;
use App\Cobro;
use App\Dato;
use App\Estado;
use App\Cuota;
use App\titular;
use App\Cupo;
use Carbon\Carbon;
use App\Baja;
use App\Contacto;

use Illuminate\Http\Request;

class PaginasController extends Controller
{
  /**
   * CARGA LA VISTA CON LA FECHA DE HOY
   */
  public function cargaralumno(){
    $carbon= Carbon::now()->format('Y-m-d');
    return view('cargaralumno',['fecha' => $carbon]);
  }
  /**
   * RECIBE DATOSS DE DATO Y ESTADO Y LOS CARGA EN LA BD
   * Y CARGA LA VISTA DE CARGARCOBRO
   *  SOLO PARA ALUMNOS NUEVOS
   */
  public function cargarcobro(Request $request){


      $cuotas = $request['cant_cuotas'];
    

    if ($request['anexos']=="") {
      $request['anexos']=0;
    }
    if ($request['nombre-titular']=="") {
      $request['nombre-titular'] = $request['nombre'];
    }
    if ($request['dni-titular']=="") {
      $request['dni-titular'] = $request['dni'];
    }

    $datos = Dato::all();
    //RECORRE TODOS LOS DATOS Y CONTROLA Q EL ID NO ESTE REPETIDO
    if ($datos=="[]") { //SI ESTA VACIO LO CREA DE CERO
      Dato::create([
        'id' => $request['id'],
        'nombre' => $request['nombre'],
        'dni' => $request['dni'],
        'mail' => $request['mail'],
        'telefono' => "no cargado",
        'tarjeta' => $request['tarjeta'],
        'tipo_tarjeta' => $request['tipo'],
        'fechaingreso' => $request['fecha_siguiente_cobro']
      ]);
      Estado::create([
        'id' => $request['id'],
        'tipo' => $request['tipo'],
        'valor_cuota' => $request['valor_cuota'],
        'cant_cuotas' => $cuotas,
        'cuotas_pagas' => 0,
        'valor_restante' => $request['valor_cuota']*$cuotas,
        'fecha_siguiente_cobro' => $request['fecha_siguiente_cobro']
      ]);
      titular::create([
        'id' => $request['id'],
        'nombre' => $request['nombre-titular'],
        'dni' => $request['dni-titular']
      ]);
      return view('cargarcobro',['fecha' => $request['fecha_siguiente_cobro'],'cuota' => $request['valor_cuota']])->with('id', $request['id']);

    } else {            //SI NO CONTROLA LOS IDS

      foreach ($datos as $dato) {
        if ($dato['id']==$request['id']) {
          return redirect('/cargaralumno')->with('alert', 'existe');
        }
      }


      Dato::create([
        'id' => $request['id'],
        'nombre' => $request['nombre'],
        'dni' => $request['dni'],
        'mail' => $request['mail'],
        'telefono' => "no cargado",
        'tarjeta' => $request['tarjeta'],
        'tipo_tarjeta' => $request['tipo'],
        'fechaingreso' => $request['fecha_siguiente_cobro']
      ]);
      Estado::create([
        'id' => $request['id'],
        'tipo' => $request['tipo'],
        'valor_cuota' => $request['valor_cuota'],
        'cant_cuotas' => $cuotas,
        'cuotas_pagas' => 0,
        'valor_restante' => $request['valor_cuota']*$cuotas,
        'fecha_siguiente_cobro' => $request['fecha_siguiente_cobro']
      ]);
      titular::create([
        'id' => $request['id'],
        'nombre' => $request['nombre-titular'],
        'dni' => $request['dni-titular']
      ]);
      $dato = Dato::find($request['id']);
      $titular = titular::find($request['id']);
      return view('cargarcobro',['id' => $request['id'],
      'fecha' => $request['fecha_siguiente_cobro'],'cuota' => $request['valor_cuota'],
      'dato' => $dato, 'titular' => $titular]);
    }
  }
  /**
   * CARGA EL COBRO
   */
  public function cargar(Request $request,$id){
    $estado = Estado::find($id);

    $carbon = Carbon::createFromFormat('Y-m-d', $request['fecha']);

    $cant_cuotas = $request['cantidad'];


    if ($request['cantidad']!="oro") {
      for ($j=0; $j < $request['cantidad'] ; $j++) {
        $estado->cuotas_pagas++;
        $carbon->month++; //SUMA UN MES
      }
    }

    $estado->valor_restante= $estado->valor_restante - $request['monto'];

    if ($request['tipo'] == "total") {      //SI LLEGA A SER UN COBRO TOTAL YA DEJA PA Q NO SE COBRE MAS
      $estado->fecha_siguiente_cobro = "1000-01-01";
    }
    else if ($request['tipo'] == "parcial") {
      $estado->fecha_siguiente_cobro = $carbon->format('Y-m-d');
    }

    if ($estado->valor_restante <= 0) {   //CONTROL DE SI SE COBRO TODO O NO
      $estado->fecha_siguiente_cobro = "1000-01-01";
    }

    $estado->save();

    Cobro::create([
      'id' => $id,
      'numero_operacion' => $request['numero_operacion'],
      'tipo' => $request['tipo'],
      'cant_cuotas' => $cant_cuotas,
      'monto' => $request['monto'],
      'cuenta' => $request['cuenta'],
      'fecha' => $request['fecha']
    ]);

    return redirect('/exito');
  }
  /**
   * DESPLIEGA TABLA CON LOS COBROS DEL MES
   */
  public function cobrosmes(){
    $carbon = Carbon::now();
    $carbon = $carbon->format('m'); //FORMATEA AL MES ACTUAL
    $cupos = Cupo::all();
    $estados = Estado::where('fecha_siguiente_cobro','like','%-'.$carbon.'-%')
                              ->orderBy('fecha_siguiente_cobro')
                              ->get(); //TRAE TODOS LOS COBROS DEL MES
                              
    $cobrosmes = Estado::where('tipo','=','debito','OR','tipo','=','efectivo')
                              ->orderBy('fecha_siguiente_cobro')
                              ->get(); //TRAE TODOS LOS COBROS DEL MES
    $datos = Dato::all();
    return view('cobrosdia',['cupos' => $cupos, 'estados' => $estados, 'datos' => $datos, 'cobrosmes' => $cobrosmes]);
  }
  public function cobrosdia(){
    $carbon = Carbon::now();
    $carbon = $carbon->format('Y-m-d'); //FORMATEA AL MES ACTUAL
    $cupos = Cupo::all();

    $estados = Estado::where('fecha_siguiente_cobro',$carbon)->get(); //TRAE TODOS LOS COBROS DE HOY
    $datos = Dato::all();
    return view('cobrosdia',['cupos' => $cupos, 'estados' => $estados, 'datos' => $datos]);
  }
  public function cobroid($id){

    $dato = Dato::find($id);
    $estado = Estado::find($id);
    $titular = titular::find($id);
    $cupo = Cupo::find($id);
    $cobros = Cobro::where('id','=', $id)->get();
    $carbon = Carbon::now();
    $carbon = $carbon->format('Y-m-d');
    $comentarios = Contacto::where('id','=',$id)->orderBy('created_at','DESC')->get()->take(10);
    return view('cobros_id',[
      'cupo' => $cupo,
      'dato' => $dato,
      'fecha'=>$carbon,
      'estado'=>$estado,
      'titular'=>$titular,
      'cobros' => $cobros,
      'comentarios' => $comentarios,
    ]);
  }
  /**
   * MUESTRA EL HISTORIAL
   */
  public function verhistorial(){
    $cobro = Cobro::all()->sortByDesc('indice')->take(30);
    $dato = Dato::all();
    return view('historial', ['cobros' => $cobro, 'datos' => $dato]);
  }
  /**
   *
   */
  public function verhistorialconmotivo($motivo){
    $estado = Estado::where('fecha_siguiente_cobro',$motivo);
    $dato = Dato::all();
    return view('historial', ['estados' => $estado, 'datos' => $dato]);
  }
  /**
   * MUESTRA A LOS ALUMNOS "DATOS"
   */
  public function veralumnos(){
    $datos = Dato::all();
    $bajas = Baja::all();
    return view('alumnos', ['datos'=> $datos, 'bajas' => $bajas]);
  }
  public function editar($id,Request $request){
    $dato = Dato::find($id);
    $titular = titular::find($id);
    $estado = Estado::find($id);
    $exito =0;
    if ($request['nombre']!=null){
      $dato->nombre = $request['nombre'];
      $dato->dni = $request['dni'];
      $dato->mail = $request['mail'];
      $dato->tarjeta = $request['tarjeta'];
      $dato->save();

      $estado->tipo = $request['tipo'];
      $estado->valor_cuota = $request['valor_cuota'];
      $estado->cuotas_pagas = $request['cuotas_pagas'];
      $estado->valor_restante = $request['valor_restante'];
      $estado->fecha_siguiente_cobro = $request['fecha_siguiente_cobro'];
      $estado->save();

      if ($titular['id']=="") { //SI NO TIENE DATO DE TITULAR LO CREA EN LA DB

        if ($request['nombre-titular']=="") {     //CONTROL DE SI EL CAMPO ESTA VACIO
          $request['nombre-titular']= $request['nombre']; //GUARDA EL VALOR DEL YA INSCRIPTO
        }
        if ($request['dni-titular']=="") { //IDEM
          $request['dni-titular'] = $request['dni'];
        }
        titular::create([
          'id' => $id,
          'nombre' => $request['nombre-titular'],
          'dni' => $request['dni-titular']
        ]);
      }
      else { //SI NO LO ACTUALIZA
        $titular->nombre = $request['nombre-titular'];
        $titular->dni = $request['dni-titular'];
        $titular->save();
      }
      $exito=1;
      $titular = titular::find($id); //EN CASO DE Q SE HAYA CREADO O ACTUALIZADO
      $dato = Dato::find($id);       //VOLVEMOS A BUSCAR EL DATO PARA DEVOLVERLO EN LA VISTA
    }
    return view('editar', ['dato' => $dato, 'exito' =>$exito, 'titular' => $titular, 'estado' => $estado]);
  
      
  }

  public function borrar($id){

    $dato = Dato::find($id);
    $dato->delete();
    $estado = Estado::find($id);
    $estado->delete();
    $titular = titular::find($id);
    $titular->delete();
    return redirect('/')->with('alerta', 'borrado');
  }

  public function editarcobro($id,Request $request){
    $cobro = Cobro::find($id);
    $exito = 0;

    if ($request['numero_operacion']!=null) {
      $cobro->id = $request['id'];
      $cobro->numero_operacion = $request['numero_operacion'];
      $cobro->cant_cuotas = $request['cant_cuotas'];
      $cobro->monto = $request['monto'];
      $cobro->cuenta = $request['cuenta'];
      $cobro->fecha = $request['fecha'];

      $cobro->save();
      $cobro = Cobro::find($id);
      $exito= 1;
    }

    return view('editar-cobro', ['cobro' => $cobro, 'exito' =>$exito]);
  }
  /**
   * REDIRIGE AL INICIO CON EL MENSAJE DE CARGADO CON EXITO
   */
  public function exito(){
    return view('inicio')->with('alerta', 'cargado');
  }
  /**
   * CARGA UN FALSE EN EL ID DE CUPO
   */
  public function sincupo($id, Request $request){
    $cupo = Cupo::find($id);
    $estado = Estado::find($id);
    $carbon = Carbon::createFromFormat('Y-m-d',$estado->fecha_siguiente_cobro);
    $carbon->day = $carbon->day +5;
    $estado->fecha_siguiente_cobro = $carbon->format('Y-m-d');
    $estado->save();
    if ($cupo!=null) {
      $cupo->tiene=$request['cupo'];
      $cupo->save();
    }
    else {
      Cupo::create([
        'id' => $id,
        'tiene' => $request['cupo'],
      ]);
    }
    return redirect('/cobrosmes')->with('alerta', 'exito');
  }
  public function alumnoid($id){
    $dato = Dato::find($id);
    $estado = Estado::find($id);
    $baja = Baja::find($id);
    $cobros = Cobro::where('id','=',$id)->get();
    $comentarios = Contacto::where('id','=',$id)->orderBy('created_at','DESC')->get()->take(10);
    return view('alumno-id', ['dato' => $dato,
                              'cobros' => $cobros,
                              'baja' => $baja,
                              'estado' => $estado,
                              'comentarios' => $comentarios
                            ]);
  }
  public function cargarfactura($id, Request $request){
    $dato = Dato::find($id);
    return view('cargarfactura', ['dato' => $dato]);
  }
  public function alumnopostventa($id){
    $dato = Dato::find($id);

    return view('alumno-postventa',['dato' => $dato]);
  }
  /**
  *EN CASO DE NO EXISTIR EN LOA TABLA BAJAS LO CREA EN ESTADO = 0
  *Y SI EXISTE SE FIJA SI ESTA EN 1 O 0 Y LO CAMBIA POR EL OTRO
  */
  public function baja($id){
    $baja = Baja::find($id);
    if ($baja == null) {
      Baja::create([
        'id' => $id,
        'estado' => 0
      ]);
    } else {
      if ($baja['estado'] == 0) {
        $baja->estado = 1;
      }
      else if ($baja['estado'] == 1){
        $baja->estado = 0;
      }
    }

    $estado = Estado::find($id);
    $estado->fecha_siguiente_cobro = "1000-01-01";
    $estado->save();
    return view('inicio')->with('alerta', 'baja');
  }
}
