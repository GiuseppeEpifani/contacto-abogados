<template>
  <div>
    <table class="table table-striped" width="100%">
      <thead>
        <tr class="bg-dark text-white">
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Foto</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in contenido" :key="index">
          <th scope="row" v-text="item.id" class="vertical-align"></th>
          <td v-text="item.titulo" class="vertical-align text-suspencivo"></td>
          <td v-text="item.descripcion" class="vertical-align text-suspencivo"></td>
          <td class="vertical-align">
            <img :src="'images/'+item.foto" width="100px" height="100px" class="rounded-circle" />
          </td>
          <td class="vertical-align">
            <button class="btn btn-link btn-action" @click="getContenidoActualizar(item)">
              <i class="far fa-edit"></i>
            </button>
            <button class="btn btn-link btn-action" @click="eliminarContenido(item, index)">
              <i class="far fa-trash-alt"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {};
  },
  computed: {
    ...mapState(["contenido"])
  },
  methods: {
    getInformacionTabla() {
      this.$store.commit("getContenidoInicio");
    },
    getContenidoActualizar(itemActualizar) {
      this.$emit("mostrar-columna-editar");
      this.$store.commit("setUpdateContenidoInicio", itemActualizar);
      this.$root.$emit("set-contenido-inicio");
    },
    eliminarContenido(itemAEliminar, index) {
      swal({
        text:
          "¿Esta seguro de eliminar el contenido: " +
          itemAEliminar.titulo +
          " ?",
        icon: "warning",
        buttons: ["No", "Si"]
      }).then(value => {
        if (value) {
          this.$store.commit("eliminarContenido", {
            id: itemAEliminar.id,
            index: index
          });
          this.$root.$emit("clean-contenido-inicio");
        }
      });
    },
    mostrarColumna() {
      this.$emit("mostrarColumnaEditar");
    }
  },
  created() {
    this.getInformacionTabla();
  }
};
</script>


<style>
.vertical-align {
  vertical-align: middle !important;
}

table {
  table-layout: fixed;
}

td {
  word-wrap: break-word;
}

.btn-action {
  text-decoration: none !important;
  color: #d32c0b !important;
  font-size: 24px !important;
}

.text-suspencivo {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
</style>