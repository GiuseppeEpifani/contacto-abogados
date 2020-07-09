<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inicio;

class ContenidoInicioController extends Controller
{

  public function index()
  {
    return inicio::orderBy('id', 'DESC')->get();
  }


  public function subirContenidoInicio(Request $request)
  {
    $image = $request->foto;
    $imageName = time() . '_camusYepifaniabogadas.' . $image->getClientOriginalExtension();
    $image->move(public_path('images'), $imageName);
    $size = filesize('images/' . $imageName);

    $NuevaPublicacionInicio = new Inicio();
    $NuevaPublicacionInicio->titulo = $request->titulo;
    $NuevaPublicacionInicio->descripcion = $request->descripcion;
    $NuevaPublicacionInicio->foto = $imageName;
    $NuevaPublicacionInicio->size = $size;
    $NuevaPublicacionInicio->save();
  }

  public function updateContenidoInicio(Request $request, $id)
  {
    $NuevaPublicacionInicio = Inicio::find($id);
    $NuevaPublicacionInicio->titulo = $request->titulo;
    $NuevaPublicacionInicio->descripcion = $request->descripcion;

    if (!$request->size) {
      $image = $request->foto;
      $imageName = time() . '_camusYepifaniabogadas.' . $image->getClientOriginalExtension();
      $image->move(public_path('images'), $imageName);
      $size = filesize('images/' . $imageName);
      $NuevaPublicacionInicio->size = $size;
      $imagenABorrar = $NuevaPublicacionInicio->foto;
      unlink("images/" . $imagenABorrar);
      $NuevaPublicacionInicio->foto = $imageName;
    }
    $NuevaPublicacionInicio->save();

    return Inicio::find($id);

  }

  public function showAll()
  {
    return inicio::orderBy('id', 'DESC')->get();
  }

  public function show($id)
  {
    return inicio::find($id);
  }

  public function destroy($id)
  {
    $contenido = inicio::find($id);
    $imagenABorrar=$contenido->foto;
    unlink("images/" . $imagenABorrar);
    $contenido->delete();
  }
}
