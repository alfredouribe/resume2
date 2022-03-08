<template>
    <div class="commandsConsole">
        <span class="contentCode">
            <div v-for="(item, index) in commands" :key="index" style="border-bottom: 1px solid #a9ced0!important;">
                <p v-for="(item2, index2) in item" :key="index2">
                    <b><i class="fa-solid fa-angles-right"></i> {{item2.command}}</b>
                    <br ><small v-html="item2.description">{{item2.description}}</small>
                    <br ><small v-html="item2.result">{{item2.result}}</small>
                </p>
            </div>
        </span>
        
        <form @submit.prevent="processCommand()">
            <label class="labelCode">CMDS > </label><input type="text" class="textCommand" v-model="newCommand.command"  style="margin-top:30px; margin-bottom:50px" placeholder="Type command here (try help)">
        </form>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin" ref="modalButton" style="display: none">
        Launch static backdrop modal
        </button>
        <div class="modal" tabindex="-1" id="modalLogin" ref="my-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="form-group">
                            <input type="email" v-model="email" class="form-control inputModal" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <input type="password" v-model="password" class="form-control inputModal" id="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-login" @click="login" data-bs-dismiss="modal">Login</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                commands : [],
                newCommand: {
                    command: ""
                },
                lastCommand: "",
                email: "",
                password: ""
            }
        },
        el2: "modalLogin",
        mounted() {
            
        },
        methods:{
            processCommand: function(e){

                const parameters = {
                    command: this.newCommand.command
                }

                if(this.newCommand.command == "clear"){
                    this.commands = []
                }else if(this.newCommand.command == "game"){
                    this.$root.consola = false;
                }else if(this.newCommand.command == "login"){

                    this.$refs.modalButton.click();

                }else{
                    axios.post('api/process_command', parameters)
                    .then(res => {
                        this.commands.push(res.data);
                    })
                }

                console.log(this.commands);

                var container = this.$el.querySelector(".contentCode");
                container.scrollBottom = container.scrollHeight;
                
                this.lastCommand = this.newCommand.command;
                this.newCommand = {};
            },
            login: function(){
                const parameters2 = {
                    email: this.email,
                    password: this.password
                }
                
                axios.post('api/authenticate', parameters2)
                .then(res => {
                    console.log(res.data);
                    this.commands.push(res.data);
                })
            }
        }
    }
</script>

<style scoped>
    #modalLogin{
        background-color: rgba(255, 255, 255, 0.1);

        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }

    .modal-content{
        background-color: rgba(0,0,0,0.1);
    }

    .form-group{
        margin-bottom: 20px;
    }

    .btn-login{
        background-color: rgba(255, 255, 255, 0.5);
    }

    .inputModal{
        text-align: center;
    }
</style>