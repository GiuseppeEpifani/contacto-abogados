<template>
  <div>
    <div
      id="carouselExampleIndicators"
      class="carousel slide carousel-fade sombra"
      data-ride="carousel"
      data-interval="6000"
      data-pause="false"
    >
      <ol class="carousel-indicators">
        <li
          v-for="(informacion, index) in informacionInicio"
          :key="informacion.id"
          data-target="#carouselExampleIndicators"
          :data-slide-to="index"
          :class="{'active':index===0}"
        ></li>
      </ol>
      <div class="carousel-inner">
        <div
          v-for="(informacion, index) in informacionInicio"
          :key="informacion.id"
          :class="{'carousel-item':true, 'active':index===0}"
        >
          <img :src="'images/'+informacion.foto" alt="Second slide" />

          <div class="carousel-caption">
            <div class="container-titulo">
              <h1 class="titulo-inicio" v-text="informacion.titulo"></h1>
              <div class="container">
                <p class="mt-4" v-text="informacion.descripcion"></p>
              </div>
            </div>

            <div class="contenedor-inicio"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      contador: 0,
      informacionInicio: []
    };
  },
  methods: {
    getInformacionInicio() {
      axios.get("/contenidoInicio").then(res => {
        this.informacionInicio = res.data;
      });
    }
  },
  created() {
    this.getInformacionInicio();
  }
};
</script>

<style>
/*
con esto hacemos que las imagenes del carrusel ocupen siempre toda la pantalla
*/
.carousel-item img {
  height: 100vh !important ;
  width: 100% !important;
}

.carousel-caption {
  max-width: 100%;
  width: 100%;
  height: 100%;
  left: 0 !important;
}

.titulo-inicio {
  color: #000;
  font-weight: bold;
  margin-top: 10px;
}

.container-titulo {
  z-index: 40;
  position: absolute;
  margin-top: 300px;
  width: 100%;
  height: 200px;
  color: #000;
}

.contenedor-inicio {
  z-index: 30;
  width: 100%;
  height: 200px;
  position: absolute;
  background: #ffffff;
  opacity: 0.8;
  margin-top: 300px;
}

#carousel-fade {
  -webkit-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  -moz-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  position: relative;
}

/*
con esto modificamos  los li del carrusel
*/

.carousel-indicators li {
  display: inline-block;
  width: 20px !important;
  height: 20px !important;
  margin: 10px !important;
  text-indent: 0;
  cursor: pointer;
  border: none;
  border-radius: 50%;
  background-color: #ca7767 !important;
  box-shadow: inset 1px 1px 1px 1px rgba(0, 0, 0, 0.5);
}

.carousel-indicators .active {
  width: 20px;
  height: 20px;
  margin: 10px;
  background-color: #d32c0b !important;
  transform: scale(1.1);
}
</style>
