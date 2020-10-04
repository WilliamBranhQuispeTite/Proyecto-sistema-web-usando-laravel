<template>
  <b-modal :id="id" scrollable title="Agregar Categoria" hide-footer>

    <b-form @submit.prevent="Registrar" >
      <input ref="uploadFormToken" type="hidden" name="_token" value="">
      <b-row>
        <b-col class="mb-3" md="12">
          <b-form-select
            v-model="form.categoria"
            :options="_categorias"
            class="mb-3"
            value-field="cat_id"
            text-field="cat_nombre"
            disabled-field="notEnabled"
     
          ></b-form-select>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.nombre" required placeholder="Nombre del Producto"></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.descripcion" required placeholder="Descripcion"></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.stock" required placeholder="Stock"></b-form-input>
        </b-col>

        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.precio" required placeholder="Precio"></b-form-input>
        </b-col>
        <b-col class="mb-3" md="12">
          <b-form-input v-model="form.promo" required placeholder="Promo"></b-form-input>
        </b-col>
        
        
      </b-row>
      <b-row class="mb-2">
        <input type="file" name="d" id="img" @change="preCargarImg" hidden accept="image/*" />
        <b-col sm="12" lg="12" md="12">
          <label class="pre-imagen" for="img">
            <b-icon
              v-if="form.imagen == null"
              icon="image"
              font-scale="3"  
              v-b-tooltip.hover
              title="Selecionar imagen"
            ></b-icon>
            <p v-if="form.imagen == null" class="w-100">Selecionar Imagen</p>
            <img v-if="form.imagen != null" :src="preimg" alt width="100%" />
          </label>
        </b-col>
      </b-row>
      <template v-if="tipo=='Nuevo'">
          <b-button  variant="primary" block type="submit">Agregar</b-button>
        </template>
        <template v-else>
          <b-button  @click="editarPro" variant="warning" block type="button">Editar</b-button>
        </template>
      
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
        descripcion: "",
        stock: "",
        categoria: "",
        precio: "",
        promo: "",
        imagen: "",
      },
      preimg: null,
    };
  },
  computed: {
    ...mapState(["_categorias"]),
  },
  watch: {
    datos(){
      this.form.nombre = this.datos.pro_nombre;
      this.form.descripcion = this.datos.pro_descripcion;
      this.form.stock = this.datos.pro_stock;
      this.form.categoria = this.datos.cat_id;
      this.form.precio = this.datos.pro_precio;
      this.form.promo = this.datos.pro_promo;
      this.form.imagen = this.datos.pro_imagen;
      this.preimg =this.datos.pro_imagen;
      return this.form;
    },
  },

  mounted() {
    //this.$refs.uploadFormToken.value = csrfToken;
  },
  methods: {
    ...mapActions(['ObtenerProductos']),
    preCargarImg(e) {
      this.form.imagen = e.target.files[0];
      if (this.form.imagen) {
        this.preimg = URL.createObjectURL(this.form.imagen);
      } else {
        console.log('No se seleciono una imagen');
      }
    },
    Registrar() {
      let data  = new FormData();
      data.append('nombre', this.form.nombre)
      data.append('descripcion', this.form.descripcion)
      data.append('stock', this.form.stock)
      data.append('precio', this.form.precio)
      data.append('promo', this.form.promo)
      data.append('categoria', this.form.categoria)
      data.append('imagen', this.form.imagen)
    
     axios
        .post("/producto", data)
        .then((res) => {
          console.log(res);
          this.ObtenerProductos();
          this.$bvModal.hide(this.id);
        })
        .catch((e) => {
          console.log("Error :C =>", e);
        });
    },
    editarPro(){
      alert('Aun  no implementado');
      /*var url = "/categoria/" + this.datos.cat_id;

      axios.put(url, this.form).then((res) => {
        this.ObtenerCategorias();

      });*/
    }
  },
};
</script>

<style>
.pre-imagen {
  overflow: hidden;
  text-align: center;
  background: #efefef;
  width: 60%;
  display: flex;
  justify-content: center;
  box-sizing: border-box;
  flex-wrap: wrap;
  margin: auto;
  min-height: 180px;
  max-height: 200px;
  align-content: center;
  border: 1px dashed #777;
  border-radius: 10px;
}
</style>