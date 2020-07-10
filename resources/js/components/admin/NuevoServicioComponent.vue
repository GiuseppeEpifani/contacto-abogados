<template>
  <div>
    <h1 class="mt-5">Nuevo fondo servicios</h1>
    <div class="container mt-5" style="width:400px">
      <form @submit.prevent="validarFormulario">
        <div v-if="errors.length" class="alert alert-danger" role="alert">
          <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
          </ul>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-10">
              <label for="background">Color de Opasidad</label>
              <select class="form-control" v-model="contenido.background" id="background">
                <option
                  v-for="(item) in colores"
                  :value="item.value"
                  :key="item.value"
                  v-text="item.color"
                ></option>
              </select>
            </div>
            <div class="col-2">
              <div id="div-color" :style="{background:colorSelect}"></div>
            </div>
          </div>
        </div>
        <vue-dropzone
          ref="serviciosVueDropzone"
          id="dropzoneServicio"
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
        background: null,
        foto: []
      },
      colores: [
        { value: null, color: "Seleccione un color" },
        { value: "#d32c0b", color: "Rojo" },
        { value: "#FE4A4A", color: "Rojo claro" },
        { value: "#095ee6", color: "Azul" },
        { value: "#23B2FA", color: "Azul" },
        { value: "#0eb91c", color: "Verde" },
        { value: "#B5FF66", color: "Verde" },
        { value: "#D4F906", color: "verde fluor" },
        { value: "#F97C06", color: "Naranja Oscuro" },
        { value: "#F9A106", color: "Naranja claro" },
        { value: "#2CF6E7", color: "Celeste" },
        { value: "#792CF6", color: "Morado" },
        { value: "#9B78F9", color: "Morado claro" },
        { value: "#DA2CF6", color: "Violeta" },
        { value: "#A87315", color: "Marron" },
        { value: "#F5B64F", color: "Marron claro" },
        { value: "#000", color: "Negro" },
        { value: "#ffffff", color: "Blanco" },
        { value: "#fae900", color: "Amarillo" }
      ],
      formularioEnviado: false,
      dropzoneOptions: {
        url: "/subirInicioImages",
        autoProcessQueue: false,
        maxFiles: 1,
        acceptedFiles: "image/jpeg,image/png,image/jpg,image",
        addRemoveLinks: true,
        thumbnailWidth: 150,
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
  computed: {
    colorSelect() {
      return this.contenido.background;
    }
  },
  methods: {
    validarFormulario(e) {
      this.errors = [];
      var foto = document.getElementById("dropzoneServicio");
      var background = document.getElementById("background");

      if (
        !this.contenido.background ||
        this.contenido.background == "Seleccione un color"
      ) {
        this.errors.push("Seleccione un color.");
        background.className += " border-danger";
      } else {
        background.classList.remove("border-danger");
      }
      if (!this.contenido.foto.length) {
        this.errors.push("Suba una foto.");
        foto.className += " border-danger";
      } else {
        foto.classList.remove("border-danger");
      }

      if (this.contenido.foto.length && this.contenido.background) {
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
        this.$refs.serviciosVueDropzone.removeAllFiles();
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
      this.$refs.serviciosVueDropzone.removeFile(file);
    },
    mostrarSpinnerYBloquerBtnYLimpiarErrores() {
      this.errors = [];
      document.getElementById("btn-enviar").disabled = true;
      this.formularioEnviado = true;
    },

    enviarFormulario() {
      const config = { headers: { "Content-Type": "multipart/form-data" } };

      var formData = new FormData();
      formData.append("background", this.contenido.background);
      formData.append("foto", this.contenido.foto[0]);
      this.limpiarFormulario();

      axios
        .post("/subirServicio", formData, config)
        .then(res => {
          this.terminarProcesoSubida();
          // this.recargarDatosTabla();
        })
        .catch(function(err) {
          alert("Ocurrio un error " + err);
        });
    },
    limpiarFormulario() {
      this.errors = [];
      this.contenido.foto = [];
      this.contenido.background = null;
      this.$refs.serviciosVueDropzone.removeAllFiles();
    },
    terminarProcesoSubida() {
      document.getElementById("btn-enviar").disabled = false;
      this.formularioEnviado = false;
      swal({
        title: "Publicado!",
        icon: "success",
        button: "Aceptar"
      });
    }
  }
};
</script>
 
<style>
#div-color {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-top: 33px;
}
</style>