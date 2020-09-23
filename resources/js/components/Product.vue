<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <br>
                <br>
                <br>
                <h3 class="text-center text-success ">DEMO 2 (no check role and permission, no using vue router) </h3>
                <hr>
                <br>
                <!-- Card -->
                <div class="card card-header">
                    <div class="card-body">
                        <!-- Card Inside -->
                        <div class="card-info">
                            <h3 class="text-center">Add Product</h3>
                            <!-- Error -->
                            <div v-if="errors.length">
                                <span class="text-danger" v-for="(err, index) in errors" :key="index">
                                    {{ err }}
                                </span>
                                <br>
                            </div>
                            <!-- End Error -->
                            <!-- Form -->
                            <div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input class="form-control" placeholder="Enter Name" type="text" v-model="productView.nameView">
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input class="form-control" placeholder="Enter Price" type="number" v-model.number="productView.priceView">
                                </div>
                                <span></span>
                                <div class="text-center form-group">
                                    <button class="btn btn-primary" @click="createProduct">Createss</button>
                                </div>
                            </div>
                            <!-- End Form -->
                        </div>
                        <!-- End Card Inside -->
                        <br>
                        <!-- Table List Product -->
                        <div>
                            <h3 class="text-center">List Product</h3>
                            <!-- Error -->
                            <div v-if="errorsEdit.length">
                                <span v-for="(err, index) in errorsEdit" :key="index" class="text-danger">
                                    {{ err }}
                                </span>
                            </div>
                            <br>
                            <!-- End Error -->
                            <table class="table table-bordered table_col">
                                <thead>
                                    <tr>
                                        <th class="w-10 text-center">ID</th>
                                        <th class="w-30 text-center">Name</th>
                                        <th class="w-30 text-center">Price</th>
                                        <th class="w-25 text-center">Date Created</th>
                                        <th class="text-center w-25">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(prod, index) in listProduct" :key="index">
                                        <td class="text-center">{{ prod.id }}</td>
                                        <td class="text-center" v-if="!prod.isEdit">
                                            {{ prod.name }}
                                        </td>
                                        <td v-else>
                                            <input v-model="selectedProduct.name" type="text" class="form-control">
                                        </td>
                                        <td class="text-center" v-if="!prod.isEdit">
                                            {{ prod.price }}
                                        </td>
                                        <td v-else>
                                            <input v-model.number="selectedProduct.price" type="text" class="form-control">
                                        </td>
                                        <td class="text-center">{{ prod.created_at }}</td>
                                        <td v-if="!prod.isEdit" class="text-center">
                                            <button @click="showProduct(prod)" class="btn btn-sm btn-success">Edit</button>
                                            <button @click="deleteProduct(prod, index)" class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                        <td v-else class="text-center">
                                            <button @click="updateProduct(index)" class="btn btn-sm btn-primary">Save</button>
                                            <button @click="prod.isEdit = false" class="btn btn-sm btn-danger">Cancel</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table List Product -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
</template>
<script>
export default {
    data() {
        return {
            listProduct: [],
            productView: {
                nameView: '',
                priceView: 0,
            },
            errors: [],
            previousSelected: null,
            selectedProduct: {},
            errorsEdit: []
        }
    },
    created() {
        this.getProduct()
    },
    methods: {
        createProduct() {
            axios.post('/products', { nameCtrller: this.productView.nameView, priceCtrller: this.productView.priceView })
                .then(responseDemo => {
                    this.listProduct.push({ ...responseDemo.data.productAfter, isEdit: false })
                    this.listProduct.reverse() // đảo ngược array show in list product
                    this.productView = {}
                    this.getProduct()
                    console.log(responseDemo.data.productAfter)
                    console.log('Create Succses')
                })
                .catch(error => {
                    this.errors= error.response.data.errors.nameCtrller
                    
                    setTimeout(() => {
                        this.errorsView = ''
                    }, 3000)
                })
        },
        getProduct() {
            axios.get('/products')
                .then(response => {
                    this.listProduct = response.data.reverse()
                    this.listProduct.forEach(item => {
                        Vue.set(item, 'isEdit', false)
                    })
                })
        },
        showProduct(product) {
            if (this.prevSelectedProduct) // nếu trước đó có chọn 1 sản phẩm để edit
            {
                this.prevSelectedProduct.isEdit = false // đóng form edit
            }

            this.selectedProduct = { ...product }
            product.isEdit = true

            this.prevSelectedProduct = product // thiết lập giá trị mới
        },
        updateProduct(index) {
            axios.put('/products/' + this.selectedProduct.id, {
                    nameCtrller: this.selectedProduct.name,
                    priceCtrller: this.selectedProduct.price
                })
                .then(response => {
                    this.listProduct[index].name = this.selectedProduct.name
                    this.listProduct[index].price = this.selectedProduct.price
                    this.listProduct[index].isEdit = false
                })
                .catch(error => {
                    this.errorsEdit = error.response.data.errors.nameCtrller
                    setTimeout(() => {
                        this.errorsEdit = ''
                    }, 3000)
                })
        },
        deleteProduct(prod, index) {
        	axios.delete('/products/' + prod.id)
        	.then(response => {
        		this.listProduct.splice(index, 1)
        		console.log('Delete Succces')
        	})
        }

    }
}

</script>
<style lang="scss" scoped>
.table_col {
    table-layout: fixed;
}

.w-10 {
    width: 10%
}

.w-15 {
    width: 15%
}

.w-20 {
    width: 20%;
}

.w-25 {
    width: 25%
}

.w-30 {
    width: 30%
}

.w-40 {
    width: 40%;
}

</style>
