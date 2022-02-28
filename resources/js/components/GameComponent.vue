<template>
    <div class="gameContent">
        <canvas class="game-canvas" id="c"></canvas>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                c: "",
                ctx: "",
                vueCanvas: "",
                x: 2,
                y: 1,
                heroShowCutWidth: 32,
                heroShowCutHeight: 32,
                heroShowCoorImageX: 0,
                heroShowCoorImageY: 0,
                hero: null
            }
        },
        mounted(){
            this.c = document.getElementById("c");
            this.ctx = this.c.getContext("2d");    
            this.vueCanvas = this.ctx;
            document.addEventListener("keydown", this.keyDown1)
            document.addEventListener("keyup", this.keyUp1)
        },
        methods:{
            init(){
                const image = new window.Image();
                image.src = "/images/maps/scene0.gif";
                image.onload = () =>{
                    this.ctx.drawImage(image,0,0)
                };

                const npc = new Image();
                npc.src = "/images/heroes/npc1.png";
                npc.onload = () =>{
                    this.ctx.drawImage(
                        npc, 
                        0, //left cut 
                        0, //top cut
                        32, //width of cut
                        32, //height of cut
                        14 * 16, //x position
                        1 * 16, //y position
                        48, //size in x
                        48 //size in y
                    )
                };
                
                this.heroMovement();
            },
            keyDown1(e){
                let k = event.code
                if(e.key == "ArrowLeft"){
                    if(this.x-1 > -2){
                        this.x = this.x-1;
                    }else{
                        this.x = -1;
                    }
                    
                    this.heroShowCoorImageX;
                    this.heroShowCoorImageY = 32 * 3;
                }

                if(e.key == "ArrowRight"){
                    if(this.x+1 < 17){
                        this.x = this.x+1;
                    }else{
                        this.x = 16;
                    }
                    this.x = this.x+1;
                    this.heroShowCoorImageX;
                    this.heroShowCoorImageY = 32 * 1;
                }

                if(e.key == "ArrowUp"){
                    if(this.y-1 > -3){
                        this.y = this.y-1;
                    }else{
                        this.y = -2
                    }
                    this.heroShowCoorImageX;
                    this.heroShowCoorImageY = 32 * 2;
                }

                if(e.key == "ArrowDown"){
                    if(this.y+1 <= 7){
                        this.y = this.y+1;
                    }else{
                        this.y = 7
                    }
                    //this.y = this.y+1;
                    this.heroShowCoorImageX;
                    this.heroShowCoorImageY = 32 * 0;
                }

                if(e.key == "Escape"){
                    this.$root.consola = true;
                }
                this.init();

                
            },
            keyUp1(e){
                
            },
            heroMovement(){
                this.hero = new Image();
                this.hero.src = "/images/heroes/erio.png";
                this.hero.onload = () =>{
                    this.ctx.drawImage(
                        this.hero, 
                        this.heroShowCoorImageX, //left cut 
                        this.heroShowCoorImageY, //top cut
                        this.heroShowCutWidth, //width of cut
                        this.heroShowCutHeight, //height of cut
                        this.x * 16,
                        this.y * 16,
                        48, //size in x
                        48 //size in y
                    )
                }
                
            }
        },
        created(){
            this.init();
            this.heroMovement();
        },
        beforeDestroy() {
            //window.removeEventListener('keypress', this.onKeyPress);
        },
    }

</script>

<style scoped>
.game-canvas{
    width: 340px;
    height: 192px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    transform: scale(1) translateY(50%);
}

.game-canvas canvas{
    image-rendering: pixelated;
}
</style>