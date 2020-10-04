<template>
  <section>
    <h4>Vender</h4>
    <hr />
 
      <b-row>
        <b-col class="mb-2" v-for="(item, index) in pendientes" :key="index" lg="6">
          <b-card class="rounded-lg">
            <b-badge class="ped_estado" variant="warning">{{item.estado}}</b-badge>
            <p class="mb-0 mt-2 w-100">#{{item.id}}</p>
            <h5 class="mb-1 w-100">Cliente: {{item.cliente}}</h5>
            <p class="mb-1 w-100">
              <small>
                <b-icon icon="house-door"></b-icon>
                {{item.direccion}}
              </small>
              <small>
                <b-icon icon="phone"></b-icon>987 654 123
              </small>
            </p>
            <div>
              <div class="w-100" size="sm">
                <b-button size="sm" v-b-toggle="`${index}`" variant="outline-primary">Detalle</b-button>
                <b-button size="sm" variant="danger">Cancelar</b-button>
                <b-button size="sm" variant="success">Repartidor</b-button>
              </div>
            </div>

            <b-collapse class="border-0 w-100" :id="`${index}`">
              <b-card class="border-0 py-0">
                <p class="w-100 my-0">Productos</p>
                <b-list-group class="w-100 ">
                  <b-list-group-item class="p-1 border-0 " v-for="(pro, index) in item.productos" :key="index">
                    {{pro.nombre}}
                    </b-list-group-item>
                </b-list-group>
              </b-card>
            </b-collapse>
          </b-card>
        </b-col>
      </b-row>
   
  </section>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      pendientes: [],
    };
  },
  computed: {
    ...mapState(["_pedidos"]),
  },
  created() {
    this.ObtenerPedidos();
    this.filtrarPedidos();
  },
  methods: {
    ...mapActions(["ObtenerPedidos"]),
    filtrarPedidos() {
      setTimeout(() => {
        for (let pedido of this._pedidos) {
          if (pedido.ped_estado === "Pendiente") {
            if (this.pendientes.some((item) => item.id === pedido.ped_id)) {
              const index = this.pendientes.findIndex(
                (item) => item.id === pedido.ped_id
              );
              this.pendientes[index].productos.push({
                nombre: pedido.pro_nombre,
                cantidad: pedido.det_cantidad,
                total: pedido.det_total,
              });

              this.pendientes[index].total_pedido =
                parseFloat(this.pendientes[index].total_pedido) +
                parseFloat(pedido.det_total);
            } else {
              this.pendientes.push({
                id: pedido.ped_id,
                cliente: pedido.cli_nombre,
                entrada: pedido.ped_entrada,
                direccion: pedido.ped_direccion,
                refererencia: pedido.ped_referencia,
                estado: pedido.ped_estado,
                total_pedido: pedido.det_total,
                productos: [
                  {
                    nombre: pedido.pro_nombre,
                    cantidad: pedido.det_cantidad,
                    total: pedido.det_total,
                  },
                ],
              });
            }
          }
        }
      }, 2000);
    },
  },
};
</script>

<style lang="scss" scoped>
.card-body {
  padding: 10px;
  position: relative;
  display: flex;
  flex-wrap: wrap;
  .ped_estado {
    position: absolute;
    right: 5px;
    margin: 0px;
    top: 5px;
  }
}
</style>