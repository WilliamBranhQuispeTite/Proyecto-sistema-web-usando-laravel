<template>
  <b-modal :id="id" title="BootstrapVue" hide-footer>
    <template v-slot:modal-title>{{tipo}} Cliente</template>
    <b-form @submit.prevent="Registrar">
      <h6>Datos Personales</h6>
      <b-row>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.nombre" required placeholder="Nombre completo"></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.numero" required placeholder="Numero de celular"></b-form-input>
        </b-col>
      </b-row>

      <b-row>
        <template v-if="tipo=='Nuevo'">
          <b-button class="mx-3" variant="primary" block type="submit">Agregar</b-button>
        </template>
        <template v-else>
          <b-button class="mx-3" variant="warning" block type="button">Editar</b-button>
        </template>
       
      </b-row>
    </b-form>
  </b-modal>
</template>

<script>
import { mapState, mapActions } from "vuex";
export default {
  props: ["id", "datos", "tipo"],
  data() {
    return {
      form: {
        nombre: "",
        numero: "",
        empresa: "",
      },
    };
  },
  computed: {
    ...mapState(["_empresa"]),
  },
  watch: {
    _empresa() {
      return (this.form.empresa = this._empresa.emp_id);
    },
  },
  methods: {
    ...mapActions(['ObtenerClientes']),
    Registrar() {
      axios
        .post("/cliente", this.form)
        .then((res) => {
          this.$bvModal.hide(this.id);
          this.mensaje("success", "cliente añadido con extito", "Exito!");
          this.ObtenerClientes();
        })
        .catch((e) => {
          console.log("Error :C =>", e.data);
        });
    },
    mensaje(tipo, mensaje, titulo) {
      this.$bvToast.toast(mensaje, {
        title: titulo,
        variant: tipo,
        solid: true,
      });
    },
  },
};
</script>

<style>
</style>