<template>
  <div>
    <div class="fixed-top">
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#D32C0B !important;">
        <div class="container">
          <a class="navbar-brand" href="#">Logo</a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse text-center" id="navbarNav">
            <ul class="navbar-nav ml-auto d-none d-md-block">
              <li class="nav-item">
                <a class="nav-link active" href="#" @click.prevent="cerrarSesion">
                  Cerrar Sesión
                  <i class="fas fa-sign-out-alt"></i>
                </a>
              </li>
            </ul>
            <ul class="navbar-nav d-md-none">
              <li class="nav-item">
                <a class="nav-link active" href="#" @click.prevent="cerrarSesion">
                  Cerrar Sesión
                  <i class="fas fa-sign-out-alt"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
//funcion que sirve para esconder el menu desplegable al hacer click en un link
$(function() {
  var navMain = $(".navbar-collapse");
  navMain.on("click", "a:not([data-toggle])", null, function() {
    navMain.collapse("hide");
  });
});

export default {
  methods: {
    cerrarSesion: function() {
      axios.post("/logout").then(() => location.reload());
    }
  }
};
</script>

<style scoped>
li .nav-link {
  color: #ffffff !important;
  font-weight: bold;
}
</style>

