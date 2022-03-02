<template>
    <div class="gameContent" style="padding: 20px">

        <div class="row">
            <div class="col">
                <canvas class="game-canvas" id="c"></canvas>
            </div>

            <div class="col" style="background: url(https://cdn.wallpapersafari.com/41/30/KhfVCl.png); background-size: 100% 100%;" v-if="selectedEnemy.id > 0">
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="padding-top:30px">
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" :style="'width: '+currentEnemyHealth+'%'" aria-valuenow="100" aria-valuemin="0" :aria-valuemax="enemyHealth"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" :style="'width: '+currentHeroHealth+'%'" aria-valuenow="100" aria-valuemin="0" :aria-valuemax="heroHealth"></div>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col">
                        

                        <div class="enemyFrame" style="margin-top:30px">
                            <img :src="selectedEnemy.sprite">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="heroFrame">
                            <img :src="selectedFighter.sprite">
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-success" @click="hitEnemy()">
                            Hit
                        </button>
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <h2 class="text-white">Instructions</h2>
                <ul class="text-white listInstructions">
                    <li>Press Esc to leave</li>
                    <li>Press the arrows to move<br>
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        <i class="fa fa-arrow-up" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down" aria-hidden="true"></i>
                    </li>  
                </ul>
            </div>

            <div class="col text-center" v-if="startFight == true">
                <h1>Choose your fighter</h1>
                <div class="row fighters">
                    <div class="col-sm-3 fighter" v-for="(item, index) in fighters" :key="index" @click="selectFighter(item)" :class="selectedFighter.id==item.id ? 'fighterActive': ''">
                        <img :src="item.sprite">
                        <p class="fighterName">{{item.name}}</p>
                    </div>
                </div>
            </div>

            <div class="col text-center" v-if="selectedFighter.id">
                <h1>Choose an enemy</h1>
                <div class="row fighters">
                    <div class="col-sm-3 fighter" v-for="(item, index) in fighters" :key="index" @click="selectEnemy(item)" :class="selectedEnemy.id==item.id ? 'fighterActive': ''">
                        <img :src="item.sprite">
                        <p class="fighterName">{{item.name}}</p>
                    </div>
                </div>
            </div>

        </div>   


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
                hero: null,
                startFight: false,
                fighters:[],
                selectedFighter: {},
                selectedEnemy: {},
                heroHealth: 1000,
                enemyHealth: 1500,
                currentHeroHealth: 100,
                currentEnemyHealth: 100,
                heroDef: 100,
                enemyDef: 100,
                heroStrength: 123,
                enemyStrength: 140
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
                npc.src = "/images/heroes/hero_mini/huitzilopochtli_32.png";
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

                this.hero = new Image();
                this.hero.src = "/images/heroes/hero_mini/quetzalcoatl_32.png";
                this.hero.onload = () =>{
                    this.heroShowCoorImageX = 0;
                    this.heroShowCoorImageY = 0;
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
                    
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 3;
                }

                if(e.key == "ArrowRight"){
                    if(this.x+1 < 17){
                        this.x = this.x+1;
                    }else{
                        this.x = 16;
                    }
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 1;
                }

                if(e.key == "ArrowUp"){
                    if(this.y-1 > -3){
                        this.y = this.y-1;
                    }else{
                        this.y = -2
                    }
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 2;
                }

                if(e.key == "ArrowDown"){
                    if(this.y+1 <= 7){
                        this.y = this.y+1;
                    }else{
                        this.y = 7
                    }
                    //this.y = this.y+1;
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 0;
                }

                if(e.key == "Escape"){
                    this.$root.consola = true;
                }

                if(this.x == 13 && this.y ==1){
                    this.startFight = true;
                }else{
                    this.startFight = false;
                }

                this.init();

                
            },
            keyUp1(e){
                
            },
            heroMovement(){
                /*this.hero = new Image();
                this.hero.src = "/images/heroes/hero_mini/quetzalcoatl_32.png";
                this.hero.onload = () =>{
                    this.heroShowCoorImageX = 0;
                    this.heroShowCoorImageY = 0;
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
                }*/
                
            },
            selectFighter(item){
                this.selectedFighter = item;
            },
            selectEnemy(item){
                this.selectedEnemy = item;
            },
            hitEnemy(){
                let damageHero = 0;
                let damageEnemy = 0;

                damageHero = Math.floor( (this.heroStrength - this.enemyDef) / Math.random());

                this.currentEnemyHealth = this.currentEnemyHealth  - (100 * damageHero / this.enemyHealth  );

                if(this.currentEnemyHealth < 0){
                    this.currentEnemyHealth = 0;
                }

                damageEnemy = Math.floor( (this.enemyStrength - this.heroDef) / Math.random());

                this.currentHeroHealth = this.currentHeroHealth  - (100 * damageEnemy / this.heroHealth  );

                if(this.currentHeroHealth < 0){
                    this.currentHeroHealth = 0;
                }

                console.log(this.currentEnemyHealth + " " + this.currentHeroHealth);
            }
        },
        created(){
            this.init();
            const huitzilopochtli = {
                id: 1,
                name: "Huitzi",
                sprite: "images/heroes/huitzilopochtli.png"
            }
            this.fighters.push(huitzilopochtli);

            const quetzalcoatl = {
                id: 2,
                name: "Quetzalcoatl",
                sprite: "images/heroes/quetzalcoatl.png"
            }
            this.fighters.push(quetzalcoatl);

            const tlaloc = {
                id: 3,
                name: "Tlaloc",
                sprite: "images/heroes/tlaloc.png"
            }
            this.fighters.push(tlaloc);

            const tonatiuh = {
                id: 4,
                name: "Tonatiuh",
                sprite: "images/heroes/tonatiuh.png"
            }
            this.fighters.push(tonatiuh);

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
    margin-left: auto;
    margin-right: auto;
    transform: scale(1);
}

.game-canvas canvas{
    image-rendering: pixelated;
}

.listInstructions{
    list-style: none;
}


h1, p{
    color: white;
}


.fighter{
    cursor: pointer;
}

.fighter >  img{
    width: 40px;
}

.fighter:hover{
    background-color: rgb(186, 186, 186);
}

.fighterActive{
    background-color: rgb(186, 186, 186);
}

.fighterName{
    font-size: 10px;
}

.heroFrame img{
    width: 100px;
}

.enemyFrame img{
    width: 100px;
}

</style>