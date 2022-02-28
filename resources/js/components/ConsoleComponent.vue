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
            }
        },
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
                }else{
                    axios.post('api/process_command', parameters)
                    .then(res => {
                        this.commands.push(res.data);
                    })
                }

                var container = this.$el.querySelector(".contentCode");
                container.scrollBottom = container.scrollHeight;
                
                this.lastCommand = this.newCommand.command;
                this.newCommand = {};
            }
        }
    }
</script>

