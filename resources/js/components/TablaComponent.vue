<template>
  <div>
    <!-- User Interface controls -->
    <b-row class="d-flex justify-content-between">
      <b-col sm="3" md="3" class="my-1">
        <b-form-select v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select>
      </b-col>
      <b-col md="6" class="my-1">
        <b-input-group size="sm">
          <b-input-group-append>
            <b-button variant="info">
              <b-icon icon="search"></b-icon>
            </b-button>
          </b-input-group-append>
          <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Buscar"></b-form-input>
          <b-input-group-append>
            <b-button variant="danger" :disabled="!filter" @click="filter = ''">
              <b-icon icon="backspace"></b-icon>
            </b-button>
          </b-input-group-append>
        </b-input-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      small
      stacked="md"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
    >
      <template v-slot:cell(pro_imagen)="data">
        <img width="50px" height="50px" :src="data.item.pro_imagen" alt />
      </template>

      <template v-slot:cell(actions)="row">
        <b-button
          size="sm"
          @click="info(row.item, row.index, $event.target)"
          class="mr-1"
          variant="info"
        >
          <b-icon icon="pen"></b-icon>
        </b-button>
        <b-button
          @click="modalComfirm(row.item, $event.target)"
          size="sm"
          class="mr-1"
          variant="danger"
        >
          <b-icon icon="trash"></b-icon>
        </b-button>
      </template>
    </b-table>

    <b-pagination
      v-model="currentPage"
      :total-rows="totalRows"
      :per-page="perPage"
      align="fill"
      size="sm"
      class="my-0 w-25"
      pills
    ></b-pagination>

    <!-- The modal -->

    <modal-categoria-crear
      v-if="modal=='cat'"
      :id="`${infoModal.id}_${modal}`"
      :datos="infoModal.content"
      tipo="Editar"
    ></modal-categoria-crear>

    <modal-producto-crear
      v-if="modal=='pro'"
      :id="`${infoModal.id}_${modal}`"
      :datos="infoModal.content"
      tipo="Editar"
    ></modal-producto-crear>

    <modal-usuario
      v-if="modal=='usu'"
      :id="`${infoModal.id}_${modal}`"
      :datos="infoModal.content"
      tipo="Editar"
    ></modal-usuario>

    <b-modal :id="`_${infoModal.id}`" size="sm" hide-footer hide-header>
      <h5>Seguro de eliminar :</h5>
      <h3 v-if="modal=='cat'">{{infoModal.content.cat_nombre}}</h3>

      <h3 v-if="modal=='pro'">{{infoModal.content.pro_nombre}}</h3>

      <h3 v-if="modal=='usu'">{{infoModal.content.adm_nombre}}</h3>

      <b-button @click="Eliminar()" class="my-3" block variant="danger">Seguro</b-button>
    </b-modal>
  </div>
</template>
<script>
import { mapActions } from 'vuex';
export default {
  props: ["items", "fields", "modal"],
  data() {
    return {
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15],
      filter: null,

      infoModal: {
        id: this.modal,
        title: "",
        content: "",
      },
    };
  },

  computed: {},
  mounted() {
    // Set the initial number of items
    this.totalRows = this.items.length;
  },
  methods: {
    ...mapActions(["ObtenerUsuarios"]),
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = item;
      this.$root.$emit(
        "bv::show::modal",
        this.infoModal.id + "_" + this.modal,
        button
      );

      console.log(this.modal);
    },
    resetInfoModal() {
      this.infoModal.title = "";
      this.infoModal.content = "";
    },
    modalComfirm(item, e) {
      this.infoModal.content = item;
      this.$root.$emit("bv::show::modal", `_${this.infoModal.id}`, e);
      console.log(this.modal);
    },

    Eliminar() {
      if (this.modal == "cat") {
        var url = "/categoria/" + this.infoModal.content.cat_id;
        console.log(url);
        axios.delete(url)
        .then((res) => {
          console.log(res);
          this.$bvModal.hide(`_${infoModal.id}`);
        });
      }
      else if (this.modal == "usu") {//PARA ELIMINAR USUARIO
        
        var url = "/usuario/" + this.infoModal.content.adm_id;
        console.log(url);
        axios.delete(url).then((res) => {
          console.log(res);
          this.ObtenerUsuarios();
  
          this.$bvModal.hide('_'+this.infoModal.id);
        });
      }
      else {
        console.log("aun no  hecho");
      }
    },
  },
};
</script>


