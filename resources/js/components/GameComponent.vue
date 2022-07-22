<template>
    <div class="gameContent" style="padding: 20px">

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <canvas class="game-canvas" id="c" :value="input"></canvas>
            </div>

            <div class="col-sm-12 col-md-6 fightScene" style="background: url(images/maps/backgroundbattle.png); background-size: 100% 100%;" v-if="selectedEnemy.id > 0">
                <div class="row">
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col" style="padding-top:30px">
                        <div class="progress ">
                            <div class="progress-bar bg-danger" role="progressbar" :style="'width: '+currentEnemyHealth+'%'" aria-valuenow="100" aria-valuemin="0" :aria-valuemax="enemyHealth">{{enemyHealthMinus}} / {{enemyHealth}}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" :style="'width: '+currentHeroHealth+'%'" aria-valuenow="100" aria-valuemin="0" :aria-valuemax="heroHealth">{{heroHealthMinus}} / {{heroHealth}}</div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <h1 class="text-success" v-if="win == true && showMessageWin == true">WIN</h1>
                        <h1 class="text-danger" v-if="win == false && showMessageWin == true">LOSE</h1>
                    </div>
                    <div class="col text-center">
                        <div class="enemyFrame text-center" style="margin-top:30px" :class="[enemyClassLose, enemyHit]">
                            <span class="text-danger">-{{damageHeroToEnemy}}</span>
                            <img :src="selectedEnemy.sprite">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="heroFrame text-center" :class="[heroClassLose, heroHit]">
                            <span class="text-danger">-{{damageEnemyToHero}}</span>
                            <img :src="selectedFighter.sprite">
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-success" @click="hitEnemy()" style="margin-top: 20px" :disabled="blockHitButton">
                            Hit
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-warning" @click="leaveFight()" style="margin-top: 20px">
                            Leave
                        </button>
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
                    <li>
                        wins: {{wins}} loses: {{loses}}    
                    </li>
                </ul>
            </div>

            <div class="col text-center" v-if="startFight == true" :class="hideHeroChoose">
                <h1>Choose your fighter</h1>
                <div class="row fighters">
                    <div class="col-sm-3 fighter" v-for="(item, index) in fighters" :key="index" @click="selectFighter(item)" :class="selectedFighter.id==item.id ? 'fighterActive': ''">
                        <img :src="item.sprite">
                        <p class="fighterName">{{item.name}}</p>
                    </div>
                </div>
            </div>

            <div class="col text-center" v-if="selectedFighter.id" :class="hideEnemyChoose">
                <h1>Choose an enemy</h1>
                <div class="row fighters">
                    <div class="col-sm-3 fighter enemyChoose" v-for="(item, index) in fighters" :key="index" @click="selectEnemy(item)" :id="'enemy'+index" :class="selectedEnemy.id==item.id ? 'fighterActive': ''">
                        <img :src="item.sprite">
                        <p class="fighterName">{{item.name}}</p>
                    </div>
                </div>
            </div>
            <small><a href="https://www.youtube.com/watch?v=TNYTFOiNO4s&ab_channel=AdamHaynes" target="_blank">Song credits to Adam Haynes</a></small>
        </div>   

        <audio
            ref="audio"
            src="/songs/song.mp3"
            preload
            loop
            id="audio"
            autoplay
            muted
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_wpn_punch4.wav"
            preload
            id="audioPunch"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_deathscream_human1.wav"
            preload
            id="heroDeath"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_deathscream_human11.wav"
            preload
            id="enemyDeath"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_movement_footsteps1b.wav"
            preload
            id="step"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_movement_portal2.wav"
            preload
            id="enemyFound"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_movement_portal3.wav"
            preload
            id="selectFighter"
        ></audio>

        <audio
            ref="audio"
            src="/songs/sfx_weapon_singleshot2.wav"
            preload
            id="randomEnemy"
        ></audio>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin" ref="modalButton" style="display: none">
        
        </button>
        <!-- <div class="modal" tabindex="-1" id="modalLogin" ref="my-modal">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <video width="100%" autoplay id="hitVideo">
                        <source src="/videos/quetvstona.mp4" type="video/mp4">
                        <source src="/videos/quetvstona.mp4" type="video/ogg">
                        Your browser does not support the video tag.
                        </video>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="display: none" ref="closeModalButton">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
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
                heroHealth: 0,
                heroHealthMinus: 0,
                enemyHealth: 0,
                enemyHealthMinus: 0,
                currentHeroHealth: 0,
                currentEnemyHealth: 0,
                heroDef: 0,
                enemyDef: 0,
                heroStrength: 0,
                enemyStrength: 0,
                wins: 0,
                loses: 0,
                win: true,
                showMessageWin: false,
                heroClassLose: "",
                enemyClassLose: "",
                heroHit: "",
                enemyHit: "",
                hideHeroChoose: "",
                hideEnemyChoose: "",
                blockHitButton: false,
                randomEnemySelection: 0,
                damageHeroToEnemy: "",
                damageEnemyToHero: "",
                e: {},
                input: ""
            }
        },
        mounted(){
            this.c = document.getElementById("c");
            this.ctx = this.c.getContext("2d");    
            this.vueCanvas = this.ctx;
            document.addEventListener("keydown", this.keyDown1)
            document.addEventListener("keyup", this.keyUp1)
            var audio = document.getElementById("audio");
            audio.volume = 0.1
            
            if(window.screen.width<1024){
                this.startFight = true
            }
        },
        methods:{
            init(){
                const image = new window.Image();
                image.src = "/images/maps/map.gif";
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

                const npc2 = new Image();
                npc2.src = "/images/heroes/ninja.png";
                npc2.onload = () =>{
                    this.ctx.drawImage(
                        npc2, 
                        0, //left cut 
                        0, //top cut
                        32, //width of cut
                        32, //height of cut
                        8 * 16, //x position
                        2 * 16, //y position
                        48, //size in x
                        48 //size in y
                    )
                };

                const npc3 = new Image();
                npc3.src = "/images/heroes/samurai.png";
                npc3.onload = () =>{
                    this.ctx.drawImage(
                        npc3, 
                        0, //left cut 
                        0, //top cut
                        32, //width of cut
                        32, //height of cut
                        2 * 16, //x position
                        4 * 16, //y position
                        48, //size in x
                        48 //size in y
                    )
                };

                this.hero = new Image();
                this.hero.src = "/images/heroes/erio.png";
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
                // console.log(e);
                let k = e.code
                var step = document.getElementById("step");
                if(step){
                    step.volume = 0.3
                    step.play();
                }
                

                var enemyFound = document.getElementById("enemyFound");
                if(enemyFound){
                    enemyFound.volume = 0.3
                }
                

                if(e.key == "ArrowLeft" || e.key == "a"){
                    if(this.x-1 > -2){
                        this.x = this.x-1;
                    }else{
                        this.x = -1;
                    }
                    
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 3;
                }

                if(e.key == "ArrowRight" || e.key == "d"){
                    if(this.x+1 < 17){
                        this.x = this.x+1;
                    }else{
                        this.x = 16;
                    }
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 1;
                }

                if(e.key == "ArrowUp" || e.key == "w"){
                    if(this.y-1 > -3){
                        this.y = this.y-1;
                    }else{
                        this.y = -2
                    }
                    // this.heroShowCoorImageX;
                    // this.heroShowCoorImageY = 32 * 2;
                }

                if(e.key == "ArrowDown" || e.key == "s"){
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

                if((this.x == 13 && this.y == 1) || (this.x == 7 && this.y == 2) || (this.x == 2 && this.y == 3)){
                    this.startFight = true;
                    enemyFound.play()
                }else{
                    this.startFight = false;
                }

                //console.log(this.x + " " + this.y)

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
                var selectFighter = document.getElementById("selectFighter");
                selectFighter.volume = 0.3
                selectFighter.play()
                this.selectedFighter = item;
                this.selectRandomEnemy(this.fighters);
            },
            selectEnemy(item){
                var selectFighter = document.getElementById("selectFighter");
                selectFighter.volume = 0.3
                selectFighter.play()
                this.selectedEnemy = item;
                this.initStats();
                this.hideEnemyChoose = "hideElements";
                this.hideHeroChoose = "hideElements";
            },
            selectRandomEnemy(fighters){
                var randomEnemy = document.getElementById("randomEnemy");
                randomEnemy.volume = 0.2

                //randomEnemy.play();
                var i = 0;
                var count = 0;
                var reach = this.randomEnemy = Math.floor(Math.random()*(10-1+1)+1);
                
                var ramdonselect = setInterval(()=>{
                    //this.randomEnemy = Math.floor(Math.random()*(3-0+0)+0)

                    let id = 'enemy'+i
                    var element = document.getElementById(id);
                    element.classList.add("change");
                    randomEnemy.play()
                    
                    setTimeout(()=>{
                        element.classList.remove("change");
                    },50)
                    
                    
                    i++;

                    if(i>3){
                        i = 0;
                    }

                    count++

                    if(count == reach){
                        this.selectedEnemy = this.fighters[i];
                        clearInterval(ramdonselect)
                        selectFighter.play()
                        this.initStats();
                        this.hideEnemyChoose = "hideElements";
                        this.hideHeroChoose = "hideElements";
                    }
                }, 100)

            },
            hitEnemy(){
                // this.$refs.modalButton.click();
                this.blockHitButton = true
                var audioPunch = document.getElementById("audioPunch");
                audioPunch.volume = 0.3
                audioPunch.play();

                // var videoHit = document.getElementById("hitVideo");
                // videoHit.play()

                var heroDeath = document.getElementById("heroDeath");
                heroDeath.volume = 0.3

                var enemyDeath = document.getElementById("enemyDeath");
                enemyDeath.volume = 0.3

            
                let damageHero = 0;
                let damageEnemy = 0;

                damageHero = Math.floor( (this.heroStrength - this.enemyDef) + (Math.random() * (this.heroStrength - this.enemyDef)));
                this.damageHeroToEnemy = damageHero
                this.enemyHealthMinus = this.enemyHealthMinus - damageHero;
                this.currentEnemyHealth = this.currentEnemyHealth  - (100 * damageHero / this.enemyHealth  );
                this.enemyHit = "hittedEnemy";
                setTimeout(()=>{
                    this.enemyHit = "";
                }, 100);
                if(this.currentEnemyHealth < 0){
                    this.currentEnemyHealth = 0;
                    this.win = true;
                    this.showMessageWin = true;
                    this.wins = this.wins+1;
                    this.enemyClassLose = "whenLose";
                    
                    enemyDeath.play()
                    return;
                }
                
                setTimeout(()=>{
                    audioPunch.play();
                    damageEnemy = Math.floor( (this.enemyStrength - this.heroDef) + (Math.random() * (this.enemyStrength - this.heroDef)));
                    this.damageEnemyToHero = damageEnemy;
                    this.heroHealthMinus = this.heroHealthMinus - damageEnemy;
                    this.currentHeroHealth = this.currentHeroHealth  - (100 * damageEnemy / this.heroHealth  );
                    this.heroHit = "hittedEnemy";
                    setTimeout(()=>{
                        this.heroHit = "";
                        this.$refs.closeModalButton.click();
                    }, 1000);
                    if(this.currentHeroHealth < 0){
                        this.currentHeroHealth = 0
                        this.win = false
                        this.showMessageWin = true
                        this.loses = this.loses+1
                        this.heroClassLose = "whenLose"
                        heroDeath.play()
                        return;
                    }
                    this.blockHitButton = false
                    
                }, 500)
                
            },
            initStats(){
                
                this.heroHealth = 1000;
                this.heroHealthMinus = 1000;
                this.enemyHealth = 1000;
                this.enemyHealthMinus = 1000;
                this.currentHeroHealth = 100;
                this.currentEnemyHealth = 100;
                this.heroDef = 110;
                this.enemyDef = 100;
                this.heroStrength = 140;
                this.enemyStrength = 150;
                this.blockHitButton = false;
                this.damageHeroToEnemy = ""
                this.damageEnemyToHero = ""
            },
            leaveFight(){
                this.initStats();
                this.selectedFighter = {};
                this.selectedEnemy = {};
                this.win = false;
                this.showMessageWin = false;
                this.heroClassLose = "";
                this.enemyClassLose = "";
                this.hideEnemyChoose = "";
                this.hideHeroChoose = "";
                this.blockHitButton = false;
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
    width: 100%;
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

.fightScene{
    width: 100%;
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
    font-size: 12px;
}

.heroFrame img{
    width: 100px;
}

.enemyFrame img{
    width: 100px;
}

.whenLose{
    filter: grayscale(100%);
    -ms-transform: rotate(90deg); /* IE 9 */
    transform: rotate(90deg);
}

.hittedEnemy{
    animation: shake 0.5s;
}

.hideElements{
    display:none;
}

.change{
    background-color: rgb(186, 186, 186);
}

@keyframes shake {
  0% { transform: translate(1px, 1px) rotate(0deg); }
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); }
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); }
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); }
}

@media screen and (min-width:600px){
    .game-canvas{
        width: 370px;
    }
}

.modal-dialog{
    width: 100%;
}
</style>