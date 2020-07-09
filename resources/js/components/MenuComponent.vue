<template>
  <div>
      <div class="fixed-top">
          <div class="container-fluid bg-dark" style=" border-top: 1px solid #D32C0B;">
            <div class="container p-2">
               <a href="tel:+56989652146" style="text-decoration: none;"> <span class="text-white m-2"><i class="fas fa-phone-alt"></i> +56989652146</span></a>
                <span class="text-white"><i class="fas fa-envelope"></i> Eunice@gmail.com</span>
            </div>
        </div>
    <nav
      class="navbar navbar-expand-lg navbar-dark"
      style="background-color:rgba(252, 0, 0, 0.5) !important;"
    >
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
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#Inicio">Inicio</a>                   
            </li>
             <li class="nav-item">
              <a class="nav-link active" href="#Nosotros">Nosotros</a>                   
            </li>
             <li class="nav-item">
              <a class="nav-link active" href="#Servicios">Servicios</a>                   
            </li>
             <li class="nav-item">
              <a class="nav-link active" href="#Contacto">Contacto</a>                   
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
$(function(){ 
     var navMain = $(".navbar-collapse"); 
     navMain.on("click", "a:not([data-toggle])", null, function () {
         navMain.collapse('hide');
     });
 });

export default {};
</script>

<style scoped>
li .nav-link {
  color: #ffffff !important;
  font-weight: bold;
}


</style>

