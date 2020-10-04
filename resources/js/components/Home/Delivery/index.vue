<template>
  <div class="content-delivery">
    <b-container class="">
      <transition name="fade">
        <template>
          <cancelado-delivery-component v-if="_opcion=='cancelado'"></cancelado-delivery-component>

          <camino-delivery-component v-else-if="_opcion=='camino'"></camino-delivery-component>

          <pendiente-delivery-component v-else-if="_opcion=='pendiente'"></pendiente-delivery-component>

          <entregado-delivery-component v-else-if="_opcion=='entregado'"></entregado-delivery-component>

          <vender-delivery-component v-else></vender-delivery-component>
        </template>
      </transition>
    </b-container>

    <menu-delivery></menu-delivery>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {};
  },
  computed: {
    ...mapState(["_opcion"]),
  },
  
};
</script>

<style lang="scss" scoped>
.content-delivery {
  position: relative;
  padding-right: 120px;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease-in-out, transform 0.5s ease;
}
.fade-enter-active {
  transition-delay: 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
  transform: translateX(-200px);
}

.fade-enter-to, .fade-leave {
  opacity: 1;
  transform: translateX(0px);
}
</style>