<template>
  <div>
      <!-- imagePath="https://scaleflex.cloudimg.io/width/600/q35/https://scaleflex.ultrafast.io/https://scaleflex.airstore.io/demo/chair-360-36" -->
      
    <vue-three-sixty 
        :amount=35
        imagePath="images/tetera"
        fileName="tetera_{index}.jpg"
        :autoplay="35"
        loop=2
        buttonClass="dark"
        />
  </div>
</template>

<script>

  export default {
    data () {
      return {
        
      }
    },
    mounted () {
      
    },
    created (){
      
    },
    methods: {
     
    }
  }
</script>