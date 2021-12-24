<template>
    <div class="container">
        <br />
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Food and Drink</h4>

                <div class="btn-group mr-2">
                    <button
                    type="button"
                    class="btn btn-light"
                    v-on:click="selectCategoria=0">Todos</button>
                </div>
                <div class="btn-group mr-2"
                    v-for="(cat, index) in listCat"
                    :key="index" role="group" aria-label="Third group">
                    <button
                    type="button"
                    class="btn btn-light"

                    v-on:click="selectCategoria=cat.cat_id">
                    {{ cat.cat_nombre }}</button>
                </div>

                <hr />

                <div class="row">
                    <div
                        class="card col-md-4"
                        v-show="
                            prod.prod_categoria == selectCategoria ||
                            selectCategoria == 0
                        "
                        style="padding: 0px"
                        v-for="(prod, i) in listProd"
                        :key="i"
                    >
                        <img
                            class="card-img-top"
                            :src="prod.prod_image"
                            alt="Card image cap"
                        />
                        <div class="card-body">
                            <h5 class="card-title">{{ prod.prod_name }}</h5>
                            <p class="card-text">{{ prod.prod_description }}</p>

                            <a href="#" class="btn btn-primary" v-on:click="addCart(prod)">{{convertMoney(prod.prod_price)}}</a>
                        </div>
                    </div>
                </div>

                <!-- <div class="card" style="width: 18rem">
                    <img
                        class="card-img-top"
                        src="https://irecetasfaciles.com/wp-content/uploads/2018/05/Hamburguesa-cl%C3%A1sica-estilo-Whopper-de-Burger-King.jpg"
                        alt="Card image cap"
                    />
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            Some quick example text to build on the card title
                            and make up the bulk of the card's content.
                        </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div> -->
            </div>
            <div class="col-md-4 order-md-1 mb-4">
                <h4
                    class="
                        d-flex
                        justify-content-between
                        align-items-center
                        mb-3
                    "
                >
                    <span class="text-muted">Carrito</span>
                    <span class="badge badge-secondary badge-pill">{{
                        listCarrito.length
                    }}</span>
                </h4>
                <ul class="list-group mb-3">
                    <li
                        class="
                            list-group-item
                            d-flex
                            justify-content-between
                            lh-condensed
                        "
                    >
                        <div>
                            <h6 class="my-0">Producto</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">{{ listCarrito.lentgh }}</span>
                    </li>
                    <li
                        v-for="(itemcart, i) in listCarrito"
                        :key="i"
                        class="
                            list-group-item
                            d-flex
                            justify-content-between
                            lh-condensed
                        "
                    >
                        <div>
                            <h6 class="my-0">{{ itemcart.nombre }}</h6>
                            <small class="text-muted">{{
                                itemcart.categoria
                            }}</small>
                        </div>
                        <div>
                            <div class="he">
                                <i
                                    class="but material-icons"
                                    v-on:click="cambiarCantidad(i, false)"
                                    >remove_circle_outline</i>
                                <span class="text-muted">
                                    {{ itemcart.cant }}</span
                                >
                                <i
                                    class="but material-icons"
                                    v-on:click="cambiarCantidad(i, true)"
                                    >add_circle_outline</i
                                >
                            </div>
                            <span class="text-muted">
                                {{
                                    convertMoney(
                                        itemcart.cant * itemcart.precio
                                    )
                                }}</span
                            >
                        </div>

                        <i class="material-icons" v-on:click="deleteItem(i)"
                            >delete</i
                        >
                    </li>
                    <li class="list-group-item d-flex justify-content-between">

                        <select class="form-control" id="exampleFormControlSelect1" v-model="SelectMesa">
                            <option value="0">Seleccione una mesa</option>
                            <option value="1">Mesa 1</option>
                            <option value="2">Mesa 2</option>
                            <option value="3">Mesa 3</option>
                            <option value="4">Mesa 4</option>
                            <option value="5">Mesa 5</option>
                        </select>

                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (PESOS)</span>
                        <strong> {{ onViewTotal() }}</strong>

                    </li>
                    <button type="button" class="btn btn-success btn-lg btn-block" v-on:click="onSendOrder()">PROCESAR PEDIDO</button>
                </ul>
            </div>


        </div>
    </div>
    <!-- /container -->
</template>

<script>
export default {

    data() {
        return {
            listCat: [],
            listProd: [],
            listCarrito:[],
            selectCategoria: 0,
            SelectMesa:0
        };
    },
    mounted() {
        this.listCatService();
        this.listProdService();
    },
    methods: {
        onSendOrder()
          {

            if (this.listCarrito.length>=1) {
                if(this.SelectMesa != 0){
                    // sumar todal de los productos
                    let total = 0
                    this.listCarrito.map((data)=>{
                        total = total + (data.cant * data.precio)
                    })

                    const formData = new FormData()
                    formData.append('pedidos',JSON.stringify(this.listCarrito))
                    formData.append('mesa',this.SelectMesa)
                    formData.append('total',total)

                    axios.post("api/Orden/create",formData)
                    .then(response => {
                        // limpiar campo

                        // alert("Enviado exitosamente");

                        this.$swal.fire(
                          'Enviado exitosamente!',
                          'Se envio los ordenó exitosamente',
                          'success'
                        )

                        this.listCarrito = []
                        this.SelectMesa = 0

                    })
                    .catch(error => {
                        alert(error)
                    })
                }else{
                    this.$swal.fire(
                          'Hubo un error!',
                          'Seleccione una mesa',
                          'error'
                        )

                }
            }


          },
        listProdService() {
            axios
                .get("api/Producto/visible")
                .then((response) => {
                    // cargar datos
                    this.listProd = response.data;
                })
                .catch((error) => {
                    alert(error);
                });
        },
        listCatService() {
            axios
                .get("api/Categoria/disponible")
                .then((response) => {
                    // cargar datos
                    this.listCat = response.data;
                })
                .catch((error) => {
                    alert(error);
                });
        },
        convertMoney(value){

          const formatterPeso = new Intl.NumberFormat('en-US', {
             style: 'currency',
             currency: 'USD',
             minimumFractionDigits: 0
           })
           let valueFinal = formatterPeso.format(value);


           return valueFinal

        },
        addCart(item){
            //this.listCarrito.push(item)

            const itemcar = {
              id : item.prod_id,
              nombre : item.prod_name,
              categoria: item.cat_nombre,
              cant: 1,
              precio: item.prod_price
            }

            this.listCarrito.push(itemcar)
            //alert(JSON.stringify(item))
        },
        deleteItem(i){ this.listCarrito.splice(i,1) },
        cambiarCantidad(i,type){

              // sacar variable de carrito
              const dataCar = this.listCarrito

              // sacar la cantidad de producto
              let cantd = dataCar[i].cant;

              if (type) {
                cantd = cantd + 1
              }
              else if (type==false&&cantd>=1) {
                cantd = cantd - 1
              }

              if ((type==false&&cantd>=1)||type) {
                dataCar[i].cant = cantd
                this.listCarrito
              }


          },
          onViewTotal(){
            let total = 0
            this.listCarrito.map((data)=>{
              total = total + (data.cant * data.precio)
            })

            return this.convertMoney(total)
          }
    },
};
</script>
