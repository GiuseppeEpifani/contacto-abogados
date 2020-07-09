<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<bod>

    <div style=" -webkit-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
    -moz-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
    box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);">
        <div style="background: #D32C0B;">
            <center><span style="color: #ffffff; font-weight: bold;">
                    <h3>Contacto Pagina Web</h3>
                </span></center>
        </div>
        <div>
            <p style="margin-left: 5px;">Recibiste un mensaje de: {{ $mensaje['nombre']}}</p>
            <p style="margin-left: 5px;"><strong>Servicio:</strong> {{ $mensaje['servicio']}}</p>
            <p style="margin-left: 5px;"><strong>Asunto:</strong> {{ $mensaje['asunto']}}</p>
            <br>
            <p style="margin-left: 5px;">Responder mensaje al siguiente correo: {{ $mensaje['email']}}
            </p>
        </div>
        <br>
    </div>
    </body>

</html>