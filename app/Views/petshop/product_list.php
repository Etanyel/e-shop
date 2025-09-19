<?php $this->extend('layout/layout'); ?>

<?php $this->section('page_title') ?> Rai Rai Refugio Petshop <?php $this->endSection() ?>

<?php $this->section('body') ?>


<div class="container">
    <form method="GET" action="/product/filter" class="d-flex justify-content-center align-items-center gap-2">
        <?= csrf_field(); ?>
        <select name="category" class="form-control">
            <option value="">-- Choose Category --</option>
            <option value="pet">Pets</option>
            <option value="feeds">Feeds</option>
            <option value="vitamins">Vitamins</option>
            <option value="medicine">Medicine</option>
            <option value="equipment">Equipment</option>
            <option value="accessories">Accessories</option>
            <option value="seeds">Seeds</option>
        </select>

        <select name="species" class="form-control">
            <option value="">-- Choose Species --</option>
            <option value="dog">Dog</option>
            <option value="cat">Cat</option>
            <option value="fish">Fish</option>
            <option value="tortoise">Tortoise</option>
            <option value="bird">Bird</option>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <form action="/product/search" class="mt-3 form-group d-flex justify-content-between align-items-center"
        method="GET">
        <?= csrf_field(); ?>
        <input type="text" name="search" placeholder="Search Here.." class="form-control">
        <button class="d-flex justify-content-between align-items-center btn btn-primary ms-2"><i
                class="bi bi-search me-2"></i> find</button>
    </form>


    <div class="d-flex justify-content-between align-items-center mt-5">
        <h3 class="text-center mt-2">Products and Pets</h3>
        <button class="btn btn-success sm" data-bs-toggle="modal" data-bs-target="#addProduct">Add New Product</button>
    </div>
    <hr>

    <!-- Add Modal -->
    <div class="modal fade" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title text-white">Add New Product</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="/product/add" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" placeholder="Product Name" class="form-control" name="productName">
                            </div>

                            <div class="col-md-6">
                                <label for="categorySelect" class="form-label">Select Category</label>
                                <select name="category" id="categorySelect" class="form-select">
                                    <option value="feeds">Feeds</option>
                                    <option value="pet">Pet</option>
                                    <option value="vitamins">Vitamins</option>
                                    <option value="equipment">Equipment</option>
                                    <option value="medicine">Medicine</option>
                                    <option value="accessories">Accessories</option>
                                    <option value="seeds">Seeds</option>
                                </select>
                            </div>
                        </div>

                        <div id="petFields" class="row mb-3" style="display: none;">
                            <div class="col-md-4">
                                <label for="breed" class="form-label">Breed</label>
                                <input type="text" name="breed" class="form-control" placeholder="Pet Breed">
                            </div>
                            <div class="col-md-4">
                                <label for="age" class="form-label">Age</label>
                                <input type="text" name="age" class="form-control" placeholder="Pet Age">
                            </div>
                            <div class="col-md-4">
                                <label for="species" class="form-label">Select Species</label>
                                <select name="species" class="form-control">
                                    <option value="dog">Dog</option>
                                    <option value="cat">Cat</option>
                                    <option value="fish">Fish</option>
                                    <option value="tortoise">Tortoise</option>
                                    <option value="bird">Bird</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="qty" min="1" class="form-control" value=""
                                    placeholder="Quantity:">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="">
                                <label for="arrivalDate" class="form-label">Arrival Date</label>
                                <input type="datetime-local" name="arrivalDate" class="form-control" id="arrivalDate">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="2"
                                    placeholder="Description (optional)"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="productImg" class="form-label">Upload Image</label>
                                <input type="file" name="photo" class="form-control" id="image">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- for select option -->
    <script>
        document.getElementById('categorySelect').addEventListener('change', function () {
            const petFields = document.getElementById('petFields');

            if (this.value === 'pet') {
                petFields.style.display = 'flex';
            } else {

                petFields.style.display = 'none';

            }

        });
    </script>


    <?= view('petshop/sections/products', ['products' => $products]) ?>
</div>

<?php $this->endSection() ?>