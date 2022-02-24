<template>
  <div>
    <line-chart :chart-data="datacollection"></line-chart>
  </div>
</template>

<script>
  import LineChart from './LineChart.js'

  export default {
    components: {
      LineChart
    },
    data () {
      return {
        datacollection: null,
        dataResources: [],
        increment: 1,
      }
    },
    mounted () {
      
    },
    created (){
      setInterval(() => this.fillData(), 1000);
      
    },
    methods: {
      fillData () {
          this.increment = this.increment + 1;
          // axios.get('api/get_resources')
          // .then(res =>{
          //     this.dataResources.push(res.data);
          // });
        this.datacollection = {
          labels: [this.increment, (this.increment + 1), (this.increment + 2), (this.increment + 3)],
          datasets: [
            {
              label: 'CPU',
              backgroundColor: '#4c5c60',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
            }, {
              label: 'RAM',
              backgroundColor: '#a9ced0',
              data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
            }
          ]
        }
        
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>