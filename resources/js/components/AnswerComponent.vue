<template>
    <div class="container bg-white">
        <form @submit.prevent="processAnswer()" v-if="editCommandForm == false">
            <h1>Add Answer</h1>

            <div class="col-md-6">
                <label>Intent</label>
                <select v-model="answer.intent" class="form-control">
                    <option v-for="(item, index) in listIntents" :value="item.id">
                        {{ item.intent }}
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Answer</label>
                <input type="text" v-model="answer.answer" placeholder="Answer" class="form-control" />
            </div>


            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>
        </form>

        <form @submit.prevent="processEditCommand()" v-else>
            <h1>Edit Answer</h1>

            <div class="col-md-6">
                <label>Intent</label>
                <select v-model="answer.intent" class="form-control">
                    <option v-for="(item, index) in listIntents" :value="item.id">
                        {{ item.intent }}
                    </option>
                </select>
            </div>

            <div class="col-md-6">
                <label>Answer</label>
                <input type="text" v-model="answer.answer" placeholder="Answer" class="form-control" />
            </div>

            <button class="btn btn-success" type="submit" style="margin-top: 10px">Save</button>

        </form>

        <table class="table" style="margin-top: 100px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Intent</th>
                    <th>Answer</th>
                    <th>Id User</th>
                    <th>Created</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in listCommands" :key="index">
                    <td>{{item.id}}</td>
                    <td>{{item.intent}}</td>
                    <td>{{item.answer}}</td>
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
                editCommandForm: false,
                listIntents: [],
                answer: { 
                    "answer": "",
                    "intent": 0
                }
            }
        },
        mounted() {
            
        },
        methods:{
            processAnswer(){
                const parameters = {
                    intent: this.answer.intent,
                    idUser: this.iduser,
                    answer: this.answer.answer
                }

                axios.post('api/add_answer', parameters)
                .then(res => {
                    this.getAnswers()
                    this.answer.intent = ''
                    this.answer.answer = ''
                })

                this.command = {};
            },
            deleteCommand(item, index){
                const parameters = {
                    id: item.id
                }

                axios.post('api/delete_answer', parameters)
                .then(() => {
                    this.getAnswers()
                })
            },
            editCommand(item){
                this.answer = item;
                this.answer.intent = item.idIntent
                this.editCommandForm = true;
            },
            processEditCommand(){
                this.editCommandForm = false;

                const parameters = {
                    answer: this.answer.answer,
                    idIntent: this.answer.intent,
                    id: this.intent.id
                }

                axios.post('api/edit_answer', parameters)
                .then(res => {
                    this.getAnswers()
                })
            },
            getAnswers(){
                axios.get('api/get_answers')
                .then(res => {
                    this.listCommands = (res.data)
                })
            }
        },
        created(){
            axios.get('api/get_intents')
            .then(res => {
                this.listIntents = (res.data)
            })

            axios.get('api/get_answers')
            .then(res => {
                this.listCommands = (res.data)
            })
        }
    }
</script>
