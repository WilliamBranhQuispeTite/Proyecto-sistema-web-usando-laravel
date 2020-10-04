<template>
  <div class="menu_delivery">
    <div class="md_vender" @click="IrA('vender')">
      <b-icon icon="shop-window" font-scale="2.5"></b-icon>Vender
    </div>
    <div class="md_pendiente" @click="IrA('pendiente')">
      <b-icon icon="clock-history" font-scale="2.5"></b-icon>Pendiente
    </div>
    <div class="md_camino" @click="IrA('camino')">
      <b-icon icon="truck" font-scale="2.5"></b-icon>En camino
    </div>
    <div class="md_entregado" @click="IrA('entregado')">
      <b-icon icon="cart-check" font-scale="2.5"></b-icon>Entregados
    </div>
    <div class="md_cancelado" @click="IrA('cancelado')">
      <b-icon icon="cart-dash" font-scale="2.5"></b-icon>Cancelados
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  methods: {
    ...mapActions(['IrA'])
  },
};
</script>

<style lang="scss" scoped>
.menu_delivery {
  position: absolute;
  right: 10px;
  top: 10px;
  width: 90px;
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  justify-content: space-around;
  div {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    box-sizing: border-box;
    padding: 8px;
    border-radius: 5px;
    margin: 10px 0px;
    transition: all 0.2s;
    cursor: pointer;
    
    color:#fff;
    svg{
      
      width: 100%;
    }
    &:hover{
      -webkit-box-shadow: 0px 0px 5px 1px rgba(60,60,60, 0.5);
      -moz-box-shadow: 0px 0px 5px 1px rgba(60,60,60, 0.5);
      box-shadow: 0px 0px 5px 1px rgba(60,60,60, 0.5);
      color: #444;
 
    }
  }
  .md_vender{
    background:#1CA7EC;
    -webkit-box-shadow: 0px 0px 10px 2px rgba(28,167,236, 0.95);
    -moz-box-shadow: 0px 0px 10px 2px rgba(28,167,236, 0.95);
    box-shadow: 0px 0px 10px 2px rgba(28,167,236, 0.95);
  }
  .md_pendiente{
    background:#FCBB6D ;
    -webkit-box-shadow: 0px 0px 10px 2px rgba(252, 187, 109, 0.95);
    -moz-box-shadow: 0px 0px 10px 2px rgba(252, 187, 109, 0.95);
    box-shadow: 0px 0px 10px 2px rgba(252, 187, 109, 0.95);
  }
  .md_camino{
    background:#787FF6 ;
    -webkit-box-shadow: 0px 0px 10px 2px rgba(120,127,246, 0.8) ;
    -moz-box-shadow: 0px 0px 10px 2px rgba(120,127,246, 0.8) ;
    box-shadow: 0px 0px 10px 2px rgba(120,127,246, 0.8) ;
  }
  .md_entregado{
    background:#01a365;
    -webkit-box-shadow: 0px 0px 10px 2pxrgba(1, 163, 101, 0.8) ;
    -moz-box-shadow: 0px 0px 10px 2px rgba(1, 163, 101, 0.8) ;
    box-shadow: 0px 0px 10px 2px rgba(1, 163, 101,0.8) ;
  }
  .md_cancelado{
    background:#f5485c ;
    -webkit-box-shadow: 0px 0px 10px 2pxrgba(245, 72, 92,0.8) ;
    -moz-box-shadow: 0px 0px 10px 2pxrgba(245, 72, 92,0.8) ;
    box-shadow: 0px 0px 10px 2px rgba(245, 72, 92,0.8) ;
  }
}
</style>