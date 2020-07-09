<template>
  <div>
    <menu-admin />
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-6 margin-top" v-show="show">
          <nuevo-contenido-inicio />
        </div>
        <div class="col-md-12 col-lg-6" v-show="!show">
          <button class="btn btn-outline-danger mb-3 margin-top" v-show="!show" @click="show=!show">
            Agregar nuevo contenido
            <i class="fas fa-plus"></i>
          </button>
          <hr style="width:100px; background: #D32C0B;" />

          <actualizar-contenido-inicio />
        </div>
        <div class="col-md-12 col-lg-6 margin-top">
          <mostrar-tabla-inicio @mostrar-columna-editar="mostrarColumna()" />
        </div>
      </div>
    </div>
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

<style>
.margin-top {
  margin-top: 100px !important;
}
</style>

