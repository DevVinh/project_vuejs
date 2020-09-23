<template>
    <div>
       
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <br>
                    <h3 class="text-center text-success ">DEMO 1</h3>
                    <h3 class="text-center text-success ">( Full check Role and Permission, Using Vue Router ) </h3>
                    <br>
                    <hr>
                    <br>
                    <!-- Navbar Tab -->
                    <ul class="nav nav-tabs nav-pills ">
                        <li class="nav-item">
                            <router-link exact class="nav-link" to="/">Tasks</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link exact class="nav-link" to="/user">User</router-link>
                        </li>
                    </ul>
                    <!-- End Navbar Tab -->
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <!-- End Container -->
    </div>
</template>
<script>
</script>
<style lang="scss" scoped>
</style>
