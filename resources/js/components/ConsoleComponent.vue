<template>
    <div class="commandsConsole">
        <div class="consoleSection">
            <span class="contentCode">
                <div class="">
                    <p>Write help to get all the commands information</p>
                </div>
                <div v-for="(item, index) in commands" :key="index" style="border-bottom: 1px solid #a9ced0!important;">
                    <p v-for="(item2, index2) in item" :key="index2">
                        <i class="fa-solid fa-angle-right"></i> 
                        <span style="font-weight: lighter;">{{item2.command}}</span>
                        <br ><small v-html="item2.description"></small>
                        <br ><small v-html="item2.result"></small>
                    </p>
                </div>
            </span>
            
            <form @submit.prevent="processCommand()">
                <label class="labelCode">CMDS > </label><input @input="onInputChange" autocomplete="off" type="text" class="textCommand" id="textCommand" v-model="newCommand.command"  style="margin-top:30px; margin-bottom:50px" placeholder="Type command here (try help)">
            </form>
        </div>
        

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

        <div class="col-sm-12">
            <!-- <keyboard2component @onChange="onChange" @onKeyPress="onKeyPress" :input="newCommand.command"></keyboard2component> -->
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
                password: "",
                input: ""
            }
        },
        el2: "modalLogin",
        mounted() {
            document.getElementById('textCommand').focus()
        },
        methods:{
            processCommand: function(e){
                this.newCommand.command = this.newCommand.command.toLowerCase();
                const parameters = {
                    command: this.newCommand.command
                }
                this.newCommand.command = this.newCommand.command.split(' ')

                if(this.newCommand.command[0] == "clear"){
                    this.commands = []
                }else if(this.newCommand.command[0] == "game"){
                    this.$root.consola = false;
                }else if(this.newCommand.command[0] == "login"){

                    this.$refs.modalButton.click();
                    // this.email = this.newCommand.command[1]
                    // this.password = this.newCommand.command[2]
                    // this.login()

                }else if(this.newCommand.command[0] == "logout"){
                    document.getElementById('logout-form').submit();
                
                }else{
                    axios.post('api/process_command', parameters)
                    .then(res => {
                        this.commands.push(res.data);
                    })
                }

                var container = this.$el.querySelector(".contentCode");
                container.scrollBottom = container.scrollHeight;
                
                this.lastCommand = this.newCommand.command;
                this.newCommand = {
                    command: ""
                };
                this.input = ""
            },
            login: function(){
                const parameters2 = {
                    email: this.email,
                    password: this.password
                }
                
                axios.post('/login', parameters2)
                .then(() => {
                    location.reload();
                })
            },
            onChange(input) {
                this.input = this.newCommand.command
            },
            onKeyPress(button) {
                if(button == "{enter}"){
                    this.processCommand()
                    return
                }
                this.newCommand.command += button
            },
            onInputChange(input) {
                this.input = input.target.value;
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