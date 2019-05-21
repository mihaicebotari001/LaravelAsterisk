<template>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">PROJECTS</div>

                <div class="card-body">
                    <table class="table table-striped table-light">
                        <tr v-for="project in projects">
                            <td v-bind:title="'Created by ' + project.owner" @click="getProjectTasks(project.id)">
                                {{ project.name }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">TO DO</div>

                <div class="card-body">
                    <table class="table table-striped table-light">
                        <tr v-for="task in todo">
                            <td v-if="task.completed == 0" @click="showTaskModal(task)">
                                N: {{ task.name }} |
                                A: {{ task.author }} |
                                D: {{ task.description }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">COMPLETED</div>

                <div class="card-body">
                    <table class="table table-striped table-light">
                        <tr v-for="task in todo" @click="showTaskModal(task)">
                            <td v-if="task.completed == 1">
                                N: {{ task.name }} |
                                A: {{ task.author }} |
                                D: {{ task.description }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card">
                <div class="card-header">Log&Arhive</div>

                <div class="card-body">
                    Task Manager with Vue js!
                </div>
            </div>
        </div>


        <modal name="task-info">
            Name: {{ this.taskModal.name }}<br>
            Author: {{ this.taskModal.author }}<br>
            Created_at: {{ this.taskModal.created_at }}<br>
            Description: {{ this.taskModal.description }}<br>
        </modal>
    </div>
</template>

<script>
    import vmodal from 'vue-js-modal'
    Vue.use(vmodal);
    var axios = require('axios');


    export default {
        props: {
            prefix: String,
        },

        data(){
            return{
                webUrl: window.location.origin + '/' + this.prefix,
                projects: [],
                todo: [],
                completed: [],

                taskModal: {
                    author: '',
                    created_at: '',
                    description: '',
                    name: '',
                }

            }
        },

        created: function(){
            this.getProjects();
        },

        methods:{
            getProjects(){
                axios.get(this.webUrl + '/laravelasterisk/list/projects').then((response) => {
                    this.projects = response.data.projects;
                });
            },

            getProjectTasks(project_id){
                axios.get(this.webUrl + '/laravelasterisk/list/tasks/' + project_id).then((response) => {
                    this.todo = response.data.tasks;
                });
            },

            showTaskModal (task) {
//                console.log(task)
                this.taskModal.author = task.author;
                this.taskModal.created_at = task.created_at;
                this.taskModal.description = task.description;
                this.taskModal.name = task.name;
                this.$modal.show('task-info');
            },

            hide () {
                this.$modal.hide('task-info');
            },

        },

        mounted() {
            console.log('LaravelAsterisk mounted by Mihai.');
        }
    }
</script>
