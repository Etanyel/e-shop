<?php $this->extend('layout/layout'); ?>
<?php $this->section('page_title') ?> Rai Rai Refugio Petshop <?php $this->endSection() ?>
<?php $this->section('body') ?>
<div class="container">

    <form action="/soldout/?" method="GET" class="d-flex align-items-center">
        <input type="text" name="search" placeholder="Search Sold Products" class="form-control me-2">
        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>

    <h3 class="mt-2">Sold Out Products</h3><hr>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if($soldProduct) : ?>
            <?php foreach($soldProduct as $s) : ?>
                <div class="col">
                    <a style="text-decoration:none;" data-bs-toggle="modal" data-bs-target="#modal<?= esc($s['product_id']) ?>" href="">
                        <div class="card shadow-lg h-100">
                            <img src="uploads/<?= esc($s['photo']) ?>" style="height: 200px; width: 100%; object-fit: cover;" alt="img">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= esc($s['product_name']) ?></h5>
                                <p class="card-text text-muted"><?= esc($s['description']) ?></p>
                                <?php if($s['category'] === 'pet') : ?>
                                    <p class="card-text text-muted">Breed: <?= esc($s['breed']) ?></p>
                                    <p class="card-text text-muted">Age: <?= esc($s['age']) ?></p>
                                <?php endif ?>
                                    <p class="card-text text-muted">Qty: <?= esc($s['qty']) ?></p>
                                <div class="mt-auto">
                                    <p class="fw-bold">₱<?= esc($s['price']) ?></p>
                                </div>
                                <span class="badge bg-danger form-control fs-5">SOLD OUT</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="modal fade" id="modal<?= esc($s['product_id']) ?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="uploads/<?= esc($s['photo']) ?>" class="img-fluid rounded" alt="Product Image">
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="fw-bold"><?= esc($s['product_name']) ?></h4>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-success rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#restock_<?= $s['product_id'] ?>"><i class="bi bi-box2-fill"></i></button>
                                    <button class="btn btn-outline-danger rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $s['product_id'] ?>"><i class="bi bi-trash"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#EditModal<?= esc($s['product_id']) ?>" class="btn btn-outline-primary rounded-circle me-4"><i class="bi bi-pencil"></i></button>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                </div>

                                <h5 class="text-success mb-3">₱<?= esc($s['price']) ?></h5>

                                <p class="text-muted">
                                    <?php if(!empty($s['description'])) : ?>
                                        <?= esc($s['description']) ?>
                                    <?php else : ?>
                                        <p>No Description.</p>
                                    <?php endif; ?>
                                </p>

                                <?php if($s['category'] === 'pet'): ?>
                                    <p>Breed: <?= esc($s['breed']) ?></p>
                                    <p>Age: <?= esc($s['age']) ?> y.o</p>
                                <?php endif; ?>
                                <p>Arrive: <?= esc(date('F j, Y \a\t g:i A', strtotime($s['arrival_date']))) ?></p>

                                <span class="badge bg-danger fs-5 form-control">SOLD OUT</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                                <!-- RESTOCK MODAL -->
                <div class="modal fade" id="restock_<?= esc($s['product_id']) ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h4 class="text-white">Re-Stock Product</h4>
                                <span class="btn-close" data-bs-dismiss="modal"></span>
                            </div>

                            <form action="/sold_out/restock/<?= esc($s['id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="modal-body">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="number" name="qty" min="1" id="" class="form-control" placeholder="Insert Quantity">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success">Re-Stock</button>
                                    <span class="btn btn-secondary" data-bs-target="#modal<?= esc($s['product_id']) ?>" data-bs-toggle="modal">Cancel</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                                <!-- Edit Modal -->
                <div class="modal fade" id="EditModal<?= esc($s['product_id']) ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white">Update Product</h4>
                                <button class="btn-close" data-bs-target="#modal<?= esc($s['product_id']) ?>" data-bs-toggle="modal"></button>
                            </div>

                            <form action="sold_out/update/<?= esc($s['id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="modal-body">
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <?php 
                                            if(esc($s['category']) === 'pet') : 
                                            $category = "Pet Name";
                                            ?>
                                                
                                                <label for="productName" class="form-label"><?= $category ?></label>
                                            <?php else : 
                                                $category = "Product Name";
                                                ?>
                                                <label for="productName" class="form-label"><?= $category ?></label>
                                            <?php endif; ?>
                                            <input type="text" name="productName" placeholder="<?= $category ?>" value="<?= esc($s['product_name']) ?>" class="form-control">
                                        </div>

                                        <div class="col-6">
                                            <label for="" class="form-label">Category</label>
                                            <input type="text" name=""value="<?= esc(ucfirst($s['category'])) ?>" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <?php if(esc($s['category']) === 'pet') : ?>
                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label for="species" class="form-label">Species</label>
                                                <input type="text" name="species" value="<?= esc($s['species']) ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="breed" class="form-label">Breed</label>
                                                <input type="text" name="breed" value="<?= esc($s['breed']) ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="text" name="age" value="<?= esc($s['age']) ?>" class="form-control">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label for="qty" class="form-label">Qty</label>
                                            <input type="text" name="qty" value="<?= esc($s['qty']) ?>" class="form-control">
                                        </div>

                                        <div class="col-6">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" name="price" value="<?= esc($s['price']) ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" name="status" value="<?= esc(str_replace('_', ' ', $s['status'])) ?>" class="form-control" readonly>
                                        </div>

                                    </div>

                                    <div class="mb-2">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" placeholder="Description Here" class="form-control"><?= esc($s['description']) ?></textarea>
                                    </div>
                                    
                                    <div class="">
                                        <label for="photo" class="form-label">Update Photo</label>
                                        <input type="file" name="photo" value="<?= esc($s['photo']) ?>" class="form-control">
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary">Update Product</button>
                                    <span class="btn btn-secondary" data-bs-target="#modal<?= esc($s['product_id']) ?>" data-bs-toggle="modal">Cancel</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- Delete Product Modal -->
                <div class="modal fade" id="deleteModal<?= esc($s['product_id']) ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h4 class="modal-title text-white">Confirm Product Deletion</h4>
                                <span class="btn btn-close" data-bs-target="#modal<?= esc($s['product_id']) ?>" data-bs-toggle="modal"></span>
                            </div>

                        <form action="/product/delete/<?= esc($s['id']) ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="modal-body">

                                <h5 class="text-danger">Are You Sure You Want to Delete This Product?</h5>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="submit">Confirm</button>
                                <span class="btn btn-secondary" data-bs-target="#modal<?= esc($s['product_id']) ?>" data-bs-toggle="modal">Cancel</span>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="container">
                <h5 class="text-center">No Sold Out Products Yet.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $this->endSection() ?>