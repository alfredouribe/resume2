<template>
    <div class="container bg-white">
        <form @submit.prevent="processIntent()" v-if="editCommandForm == false">
            <h1>Add Intent</h1>

            <div class="col-md-6">
                <label>Intent</label>
                <input type="text" v-model="intent.intent" placeholder="Intent" class="form-control" />
            </div>

            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>
        </form>

        <form @submit.prevent="processEditCommand()" v-else>
            <h1>Edit Intent</h1>

            <div class="col-md-6">
                <label>Intent</label>
                <input type="text" v-model="intent.intent" placeholder="Intent" class="form-control" />
            </div>

            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>

        </form>

        <table class="table" style="margin-top: 100px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Intent</th>
                    <th>Id User</th>
                    <th>Created</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in listCommands" :key="index">
                    <td>{{item.id}}</td>
                    <td>{{item.intent}}</td>
                    <td>{{item.idUser}}</td>
                    <td>{{item.created_at}}</td>
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
        props:{
            iduser: 0
        },
        data() {
            return {
                intent : {
                    intent: "" ,
                },
                listCommands: [],
                editCommandForm: false
            }
        },
        mounted() {
            
        },
        methods:{
            processIntent(){
                const parameters = {
                    intent: this.intent.intent,
                    idUser: this.iduser
                }

                axios.post('api/add_intent', parameters)
                .then(res => {
                    this.listCommands.push(res.data)
                })

                this.command = {};
            },
            deleteCommand(item, index){
                const parameters = {
                    id: item.id
                }

                axios.post('api/delete_intent', parameters)
                .then(() => {
                    this.listCommands.splice(index, 1)
                })
            },
            editCommand(item){
                this.intent = item;
                this.editCommandForm = true;
            },
            processEditCommand(){
                this.editCommandForm = false;

                const parameters = {
                    intent: this.intent.intent,
                    idUser: this.iduser,
                    id: this.intent.id
                }

                axios.post('api/edit_intent', parameters)
                .then(res => {
                    const index = this.listCommands.findIndex(searchCommand => searchCommand.id === res.data.id);
                    this.listCommands[index] = res.data;

                    this.command.intent = "";

                })
            }
        },
        created(){
            axios.get('api/get_intents')
            .then(res => {
                this.listCommands = (res.data)
            })
        }
    }
</script>
