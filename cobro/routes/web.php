<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    

Route::get('/', function (){
    return view('inicio');
})->name('inicio');

//if(1==2){
    
    Route::get('/cargaralumno','PaginasController@cargaralumno')->name('cargaralumno');
    Route::get('/cargarcobro','PaginasController@cargarcobro');
    Route::get('/cargar/{id}','PaginasController@cargar');
    Route::get('/cobrosdia','PaginasController@cobrosdia')->name('cobrosdia');
    Route::get('/cobrosmes','PaginasController@cobrosmes')->name('cobrosmes');
    Route::get('/cobro_id/{id}','PaginasController@cobroid');
    Route::get('/cargar_id/{id}','PaginasController@cargarid');
    Route::get('/editar/{id}','PaginasController@editar');
    Route::get('/editar-cobro/{id}','PaginasController@editarcobro');
    Route::get('/borrar/{id}','PaginasController@borrar');
    Route::get('/exito','PaginasController@exito');
    Route::get('/sin-cupo/{id}','PaginasController@sincupo');
    Route::get('/verhistorial','PaginasController@verhistorial')->name('verhistorial');
    Route::get('/verhistorial/{motivo}','PaginasController@verhistorialconmotivo');
    Route::get('/veralumnos','PaginasController@veralumnos')->name('veralumnos');
    Route::get('/alumno_id/{id}',[
      'as' => 'alumnoid',
      'uses' => 'PaginasController@alumnoid'
      ]);
    Route::get('/baja/{id}',[
      'as' => 'baja',
      'uses' => 'PaginasController@baja'
      ]);
    Route::get('/cargar-factura/{id}','PaginasController@cargarfactura');
    Route::get('/alumno-postventa/{id}','PaginasController@alumnopostventa');
    
    Route::post('/cargarComentario/{id}',[
      'as' => 'cargarComentario',
      'uses' => 'FuncionesController@cargarComentario'
    ]);
    
//}   
    


Route::get('/xd',function(){
  return view('xd');
});

