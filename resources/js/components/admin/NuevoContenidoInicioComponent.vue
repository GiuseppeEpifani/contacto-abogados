<template>
  <div>
    <div class="container" style="width:400px">
      <form @submit.prevent="validarFormulario">
        <div v-if="errors.length" class="alert alert-danger" role="alert">
          <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
          </ul>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Titulo</label>
          <input type="text" class="form-control" id="titulo" v-model="contenido.titulo" />
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Descripcion</label>
          <textarea
            class="form-control"
            id="descripcion"
            v-model="contenido.descripcion"
            rows="3"
            style=" resize: none;"
          ></textarea>
        </div>
        <vue-dropzone
          ref="myVueDropzone"
          id="dropzone"
          :options="dropzoneOptions"
          v-on:vdropzone-removed-file="removerFoto"
          v-on:vdropzone-file-added="agregarFoto"
          v-on:vdropzone-max-files-exceeded="evitarSubirMasDeUnaFoto"
        ></vue-dropzone>

        <button
          type="submit"
          class="btn btn-dark btn-lg btn-block mt-3"
          id="btn-enviar"
          style="height: 50px;"
        >
          <span v-if="!formularioEnviado">Subir</span>
          <span v-if="formularioEnviado">
            Subiendo...
            <div class="spinner-border" role="status"></div>
          </span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
export default {
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    return {
      totalsize: 0,
      errors: [],
      contenido: {
        titulo: null,
        descripcion: null,
        foto: []
      },
      formularioEnviado: false,
      dropzoneOptions: {
        url: "/subirInicioImages",
        autoProcessQueue: false,
        maxFiles: 1,
        acceptedFiles: "image/jpeg,image/png,image/jpg,image",
        addRemoveLinks: true,
        thumbnailWidth: 150, // px
        thumbnailHeight: 150,
        dictRemoveFile: "×",
        dictDefaultMessage:
          "<i class='fa fa-cloud-upload'></i>  Click o Arrastre la foto.",
        dictInvalidFileType: "No se puede subir este tipo de archivos.",
        dictMaxFilesExceeded:
          "Se ha excedido el numero de archivos permitidos.",
        dictFileTooBig:
          "La imagen revasa el tamaño permitido ({{filesize}}MiB). Tam. Max : {{maxFilesize}}MiB.",
        dictFallbackMessage:
          "Su navegador no soporta arrastrar y soltar para subir archivos.",
        dictInvalidFileType: "No se puede subir este tipo de archivos."
      }
    };
  },

  methods: {
    validarFormulario(e) {
      this.errors = [];
      var titulo = document.getElementById("titulo");
      var descripcion = document.getElementById("descripcion");
      var foto = document.getElementById("dropzone");
      if (!this.contenido.titulo) {
        this.errors.push("Ingrese el Titulo.");
        titulo.className += " border-danger";
      } else {
        titulo.classList.remove("border-danger");
      }
      if (!this.contenido.descripcion) {
        this.errors.push("Ingrese la descripcion.");
        descripcion.className += " border-danger";
      } else {
        descripcion.classList.remove("border-danger");
      }
      if (!this.contenido.foto.length) {
        this.errors.push("Suba una foto.");
        foto.className += " border-danger";
      } else {
        foto.classList.remove("border-danger");
      }

      if (
        this.contenido.titulo &&
        this.contenido.descripcion &&
        this.contenido.foto.length
      ) {
        this.mostrarSpinnerYBloquerBtnYLimpiarErrores();
        this.enviarFormulario();
        return true;
      }
    },
    agregarFoto(file) {
      if (this.validarFileSize(file)) {
        this.contenido.foto.push(file);
      } else {
        alert("La imagen excede el tamaño permitido.");
        this.$refs.myVueDropzone.removeAllFiles();
      }
    },
    validarFileSize(file) {
      var sizeByte = file.size;
      var sizekiloBytes = parseInt(sizeByte / 1024);
      return sizekiloBytes < 2000;
    },
    removerFoto(file) {
      var index = this.contenido.foto.indexOf(file);
      this.contenido.foto.splice(index, 1);
    },
    evitarSubirMasDeUnaFoto(file) {
      this.$refs.myVueDropzone.removeFile(file);
    },
    mostrarSpinnerYBloquerBtnYLimpiarErrores() {
      this.errors = [];
      document.getElementById("btn-enviar").disabled = true;
      this.formularioEnviado = true;
    },

    enviarFormulario() {
      const config = { headers: { "Content-Type": "multipart/form-data" } };

      var formData = new FormData();
      formData.append("titulo", this.contenido.titulo);
      formData.append("descripcion", this.contenido.descripcion);
      var fotoASubir = this.contenido.foto[0];
      formData.append("foto", fotoASubir);
      this.limpiarFormulario();

      axios
        .post("/subirInicioImages", formData, config)
        .then(res => {
          this.terminarProcesoSubida();
          this.recargarDatosTabla();
        })
        .catch(function(err) {
          alert("Ocurrio un error " + err);
        });
    },
    limpiarFormulario() {
      this.errors = [];
      this.contenido.titulo = "";
      this.contenido.descripcion = "";
      this.contenido.foto = [];
      this.$refs.myVueDropzone.removeAllFiles();
    },
    terminarProcesoSubida() {
      document.getElementById("btn-enviar").disabled = false;
      this.formularioEnviado = false;
      swal({
        title: "Publicado!",
        icon: "success",
        button: "Aceptar"
      });
    },
    recargarDatosTabla() {
      this.$store.commit("getContenidoInicio");
    }
  },
  mounted() {
    this.$root.$on("clean-contenido-inicio", () => {
      this.limpiarFormulario();
    });
  }
};
</script>

<style>
.dz-remove {
  text-decoration: none !important;
  top: 5px !important;
  right: 5px !important;
  height: 32px !important;
  width: 32px !important;
  font-size: 1.3em !important;
  line-height: 0.5em !important;
  font-weight: bold !important;
  border-radius: 1.2em;
  color: white;
  background-color: red;
  opacity: 0.5;
}

.dz-remove:hover {
  text-decoration: none !important;
  opacity: 1 !important;
}
</style>

