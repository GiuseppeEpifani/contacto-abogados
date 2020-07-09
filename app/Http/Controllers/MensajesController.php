<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MensajeRecibido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MensajesController extends Controller
{
    
    public function store(Request $request)
    {
        if ($request->wantsJson()){

        $mensaje=$request->validate([
            'nombre'=>'required',
            'email'=>'required',
            'servicio'=>'required',
            'asunto'=>'required'
        ]);

            
        Mail::to('giuseppe.epifanivillalobos@gmail.com')->send(new MensajeRecibido($mensaje));

        return  'Mensaje Enviado';

        }else{

            return view('/');
        }

        
    }
}
