<template>
  <div>
    <h1 class="margin-top">Nuevo Color Menu</h1>
    <div class="container mt-5 mb-5" style="width:400px">
      <form @submit.prevent="validarFormulario">
        <div v-if="errors.length" class="alert alert-danger" role="alert">
          <ul>
            <li v-for="error in errors" :key="error">{{ error }}</li>
          </ul>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-10">
              <label for="colorSubMenu">Color subMenu</label>
              <select class="form-control" v-model="contenido.colorSubMenu" id="colorSubMenu">
                <option
                  v-for="(item) in coloresSubMenu"
                  :value="item.value"
                  :key="item.value"
                  v-text="item.color"
                ></option>
              </select>
            </div>
            <div class="col-2">
              <div id="div-color" :style="{backgroundColor:colorSelectMenu}"></div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-10">
              <label for="colorMenu">Color Menu</label>
              <select class="form-control" v-model="contenido.colorMenu" id="colorMenu">
                <option
                  v-for="(item) in coloresMenu"
                  :value="item.value"
                  :key="item.value"
                  v-text="item.color"
                ></option>
              </select>
            </div>
            <div class="col-2">
              <div id="div-color" :style="{background:colorSelectSubMenu}"></div>
            </div>
          </div>
        </div>
        <button
          type="submit"
          class="btn btn-dark btn-lg btn-block mt-3"
          id="btn-cambiar"
          style="height: 50px;"
        >
          <span v-if="!formularioEnviado">Cambiar</span>
          <span v-if="formularioEnviado">
            Cambiando...
            <div class="spinner-border" role="status"></div>
          </span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      errors: [],
      contenido: {
        colorMenu: null,
        colorSubMenu: null
      },
      coloresMenu: [
        { value: null, color: "Seleccione un color" },
        { value: "rgba(255, 0, 5, 0.7)", color: "Rojo" },
        { value: "rgba(0, 83, 255, 0.7)", color: "Azul" },
        { value: "rgba(0, 113, 210, 0.7)", color: "Azul claro" },
        { value: "rgba(255, 222, 210, 0.7)", color: "Piel" },
        { value: "rgba(102, 168, 17, 0.7)", color: "Verde" },
        { value: "rgba(197, 255, 0, 0.7)", color: "verde fluor" },
        { value: "rgba(255, 134, 5, 0.7)", color: "Naranja" },
        { value: "rgba(246, 44, 0, 0.7)", color: "Naranja oscuro" },
        { value: "rgba(59, 255, 255, 0.7)", color: "Celeste" },
        { value: "rgba(54, 37, 172, 0.7)", color: "Morado" },
        { value: "rgba(192, 37, 172, 0.7)", color: "Violeta" },
        { value: "rgba(73, 0, 47, 0.7)", color: "Vino" },
        { value: "rgba(97, 31, 0, 0.7)", color: "Marron" },
        { value: "rgba(161, 118, 47, 0.7)", color: "Marron claro" },
        { value: "rgba(0, 0, 0, 0.7)", color: "Negro" },
        { value: "rgba(255, 255, 255, 0.7)", color: "Blanco" },
        { value: " rgba(255, 222, 0, 0.7)", color: "Amarillo" }
      ],
      coloresSubMenu: [
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
        { value: "#564C4C", color: "Plomo" },
        { value: "#3E3E3E", color: "Plomo oscuro" },
        { value: "#B6ABAB", color: "Plomo claro" },
        { value: "#ffffff", color: "Blanco" },
        { value: "#fae900", color: "Amarillo" }
      ],
      formularioEnviado: false
    };
  },
  computed: {
    colorSelectMenu() {
      return this.contenido.colorSubMenu;
    },
    colorSelectSubMenu() {
      return this.contenido.colorMenu;
    }
  },
  methods: {
    validarFormulario(e) {
      this.errors = [];
      var colorSubMenu = document.getElementById("colorSubMenu");
      var colorMenu = document.getElementById("colorMenu");

      if (
        !this.contenido.colorSubMenu ||
        this.contenido.colorSubMenu == "Seleccione un color"
      ) {
        this.errors.push("Seleccione un color de SubMenu.");
        colorSubMenu.className += " border-danger";
      } else {
        colorSubMenu.classList.remove("border-danger");
      }
      if (
        !this.contenido.colorMenu ||
        this.contenido.colorMenu == "Seleccione un color"
      ) {
        this.errors.push("Seleccione un color de Menu.");
        colorMenu.className += " border-danger";
      } else {
        colorMenu.classList.remove("border-danger");
      }

      if (this.contenido.colorMenu && this.contenido.colorSubMenu) {
        this.mostrarSpinnerYBloquerBtnYLimpiarErrores();
        this.enviarFormulario();
        return true;
      }
    },
    mostrarSpinnerYBloquerBtnYLimpiarErrores() {
      this.errors = [];
      document.getElementById("btn-cambiar").disabled = true;
      this.formularioEnviado = true;
    },

    enviarFormulario() {
      const config = { headers: { "Content-Type": "multipart/form-data" } };

      var formData = new FormData();
      formData.append("colorSubMenu", this.contenido.colorSubMenu);
      formData.append("colorMenu", this.contenido.colorMenu);
      this.limpiarFormulario();

      axios
        .post("/NuevoColorMenu", formData, config)
        .then(res => {
          this.terminarProcesoSubida();
        })
        .catch(function(err) {
          alert("Ocurrio un error " + err);
        });
    },
    limpiarFormulario() {
      this.errors = [];
      this.contenido.colorSubMenu = null;
      this.contenido.colorMenu = null;
    },
    terminarProcesoSubida() {
      document.getElementById("btn-cambiar").disabled = false;
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
.margin-top {
  margin-top: 100px !important;
}
</style>