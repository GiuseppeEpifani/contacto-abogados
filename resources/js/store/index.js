import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        contenido: [],
        contenidoActualizar: {},
        servicios: {
            fotoFondo: null,
            background: null
        },
        menuColor: {
            colorSubMenu: null,
            colorMenu: null
        }
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
        },
        getServicios(state) {
            axios.get("/servicios").then(res => {
                state.servicios.fotoFondo = res.data[0].fotoFondo;
                state.servicios.background = res.data[0].background;
            }).catch(function (err) {
                alert('Ocurrio un error ' + err)
            });
        },
        getColorMenu(state) {
            axios.get("/mostrarColorMenu").then(res => {
                state.menuColor.colorSubMenu = res.data[0].colorSubMenu;
                state.menuColor.colorMenu = res.data[0].colorMenu;
            }).catch(function (err) {
                alert('Ocurrio un error ' + err)
            });
        }

    },

})