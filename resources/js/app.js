require('./bootstrap');


import swal from 'sweetalert';
import store from './store';
window.Vue = require('vue');


Vue.component('menuBar', require('./components/MenuComponent.vue').default);
Vue.component('principal', require('./components/PrincipalComponent.vue').default);
Vue.component('inicio', require('./components/InicioComponent.vue').default);
Vue.component('nosotros', require('./components/NosotrosComponent.vue').default);
Vue.component('servicios', require('./components/ServiciosComponent.vue').default);
Vue.component('contacto', require('./components/ContactoComponent.vue').default);
Vue.component('pie-de-pagina', require('./components/FooterComponent.vue').default);

Vue.component('principal-admin', require('./components/admin/PrincipalAdminComponent.vue').default);
Vue.component('menu-admin', require('./components/admin/MenuAdminComponent.vue').default);
Vue.component('nuevo-contenido-inicio', require('./components/admin/NuevoContenidoInicioComponent.vue').default);
Vue.component('actualizar-contenido-inicio', require('./components/admin/ActualizarContenidoInicioComponent.vue').default);
Vue.component('mostrar-tabla-inicio', require('./components/admin/TablaActualizarEliminarComponent.vue').default);




const app = new Vue({
    el: '#app',
    store
});
