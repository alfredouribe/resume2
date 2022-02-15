<template>
    <div class="commandsConsole">
        <span class="contentCode">
            <p v-for="(item, index) in commands" :key="index">
                <b>{{item.command}}</b><br>
                {{item.response}}
            </p>
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
                    command: "",
                    response: "",
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            processCommand: function(e){

                this.commands.push(this.newCommand);
                this.newCommand = {};
            }
        }
    }
</script>

