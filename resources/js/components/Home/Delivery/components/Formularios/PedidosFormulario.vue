<template>
  <b-form @submit.prevent="Registrar">
    <b-row class="datos_cliente">
      <h6>Datos del Cliente {{form.cliente}}</h6>
      <b-col class="mb-3" md="12">
        <b-form-input v-model="form.nombre" required size="sm" disabled></b-form-input>
      </b-col>
    </b-row>
    <b-row class="via_entrada">
      <h6>Via de entrada {{form.entrada}}</h6>
      <b-col class="mb-1" md="12">
        <b-form-radio-group
          id="entrada"
          v-model="form.entrada"
          :options="entrdas"
          buttons
          button-variant="outline-info"
          size="sm"
        ></b-form-radio-group>
      </b-col>
    </b-row>

    <b-row class="direccion">
      <h6>Direccoin de envio</h6>

      <b-col class="mb-2" md="12">
        <b-form-input v-model="form.direccion" size="sm" placeholder="Direccion"></b-form-input>
      </b-col>
      <b-col class="mb-2" md="12">
        <b-form-textarea v-model="form.referencia" size="sm" placeholder="Referencia"></b-form-textarea>
      </b-col>
    </b-row>
    <b-row class="productos">
      <h6>Productos</h6>
      <b-col class="mb-2" md="12">
        <b-list-group>
          <b-list-group-item
            v-for="(item,index) in form.detalle"
            :key="index"
            class="d-flex justify-content-between align-items-center border-0 mb-2 w-100 shadow-sm"
          >
            <b-form-spinbutton
              @change="cambiarCantidad($event,item,index)"
              size="sm"
              id="sb-inline"
              :value="item.cantida"
              inline
            ></b-form-spinbutton>
            {{item.pro_nombre}}
            <strong>S/. {{item.total}}</strong>
            <b-badge variant="danger">
              <b-icon icon="x"></b-icon>
            </b-badge>
          </b-list-group-item>
        </b-list-group>
      </b-col>
      <b-col class="mb-2" md="12">
        <b-button v-b-modal.modal-lg variant="primary">Elejir productos</b-button>
      </b-col>

      <b-modal id="modal-lg" size="xl" title="Selecionar Productos" hide-footer>
        <b-row>
          <b-col v-for="(item,index) in _productos" :key="index" md="6" xl="4" sm="12">
            <b-media right-align>
              <template v-slot:aside>
                <b-img width="55" height="55" alt="placeholder" :src="item.pro_imagen"></b-img>
              </template>

              <h5 class="mt-0">{{item.pro_nombre}}</h5>
              <p>
                Precio
                <b-badge variant="info">S/. {{item.pro_precio}}</b-badge>
                <b-input type="number" :id="`${item.pro_id}`" size="sm" value="1"></b-input>
                <b-button @click="agregarProducto(item,index)" size="sm">Agregar Al Carrito</b-button>
              </p>
            </b-media>
          </b-col>
        </b-row>
      </b-modal>
    </b-row>

    <b-row>
      <template>
        <b-button class="mx-3" variant="primary" block type="submit">Agregar</b-button>
      </template>
    </b-row>
  </b-form>
</template>

<script>
import { mapActions, mapState } from "vuex";
export default {
  props: ["datos"],
  data() {
    return {
      entrdas: [
        { text: "Llamada", value: "Llamada" },
        { text: "Whatsapp", value: "Whatsapp" },
        { text: "Mensaje", value: "Mensaje" },
        { text: "Web", value: "Web", disabled: true },
      ],
      form: {
        cliente: "",
        nombre: "",
        entrada: "Llamada",
        direccion: "",
        referencia: "",
        detalle: [],
      },
      cant: 1,
    };
  },
  computed: {
    ...mapState(["_productos"]),
  },
  watch: {
    datos() {
      this.form.cliente = this.datos.cli_id;
      this.form.nombre = this.datos.cli_nombre;
      return this.form;
    },
  },
  created() {
    this.ObtenerProductos();
    this.form.cliente = this.datos.cli_id;
    this.form.nombre = this.datos.cli_nombre;
  },
  methods: {
    ...mapActions(["ObtenerProductos"]),

    cambiarCantidad(e, item, index) {
      console.log(e);
      this.form.detalle[index].cantida = parseInt(e);
      this.form.detalle[index].total = parseFloat(item.precio * e);
    },
    agregarProducto(producto, index) {
      let cant = $(`#${producto.pro_id}`).val();
      if (
        this.form.detalle.some(
          (item) => item.pro === producto.pro_id && item.cantida != cant
        )
      ) {
        this.form.detalle[index].cantida = parseInt(cant);
        this.form.detalle[index].total = parseFloat(producto.pro_precio * cant);
      } else if (
        !this.form.detalle.some((item) => item.pro === producto.pro_id)
      ) {
        this.form.detalle.push({
          pro: producto.pro_id,
          pro_nombre: producto.pro_nombre,
          precio: parseFloat(producto.pro_precio),
          total: parseFloat(producto.pro_precio * cant),
          cantida: parseInt(cant),
        });
      }
    },
    // Enviar dato a la base de datos
    Registrar() {
      axios
        .post("/pedido", this.form)
        .then((res) => {
          console.log(res);
          //this.$bvModal.hide(this.id);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.datos_cliente,
.via_entrada,
.direccion,
.productos {
  background: #eee;
  padding: 10px;
  box-shadow: 0px 0px 2px 1px rgba(233, 233, 233, 0.7);
  margin: 10px 0px;
  border-radius: 10px;
}
</style>