import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        contenido: [],
        contenidoActualizar: {},
    },
    mutations: {
        getContenidoInicio(state) {
            axios.get("/mostrarTodosLosRegistros").then(res => {
                state.contenido = res.data;
            }).catch(function (err) {
                alert('Ocurrio un error ' + err)
            });
        },
        setUpdateContenidoInicio(state, contenidoActualizar) {
            state.contenidoActualizar = contenidoActualizar;
        },
        updateContenidoInicio(state, contenidoActualizado) {
            const index = state.contenido.findIndex(item => item.id === contenidoActualizado.id);
            Vue.set(state.contenido, index, contenidoActualizado);
        },
        eliminarContenido(state, { id, index }) {
            axios.delete(`/eliminarContenido/${id}`).then(() => {
                state.contenido.splice(index, 1);
            });
        }

    },

})