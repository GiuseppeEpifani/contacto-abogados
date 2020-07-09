
Dropzone.options.myDropzone = {
        url: 'procesa_propiedad_ajax.php',
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 10,
        maxFilesize: 1,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
        dictRemoveFile: "×",
        ictDefaultMessage: "Arrastra los archivos aqui para subirlos",
        dictFallbackMessage: "Su navegador no soporta arrastrar y soltar para subir archivos.",
        dictFallbackText: "Por favor utilize el formuario de reserva de abajo como en los viejos timepos.",
        dictFileTooBig: "La imagen revasa el tamaño permitido ({{filesize}}MiB). Tam. Max : {{maxFilesize}}MiB.",
        dictInvalidFileType: "No se puede subir este tipo de archivos.",
        dictResponseError: "Server responded with {{statusCode}} code.",
        dictCancelUpload: "Cancel subida",
        dictCancelUploadConfirmation: "¿Seguro que desea cancelar esta subida?",
        dictRemoveFileConfirmation: null,
        dictMaxFilesExceeded: "Se ha excedido el numero de archivos permitidos.",
        init: function () {
                this.on("addedfile", function (file) {
                        if ($arrayfiles.length < 10) {
                                $arrayfiles.push(file);
                                console.log("arrayfiles", arrayfiles)
                        };
                });

                this.on("removedfile", function (file) {
                        var index = $arrayfiles.indexOf(file);
                        $arrayfiles.splice(index, 1);
                        console.log("arrayfiles", arrayfiles)
                });
        }


}

function limpiar_dropzone() {
        Dropzone.forElement("#myDropzone").removeAllFiles(true);
}

function preguntar_si_existen_fotos() {
        return arrayfiles.length;
}


function subir_fotos() {
        if (arrayfiles.length > 0) {
                $('#validar_fotos_propiedad').hide();
                //el FormData sirve para simular un formulario en js
                var datosMultimedia = new FormData();
                for (var i = 0; i < arrayfiles.length; i++) {
                        //aca ocupamos la variable de FormData punto append, luego de eso el primer valor vendria a ser el nombre con el cual se recibira en el php y el segundo valor vendria a ser lo que va a contener, array, int, etc
                        datosMultimedia.append("file", arrayfiles[i]);
                        datosMultimedia.append("posicion", i);


                        $.ajax({
                                url: "procesa_propiedad_ajax.php",
                                type: "POST",
                                //luego mandamos todo con ajax, con el nombre de la variable que le dimos el FormData, ya que es ella simulamos el formulario
                                data: datosMultimedia,
                                cache: false,
                                contentType: false,
                                processData: false,
                                beforeSend: function () {
                                        swal({
                                                Text: "Subiendo Propiedad",
                                                icon: "imagenes/cargando.gif",
                                                buttons: false,
                                                timer: 5500,
                                        });
                                },
                                success: function (response) {
                                        if (response == arrayfiles.length - 1) {
                                                location.href = "inicio_usuarios.php";
                                        }
                                }
                        });
                }
        } else {
                $('#validar_fotos_propiedad').show();
        }

};



