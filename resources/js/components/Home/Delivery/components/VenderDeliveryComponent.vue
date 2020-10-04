<template>
  <section>
    <h4>Vender</h4>
    <b-row>
      <b-col md="8">
        <b-input-group size="sm">
          <b-input-group-append>
            <b-button variant="info" disabled>
              <b-icon icon="search"></b-icon>
            </b-button>
          </b-input-group-append>
          <b-form-input
            v-model="busqueda"
            type="text"
            id="filterInput"
            placeholder="Buscar cliente"
          ></b-form-input>
        </b-input-group>
      </b-col>
      <b-col md="4">
        <b-button v-b-modal.modal-regCli block size="sm">Nuevo Cliente</b-button>
        <cliente-modal id="modal-regCli" datos="null" tipo="Nuevo"></cliente-modal>
      </b-col>
    </b-row>

    <b-list-group class="lista_Clientes my-3">
      <b-list-group-item
        class="d-flex justify-content-between align-items-center"
        v-for="(item,index) in filteredList"
        :key="index"
      >
        {{item.cli_nombre}} - {{item.cli_celular}}
        <b-button variant="info" size="sm" @click="Atender(item)">Atender</b-button>
      </b-list-group-item>
    </b-list-group>

    <div class="Pedido">
      <template v-if="show">
        <pedidos-formulario :datos="cliente"></pedidos-formulario>
      </template>
    </div>
  </section>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      busqueda: "",
      show:false,
      cliente:null,
    };
  },
  methods: {
    ...mapActions(["ObtenerEmpresa", "ObtenerClientes"]),
    Atender(item) {
        this.show = true;
        this.cliente = item;
    },
  },
  created() {
    this.ObtenerEmpresa();
    this.ObtenerClientes();
  },
  computed: {
    ...mapState(["_clientes"]),
    filteredList() {
      return this._clientes.filter((post) => {
        return post.cli_celular.includes(this.busqueda);
      });
    },
  },
};
</script>

<style lang="scss">
.lista_Clientes {
  max-height: 100px;
  overflow-y: scroll;
  border-bottom: 2px solid #555;
  &::-webkit-scrollbar {
    width: 8px; /* Tamaño del scroll en vertical */
    height: 8px; /* Tamaño del scroll en horizontal */
    display: block; /* Ocultar scroll */
  }
  &::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
  }
  &::-webkit-scrollbar-thumb:hover {
    background: #b3b3b3;
    box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.2);
  }
  &::-webkit-scrollbar-thumb:active {
    background-color: #999999;
  }
}
</style>