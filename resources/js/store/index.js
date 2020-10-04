export default ({
    state: {
        _empresa: null,
        _categorias: [],
        _productos: [],
        _roles: [],
        _usuarios: [],
        _opcion: 'vender',
        _clientes: [],
        _pedidos:[],

    },
    mutations: {
        llenarCategorias(state, data) {
            state._categorias = data;
        },
        llenarEmpresa(state, data) {
            state._empresa = data;
        },
        llenarProductos(state, data) {
            state._productos = data;
        },
        llenarRoles(state, data) {
            state._roles = data;
        },
        llenarUsuarios(state, data) {
            state._usuarios = data;
        },
        llenarClientes(state, data){
            state._clientes = data;
        },
        llenarPedido(state, data){
            state._pedidos = data;
        },
        cambiarOpcion(state, data) {
            state._opcion = data;
        },
        
    },
    actions: {
        ObtenerEmpresa({commit}) {
            axios
                .get("/empresa")
                .then((res) => {
                    commit('llenarEmpresa', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },
        ObtenerCategorias({commit}) {
            axios
                .get("/categoria")
                .then((res) => {
                    commit('llenarCategorias', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },
        ObtenerProductos({commit}) {
            axios
                .get("/producto")
                .then((res) => {
                    commit('llenarProductos', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },
        ObtenerRoles({commit}) {
            axios
                .get("/rol")
                .then((res) => {
                    commit('llenarRoles', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },

        ObtenerUsuarios({commit}) {
            axios
                .get("/usuario")
                .then((res) => {
                    commit('llenarUsuarios', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },
        ObtenerClientes({commit}){
            axios
                .get("/cliente")
                .then((res) => {
                    commit('llenarClientes', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },

        ObtenerPedidos({commit}){
            axios
                .get("/pedido")
                .then((res) => {
                    commit('llenarPedido', res.data)
                })
                .catch((e) => {
                    console.log("Error :C =>", e);
                });
        },
        IrA({commit}, opcion) {

            commit('cambiarOpcion', opcion)
        }

    },
    modules: {}
})
