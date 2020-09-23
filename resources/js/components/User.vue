<template>
    <!-- Card -->
    <div class="card-footer">
        <div class="card-body">
            <h3 class="text-center">List Users</h3>
            <!-- Error -->
            <div v-if="error.message.length">
                <div class="alert alert-danger">
                    {{ error.message }}
                </div>
            </div>
            <!-- End Error -->
            <br>
            <!-- Table List User -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users " :key="index">
                        <td class="text-center">{{ user.id }}</td>
                        <td class="text-center">{{ user.name }}</td>
                        <td class="text-center">{{ user.email }}</td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table List User -->
        </div>
    </div>
    <!-- End Card -->
</template>
<script>
export default {
    data() {
        return {
            users: [],
            error: {
                message: ''
            }
        }
    },
    created() {
        this.getUser()
    },
    methods: {
        getUser() {
            axios.get('/users')
                .then(response => {
                    if (response.data.status === false) {
                        this.error.message = response.data.message
                    } else {
                        this.users = response.data
                    }
                })
        }
    }
}

</script>
<style lang="scss" scoped>
</style>
