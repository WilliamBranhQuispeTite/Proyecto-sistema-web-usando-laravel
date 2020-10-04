<template>
  <b-modal :id="id" hide-footer>
    <template v-slot:modal-title>{{tipo}}</template>

    <b-form @submit.prevent="Registrar">
      <h6>Datos Personales</h6>
      <b-row>
        <b-col class="mb-3" md="12">
          <b-form-input
            value="Denis Lino"
            v-model="form.nombre"
            required
            placeholder="Nombre completo"
          ></b-form-input>
        </b-col>
        <b-col class="mb-3" md="6">
          <b-form-input
            value="71822317"
            v-model="form.dni"
            required
            placeholder="Ingrese su numero de DNI"
          ></b-form-input>
        </b-col>
        <b-col class="mb-3" md="6">
          <b-form-input
            value="951208106"
            v-model="form.numero"
            required
            placeholder="Numero de celular"
          ></b-form-input>
        </b-col>
      </b-row>
      <h6>Datos de Usuario</h6>
      <b-row>
        <b-col class="mb-3" md="12" v-if="tipo == 'Nueva'">
          <b-form-input
            value="lino@g.com"
            type="email"
            v-model="form.email"
            required
            placeholder="Correo"
          ></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12" v-if="tipo == 'Nueva'">
          <b-form-input
            value="12345678"
            type="password"
            v-model="form.password"
            required
            placeholder="Contraseña"
          ></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-select
            v-model="form.rol"
            :options="_roles"
            value-field="rol_id"
            text-field="rol_nombre"
            disabled-field="notEnabled"
          ></b-form-select>
        </b-col>

        <template v-if="tipo=='Nueva'">
          <b-button class="mx-3" variant="primary" block type="submit">Agregar</b-button>
        </template>
        <template v-else>
          <b-button @click="editarUsu" class="mx-3" variant="warning" block type="button">Editar</b-button>
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
        numero: "",
        dni: "",
        email: "",
        password: "",
        empresa: "",
        rol: "",
      },
    };
  },
  computed: {
    ...mapState(["_empresa", "_roles"]),
  },
  watch: {
    _empresa() {
      return (this.form.empresa = this._empresa.emp_id);
    },
    datos() {
      this.form.nombre = this.datos.adm_nombre;
      this.form.numero = this.datos.adm_celular;
      this.form.dni = this.datos.adm_dni;
      this.form.email = this.datos.email;
      this.form.rol = this.datos.rol_id;
      this.form.password = this.datos.usu_id;
      return this.form;
    },
  },
  created() {},
  methods: {
    ...mapActions(["ObtenerUsuarios"]),
    Registrar() {
      axios
        .post("/usuario", this.form)
        .then((res) => {
          this.ObtenerUsuarios();
          this.$bvModal.hide(this.id);
          this.mensaje('success','Usuario añadido con exito','Exito!');
        })
        .catch((e) => {
          //this.mensaje('danger','No se pudo añadir al usuario','Error inesperado!');
          console.log("Error :C =>", e.data);
        });
    },
    editarUsu() {
      var url = "/usuario/" + this.datos.adm_id;
      axios
        .put(url, this.form)
        .then((res) => {
          this.ObtenerUsuarios();
          this.$bvModal.hide(this.id);
        })
        .catch((e) => {
          console.log("Error :C =>", e.data);
        });
    },

    mensaje(tipo,mensaje,titulo) {
        this.$bvToast.toast(mensaje, {
          title: titulo,
          variant: tipo,
          solid: true
        })
      }
  },
};
</script>
