<template>
  <b-modal :id="id" hide-footer>
    <template v-slot:modal-title>{{tipo}}</template>

    <b-form @submit.prevent="Registrar">
      <b-row>
        <b-col class="mb-3" md="12">
          <b-form-input
            v-model="form.nombre"
            :value="nombre"
            required
            placeholder="Nombre de categoria"
          ></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input
            v-model="form.descripcion"
            :value="descripcion"
            required
            placeholder="Descripcion"
          ></b-form-input>
        </b-col>

        <template v-if="tipo=='Nueva'">
          <b-button class="mx-3" variant="primary" block type="submit">Agregar</b-button>
        </template>
        <template v-else>
          <b-button @click="editarCat" class="mx-3" variant="warning" block type="button">Editar</b-button>
        </template>
      </b-row>
    </b-form>
  </b-modal>
</template>
<script>
import { mapActions, mapState } from "vuex";
export default {
  props: ["id", "datos", "tipo"],
  data() {
    return {
      form: {
        nombre: "",
        descripcion: "",
        empresa: "",
      },
    };
  },
  computed: {
    ...mapState(["_empresa"]),

    nombre() {
      if (this.datos != "null") {
        return (this.form.nombre = this.datos.cat_nombre);
      }
    },
    descripcion() {
      if (this.datos != "null") {
        return (this.form.descripcion = this.datos.cat_descripcion);
      }
    },
  },
  watch: {
    _empresa() {
      return (this.form.empresa = this._empresa.emp_id);
    },
  },
  created() {},
  methods: {
    ...mapActions(["ObtenerCategorias"]),
    Registrar() {
      axios
        .post("/categoria", this.form)
        .then((res) => {
          this.ObtenerCategorias();
          this.$bvModal.hide(this.id);
        })
        .catch((e) => {
          console.log("Error :C =>", e);
        });
    },
    editarCat() {
      var url = "/categoria/" + this.datos.cat_id;
      //console.log(url);
      axios.put(url, this.form).then((res) => {
        this.ObtenerCategorias();
        this.$bvModal.hide(this.id);
      });
    },
  },
};
</script>
