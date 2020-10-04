<template>
  <section>
    <h4>USUARIOS</h4>
    <div class="btn-add border p-2">
      <p class="ml-1 mb-1">Añadir</p>
      <b-button v-b-modal.modal-regUsu size="sm" class="mr-2" variant="outline-primary" pill>
        Adminstador
        <b-icon class="ml-2" icon="plus-square-fill" aria-hidden="true"></b-icon>
      </b-button>
    </div>
    <modal-usuario id="modal-regUsu" datos="null" tipo="Nueva"></modal-usuario>

       <tabla-component
      class="t-cat shadow p-3 mt-3 rounded"
      :items="_usuarios"
      :fields="headerUsu"
      modal="usu"
    ></tabla-component>
  </section>
</template>

<script>

import { mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      headerUsu: [
        {
          key: "adm_id",
          label: "ID",
          sortable: true,
          class: "text-center",
        },
        {
          key: "adm_nombre",
          label: "Nombre",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "adm_dni",
          label: "DNI",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "adm_celular",
          label: "Celular",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "email",
          label: "Correo",
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "rol_id",
          label: "Rol",
          sortable: true,
          sortDirection: "desc",
        },

        { key: "actions", label: "Opciones" },
      ],
    };
  },

  computed: {
    ...mapState(["_empresa", "_roles",'_usuarios']),
  },
  methods: {
    ...mapActions(["ObtenerEmpresa", "ObtenerRoles",'ObtenerUsuarios']),
  },
  created() {
    this.ObtenerEmpresa();
    this.ObtenerRoles();
    this.ObtenerUsuarios();
  },
};
</script>

<style lang="scss">
.t-pro {
  border-top: 3px solid rgb(33, 156, 8);
}
</style>