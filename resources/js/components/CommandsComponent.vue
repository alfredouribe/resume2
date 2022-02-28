<template>
    <div class="container">
        <form @submit.prevent="processCommand()" v-if="editCommandForm == false">
            <h1>Add Commands</h1>

            <div class="col-md-6">
                <label>Command</label>
                <input type="text" v-model="command.command" placeholder="Command" class="form-control" />
            </div>

            <div class="col-md-6">
                <label>Description</label>
                <textarea v-model="command.description" placeholder="Description" class="form-control" ></textarea>
            </div>

            <div class="col-md-6">
                <label>Result</label>
                <textarea v-model="command.result" placeholder="Result" class="form-control" ></textarea>
            </div>

            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>
        </form>

        <form @submit.prevent="processEditCommand()" v-else>
            <h1>Edit Commands</h1>

            <div class="col-md-6">
                <label>Command</label>
                <input type="text" v-model="command.command" placeholder="Command" class="form-control" />
            </div>

            <div class="col-md-6">
                <label>Description</label>
                <textarea v-model="command.description" placeholder="Description" class="form-control" ></textarea>
            </div>

            <div class="col-md-6">
                <label>Result</label>
                <textarea v-model="command.result" placeholder="Result" class="form-control" ></textarea>
            </div>

            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>
        </form>

        <table class="table" style="margin-top: 100px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Command</th>
                    <th>Description</th>
                    <th>Result</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in listCommands" :key="index">
                    <td>{{item.id}}</td>
                    <td>{{item.command}}</td>
                    <td>{{item.description}}</td>
                    <td>{{item.result}}</td>
                    <td>
                        <button class="btn btn-danger" @click="deleteCommand(item, index)">Delete</button> 
                        <button class="btn btn-info" @click="editCommand(item)">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                command : {
                    command: "" ,
                    description: "",
                    result: ""
                },
                listCommands: [],
                editCommandForm: false
            }
        },
        mounted() {
            
        },
        methods:{
            processCommand(){
                const parameters = {
                    command: this.command.command,
                    description: this.command.description,
                    result: this.command.result
                }

                axios.post('api/add_command', parameters)
                .then(res => {
                    this.listCommands.push(res.data)
                })

                this.command = {};
            },
            deleteCommand(item, index){
                const parameters = {
                    id: item.id
                }

                axios.post('api/delete_command', parameters)
                .then(() => {
                    this.listCommands.splice(index, 1)
                })
            },
            editCommand(item){
                this.command = item;
                this.editCommandForm = true;
            },
            processEditCommand(){
                this.editCommandForm = false;

                const parameters = {
                    command: this.command.command,
                    description: this.command.description,
                    result: this.command.result,
                    id: this.command.id
                }

                axios.post('api/edit_command', parameters)
                .then(res => {
                    const index = this.listCommands.findIndex(searchCommand => searchCommand.id === res.data.id);
                    this.listCommands[index] = res.data;

                    this.command.command = "";
                    this.command.description = "";
                    this.command.result = "";
                })
            }
        },
        created(){
            axios.get('api/get_commands')
            .then(res => {
                this.listCommands = (res.data)
            })
        }
    }
</script>

<style scoped>
    td, th{
        color: white;
    }
</style>