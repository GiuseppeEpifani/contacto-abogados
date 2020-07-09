<template>
  <div>
    <h3 class="mb-3 titulos">Contactanos</h3>
    <div class="container mt-1 mb-5">
      <div class="card mx-auto" style="max-width: 800px;">
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.0708239969235!2d-71.33264018426048!3d-29.977394535122986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9691c921400cb233%3A0x4cd99f43284a5600!2sEstados%20Unidos%201185%2C%20Coquimbo!5e0!3m2!1sen!2scl!4v1593545592148!5m2!1sen!2scl"
              width="392"
              height="502"
              frameborder="0"
              style="border:0;"
              allowfullscreen
              aria-hidden="false"
              tabindex="0"
            ></iframe>
          </div>
          <div class="col-md-12 col-lg-6">
            <div class="card-body">
              <h4 class="card-title mt-1">Responderemos en Breve</h4>
              <form @submit.prevent="validarFormulario">
                <div v-if="errors.length" class="alert alert-danger" role="alert">
                  <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                  </ul>
                </div>
                <div class="form-group">
                  <label for="email">Nombre completo</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    placeholder="Nombre y Apellido"
                    v-model="nombre"
                  />
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    placeholder="Ingrese su Email"
                    v-model="email"
                  />
                </div>
                <div class="form-group">
                  <label for="servicios">Servicio</label>
                  <select class="form-control" v-model="servicio" id="servicio">
                    <option
                      v-for="(item) in servicios"
                      :value="item.value"
                      :key="item.value"
                      v-text="item.servicio"
                    ></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="asunto">Asunto</label>
                  <textarea
                    class="form-control"
                    id="asunto"
                    rows="3"
                    style=" resize: none;"
                    v-model="asunto"
                  ></textarea>
                </div>

                <button
                  type="submit"
                  class="btn btn-dark btn-lg btn-block"
                  id="btn-enviar"
                  style="height: 50px;"
                >
                  <span v-if="!correoEnviado">Enviar</span>
                  <span v-if="correoEnviado">
                    Enviando...
                    <div class="spinner-border" role="status"></div>
                  </span>
                </button>
              </form>
            </div>
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
      correoEnviado: false,
      servicio: null,
      servicios: [
        { value: null, servicio: "Seleccione el Servicio" },
        { value: "Tercerias", servicio: "Tercerias" },
        { value: "Defensa deudores", servicio: "Defensa deudores" },
        { value: "servicios3", servicio: "servicios1" },
        { value: "servicios4", servicio: "servicios1" }
      ],
      errors: [],
      nombre: null,
      email: null,
      asunto: null
    };
  },
  methods: {
    validarFormulario(e) {
      this.errors = [];
      var nombre = document.getElementById("nombre");
      var email = document.getElementById("email");
      var servicio = document.getElementById("servicio");
      var asunto = document.getElementById("asunto");
      if (!this.nombre) {
        this.errors.push("Ingrese el nombre.");
        nombre.className += " border-danger";
      } else {
        nombre.classList.remove("border-danger");
      }
      if (!this.email) {
        this.errors.push("Ingrese el email.");
        email.className += " border-danger";
      } else if (!this.validarEmail(this.email)) {
        this.errors.push("ingrese un email valido.");
        email.className += " border-danger";
        return;
      } else {
        email.classList.remove("border-danger");
      }
      if (!this.servicio || this.servicio == "Seleccione el Servicio") {
        this.errors.push("Ingrese el servicio.");
        servicio.className += " border-danger";
      } else {
        servicio.classList.remove("border-danger");
      }
      if (!this.asunto) {
        this.errors.push("Ingrese el asunto.");
        asunto.className += " border-danger";
      } else {
        asunto.classList.remove("border-danger");
      }

      if (this.nombre && this.email && this.asunto && this.servicio) {
        this.mostrarSpinnerYBloquerBtnYLimpiarErrores();
        this.enviarCorreo();
        return true;
      }
    },
    validarEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    mostrarSpinnerYBloquerBtnYLimpiarErrores() {
      this.errors = [];
      document.getElementById("btn-enviar").disabled = true;
      this.correoEnviado = true;
    },
    enviarCorreo() {
      const params = {
        nombre: this.nombre,
        email: this.email,
        servicio: this.servicio,
        asunto: this.asunto
      };

      this.linpiarFormulario();

      axios.post("/correo", params).then(res => {
        this.terminarProcesoEnvioCorreo();
      });
    },

    linpiarFormulario() {
      this.nombre = "";
      this.email = "";
      this.servicio = null;
      this.asunto = "";
    },
    terminarProcesoEnvioCorreo() {
      document.getElementById("btn-enviar").disabled = false;
      this.correoEnviado = false;
      swal({
        title: "Correo enviado",
        text: "Responderemos en breve",
        icon: "success",
        button: "Aceptar"
      });
    }
  }
};
</script>

<style>
.swal-button--confirm {
  background: #d32c0b !important;
  color: #ffffff !important ;
}

.swal-button--confirm:hover {
  transform: scale(1.1) !important;
}
</style>
