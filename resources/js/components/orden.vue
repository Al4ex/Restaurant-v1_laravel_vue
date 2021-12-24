<template>
  <div class="container">
        <br>
        <div class="row">

      <div class="col-md-8 order-md-1">

        <h4 class="mb-3">Orden</h4>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Orden</th>
              <th scope="col">Total</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody v-for="(data, i) in listOrder" :key="i">
              <tr style="background-color: #cecece; ">

                <td>{{data.ord_id}}</td>
                <td><b>Mesa {{data.ord_mesa}}</b> - {{data.ord_fecha}}</td>
                <td>{{convertMoney(data.ord_valor)}} </td>
                <td>
                  <button type="button" class="btn btn-light"  v-on:click="data.show=!data.show">Detalles</button>
                </td>
              </tr>
                <tr v-for="(pedido, i) in data.pedidos" :key="i" v-show="data.show">
                    <td>{{i+1}}</td>
                    <td>{{pedido.prod_name}}</td>
                    <td>{{pedido.ped_cantidad}}</td>
                    <td>{{pedido.ped_valor}}</td>
                </tr>
              <!-- Detalles del orden -->
                <div>

                </div>
          </tbody>
        </table>

      </div>


    </div>


  </div> <!-- /container -->
</template>
<script>
    export default {
        data(){
          return{
            listOrder:[]
          }
        },
        mounted() {
            this.listOrderService()
        },
        methods:{
        convertMoney(value){

          const formatterPeso = new Intl.NumberFormat('en-US', {
             style: 'currency',
             currency: 'USD',
             minimumFractionDigits: 0
           })
           let valueFinal = formatterPeso.format(value);


           return valueFinal

        },
          listOrderService()
          {
            axios.get("api/Orden/list")
            .then(response=>{
              // cargar datos
              this.listOrder = response.data
            })
            .catch(error=>{
              alert(error)
            })

          },
        }
    }

</script>
