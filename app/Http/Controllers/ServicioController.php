<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;

class ServicioController extends Controller
{

    public function index()
    {
        return Servicio::all();
    }

    public function subirNuevoServicio(Request $request)
    {
        if ($request->wantsJson()) {

            Servicio::truncate();
            $nombreFicheroJPG = 'imagesServicios/camusYepifaniabogadasServicios.jpg';
            $nombreFicheroPNG = 'imagesServicios/camusYepifaniabogadasServicios.png';
            $nombreFicheroJPEG = 'imagesServicios/camusYepifaniabogadasServicios.jpeg';
            $nombreFicheroTIFF = 'imagesServicios/camusYepifaniabogadasServicios.tiff';
            $nombreFicheroJFIF = 'imagesServicios/camusYepifaniabogadasServicios.jfif';

            if (file_exists($nombreFicheroJPG)) {
                unlink($nombreFicheroJPG);
            }else if(file_exists($nombreFicheroPNG)){
                unlink($nombreFicheroPNG);
            }else if(file_exists($nombreFicheroJPEG)){
                unlink($nombreFicheroJPEG);
            }else if(file_exists($nombreFicheroTIFF)){
                unlink($nombreFicheroTIFF);
            }else if(file_exists($nombreFicheroJFIF)){
                unlink($nombreFicheroJFIF);
            }

            $image = $request->foto;
            $imageName = 'camusYepifaniabogadasServicios.'.$image->getClientOriginalExtension();
            $image->move(public_path('imagesServicios'), $imageName);

            $NuevoServicio = new Servicio();
            $NuevoServicio->background = $request->background;
            $NuevoServicio->fotoFondo = $imageName;
            $NuevoServicio->save();
        }
    }
}
