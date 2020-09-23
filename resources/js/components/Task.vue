<template>
    <!-- Card -->
    <div class="card-footer">
        <div class="card-body">
            <!-- Card Form -->
            <div class="card-info">
                <h3 class="text-center">Add Task</h3>
                <!-- Errors -->
                <div v-if="errorsView.length">
                    <span v-for="(err, index) in errorsView" :key="index" class="alert-danger">
                        {{ err }}
                    </span>
                </div>
                <!-- ------ -->
                <div v-if="error.message.length">
                    <div class="alert alert-danger">
                        {{ error.message }}
                    </div>
                </div>
                <!-- End Errors -->
                <br>
                <!-- Row Width -->
                <div class="row">
                    <div class="col-10">
                        <input type="text" v-model="contentView" placeholder="Enter Task" class="form-control">
                    </div>
                    <div class="col-2">
                        <button @click="saveTask" class="btn btn-sm btn-primary">Create</button>
                    </div>
                </div>
                <!-- End Row Width -->
            </div>
            <!-- End Card Form -->
            <br>
            <br>
            <!-- Table List User -->
            <div>
                <h3 class="text-center">List Task</h3>
                <br>
                <!-- Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Content</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(task, index) in listTask " :key="index">
                            <td class="text-center">{{ task.id }}</td>
                            <td class="text-center">{{ task.content }}</td>
                            <td class="text-center">
                                <button @click="deleteTask(task, index)" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- End Table -->
            </div>
            <!-- End Table List User -->
        </div>
    </div>
    <!-- End Card -->
</template>
<script>
export default {
    data() {
        return {
            contentView: '',
            errorsView: [],
            error: {
                message: ''
            },
            listTask: []
        }
    },
    created() {
        this.getTask()
    },
    methods: {
        saveTask() {
            axios.post('/tasks', { contentCtrller: this.contentView })
                .then(response => {
                    if (response.data.status === false) {
                        this.error.message = response.data.message
                        setTimeout(() => {
                            this.error.message = ''
                        }, 3000)
                    } else {
                        console.log('Create Task Success')
                        this.listTask.push({ ...response.data.taskAfter })
                        this.contentView = ''
                    }
                })
                .catch(error => {
                    this.errorsView = error.response.data.errors.contentCtrller
                    setTimeout(() => {
                        this.errorsView = ''
                    }, 3000)
                })
        },
        getTask() {
            axios.get('/tasks')
                .then(response => {
                    this.listTask = response.data
                })
        },
        deleteTask(task, index) {
            axios.delete('/tasks/' + task.id)
                .then(response => {
                    if (response.data.status === false) {
                        this.error.message = response.data.message
                        setTimeout(() => {
                            this.error.message = ''
                        }, 3000)
                    } else {
                        this.listTask.splice(index, 1)
                        console.log('Delete Task Success')
                    }
                })
        }
    }
}

</script>
<style lang="scss" scoped>
</style>
