<template>
  <section>
    <h4>ARTICULOS</h4>
    <div class="btn-add border p-2">
      <p class="ml-1 mb-1">Añadir</p>
      <b-button v-b-modal.modal-regCat size="sm" class="mr-2" variant="outline-primary" pill>
        Categoria
        <b-icon class="ml-2" icon="plus-square-fill" aria-hidden="true"></b-icon>
      </b-button>
      <b-button v-b-modal.modal-regPro size="sm" class="mr-2" variant="outline-primary" pill>
        Producto
        <b-icon class="ml-2" icon="plus-square-fill" aria-hidden="true"></b-icon>
      </b-button>
    </div>

    <modal-categoria-crear 
      id="modal-regCat"
      datos='null'
      tipo="Nueva"
      >
      </modal-categoria-crear>

    <modal-producto-crear 
      id="modal-regPro"
      datos='null'
      tipo="Nuevo"
     ></modal-producto-crear>

    <tabla-component
      class="t-cat shadow p-3 mt-3 rounded"
      :items="_categorias"
      :fields="headerCat"
      modal="cat"
    ></tabla-component>

    <tabla-component
      class="t-pro shadow p-3 mt-3 rounded"
      :items="_productos"
      :fields="headerPro"
      modal="pro"
    ></tabla-component>

  </section>
</template>

<script>
//falta relizar peticiones por AXIOS

import { mapActions, mapState } from 'vuex';
export default {

  data() {
    return {
      categorias: null,

      productos: null,

      headerPro: [
        {
          key: "pro_id",
          label: "ID",
          sortable: true,
          class: "text-center",
        },
        {
          key: "pro_nombre",
          label: "Nombre",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "pro_descripcion",
          label: "Descripcion",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "pro_stock",
          label: "Stock",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "pro_imagen",
          label: "Imagen",
        },
        { key: "actions", label: "Opciones" },
      ],
      headerCat: [
        {
          key: "cat_id",
          label: "ID",
          sortable: true,
          class: "text-center",
        },
        {
          key: "cat_nombre",
          label: "Nombre",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "cat_descripcion",
          label: "Descripcion",
          sortable: true,
          sortDirection: "desc",
        },

        { key: "actions", label: "Opciones" },
      ],
    };
  },
  
  computed: {
    ...mapState(['_categorias','_empresa','_productos']),
  },
  methods: {
    ...mapActions(['ObtenerCategorias','ObtenerEmpresa','ObtenerProductos']),

  },
  created() {
    
    this.ObtenerCategorias();
    this.ObtenerEmpresa();
    this.ObtenerProductos();

    console.log("categorias", this.categorias);
  },
};
</script>

<style lang="scss">
.t-pro {
  border-top: 3px solid #00f;
}
.t-cat {
  border-top: 3px solid rgb(50, 188, 230);
}
</style>