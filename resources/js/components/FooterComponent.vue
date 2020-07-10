<template>
  <div>
    <div :style="{background: menuColor.colorMenu}" style="height: 10px;"></div>
    <div class="cotainer-fluid" :style="{background: menuColor.colorSubMenu}">
      <div class="container d-flex justify-content-center">
        <div class="d-flex flex-column mb-3 mt-3">
          <div>
            <h3 class="text-white">Sigueme</h3>
          </div>
          <div>
            <a class="nav-link text-white" href="#">
              <i class="fab fa-instagram"></i> Instagram
            </a>
          </div>
        </div>

        <div class="d-flex flex-column mb-3 mt-3" style="margin-left: 15px !important;">
          <div class="mr-2">
            <h3 class="text-white">Contactame</h3>
          </div>
          <div class="mr-2">
            <span class="text-white">
              <i class="fas fa-phone-alt"></i> +58989542146
            </span>
          </div>
          <div class="mr-2">
            <span class="text-white">
              <i class="fas fa-envelope"></i> Eunice@gmail.com
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["menuColor"])
  },
  methods: {
    getColorMenu() {
      this.$store.commit("getColorMenu");
    }
  },
  created() {
    this.getColorMenu();
  }
};
</script>

<style scoped>
li .nav-link {
  color: #ffffff !important;
  font-weight: bold;
}
</style>   
   
  