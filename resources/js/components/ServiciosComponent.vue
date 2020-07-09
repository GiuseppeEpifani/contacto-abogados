<template>
  <div>
    <h3 class="mt-5 mb-3 titulo-servicios titulos">¿Con que te ayudamos?</h3>
    <div class="contenedor-servicios">
      <div class="contenedor-servicios-opacity"></div>
      <div class="container pt-5 mb-5">
        <div class="row">
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-balance-scale-right icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>
                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-hand-holding-usd icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>

                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-hand-holding-usd icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>
                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-hand-holding-usd icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>
                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-hand-holding-usd icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>
                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-lg-4 mb-5">
            <div class="card sombra">
              <div class="row">
                <div class="col-md-3">
                  <i class="fas fa-hand-holding-usd icon"></i>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h4 class="card-title mt-1">Tercerias</h4>
                    <p
                      class="card-text"
                    >Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>


<style scoped>
.card {
  border-radius: 5%;
  z-index: 100 !important;
}

@media only screen and (min-width: 700px) {
  .contenedor-servicios-opacity {
    z-index: 30;
    width: 100%;
    position: absolute;
    background: #d32c0b;
    opacity: 0.4;
    height: 100%;
  }
}

.contenedor-servicios-opacity {
  z-index: 30;
  width: 100%;
  position: absolute;
  background: #d32c0b;
  opacity: 0.3;
  height: 100%;
}

.contenedor-servicios {
  border-top: 1px solid #000;
  z-index: 20;
  margin-top: 20px;
  background-attachment: fixed;
  background-position: center center;
  background-size: cover;
  background-image: url("/images/servicioFondo.jpg") !important;
  -webkit-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  -moz-box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  box-shadow: 10px 10px 5px -4px rgba(0, 0, 0, 0.44);
  position: relative;
}

.icon {
  font-size: 70px;
  margin-top: 22px;
  margin-left: 10px;
}
</style>
