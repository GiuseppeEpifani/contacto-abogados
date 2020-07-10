<template>
  <div>
    <menu-admin />
    <div class="container">
      <nuevo-color-menu />
      <hr style="background:#000" />
      <h1 class="mt-5">Nuevo contenido inicio</h1>
      <div class="row mb-5">
        <div class="col-md-12 col-lg-6 mt-5" v-show="show">
          <nuevo-contenido-inicio />
        </div>
        <div class="col-md-12 col-lg-6 mt-5" v-show="!show">
          <button class="btn btn-outline-danger mb-3" v-show="!show" @click="show=!show">
            Agregar nuevo contenido
            <i class="fas fa-plus"></i>
          </button>
          <hr style="width:100px; background: #D32C0B;" />

          <actualizar-contenido-inicio />
        </div>
        <div class="col-md-12 col-lg-6 mt-5">
          <mostrar-tabla-inicio @mostrar-columna-editar="mostrarColumna()" />
        </div>
      </div>
      <hr style="background:#000" />
      <nuevo-servicio class="mt-5" />
    </div>
    <br />
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: true
    };
  },
  methods: {
    mostrarColumna() {
      this.show = false;
    }
  },
  mounted() {
    this.$root.$on("clean-contenido-inicio", () => {
      this.show = true;
    });
  }
};
</script>



