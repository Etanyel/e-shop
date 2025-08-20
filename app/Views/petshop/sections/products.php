<?php 
$category = [
    'pet' => 'Pets', 
    'feeds' => 'Feeds', 
    'vitamins' => 'Vitamins', 
    'medicine' => 'Medicines', 
    'equipment' => 'Equipments', 
    'accessories' => 'Accessories', 
    'seeds' => 'Seeds'
];
?>

<?php foreach($category as $key => $label): ?>
    <h3 class="mt-5"><?= $label ?></h3>
    <hr>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        <?php 
        $found = false;
        foreach($products as $p): 
            if($p['category'] === $key): 
                $found = true;
        ?>
            <div class="col">
                <a style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#productModal<?= $p['id'] ?>" href="#">
                    <div class="card h-100 shadow-lg">
                        <img src="uploads/<?= $p['photo'] ?>" class="rounded" style="height: 200px; width: 100%; object-fit: cover;" alt="img">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= $p['product_name'] ?></h5>
                            <p class="card-text text-muted"><?= $p['description'] ?></p>
                            <?php if($p['category'] === 'pet') : ?>
                                <p class="card-text text-muted">Breed: <?= $p['breed'] ?></p>
                                <p class="card-text text-muted">Age: <?= $p['age'] ?></p>
                            <?php endif; ?>
                            <p class="card-text text-muted">Qty: <?= $p['qty'] ?></p>
                            <div class="mt-auto">
                                <p class="fw-bold">₱<?= number_format($p['price'], 2) ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- View Product Modal -->
            <div class="modal fade" id="productModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <img src="uploads/<?= $p['photo'] ?>" class="img-fluid rounded" alt="Product Image">
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="fw-bold"><?= $p['product_name'] ?></h4>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-danger rounded-circle me-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $p['product_id'] ?>"><i class="bi bi-trash"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#EditModal<?= $p['id'] ?>" class="btn btn-outline-success rounded-circle me-4"><i class="bi bi-pencil"></i></button>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                </div>

                                <h5 class="text-success mb-3">₱<?= number_format($p['price'], 2) ?></h5>

                                <p class="text-muted">
                                    <?php if(!empty($p['description'])) : ?>
                                        <?= $p['description'] ?>
                                    <?php else : ?>
                                        <p>No Description.</p>
                                    <?php endif; ?>
                                </p>

                                <?php if($p['category'] === 'pet'): ?>
                                    <p>Breed: <?= $p['breed'] ?></p>
                                    <p>Age: <?= $p['age'] ?> y.o</p>
                                <?php endif; ?>
                                <p>Arrived: <?= date('F j, Y \a\t g:i A', strtotime($p['arrival_date'])) ?></p>

                                <form action="/buy/<?= $p['id'] ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <div class="row mb-3 mt-2">
                                        <div class="col-6">
                                            <label for="qty" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                        </div>

                                        <div class="col-6">
                                            <label for="qty" class="form-label">In Charge</label>
                                            <input type="text" class="form-control" value="<?= esc($user['firstname']. " " .$user['lastname']) ?>" placeholder="Optional" name="sold_by">
                                        </div>
                                    </div>

                                    <div class="mt-1 mb-2">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea type="text" name="remarks" placeholder="Remarks for buying" class="form-control"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-dark w-100">Buy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                                <!-- Edit Modal -->
                <div class="modal fade" id="EditModal<?= $p['id'] ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white">Update Product</h4>
                                <button class="btn-close" data-bs-target="#productModal<?= $p['id'] ?>" data-bs-toggle="modal"></button>
                            </div>

                            <form action="product/update/<?= $p['id'] ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <?php 
                                            if($p['category'] === 'pet') : 
                                            $category = "Pet Name";
                                            ?>
                                                
                                                <label for="productName" class="form-label"><?= $category ?></label>
                                            <?php else : 
                                                $category = "Product Name";
                                                ?>
                                                <label for="productName" class="form-label"><?= $category ?></label>
                                            <?php endif; ?>
                                            <input type="text" name="productName" placeholder="<?= $category ?>" value="<?= $p['product_name'] ?>" class="form-control">
                                        </div>  

                                        <div class="col-6">
                                            <label for="" class="form-label">Category</label>
                                            <input type="text" name="" value="<?= htmlspecialchars(ucfirst($p['category'])) ?>" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <?php if($p['category'] === 'pet') : ?>
                                        <div class="row mb-2">
                                            <div class="col-md-4">
                                                <label for="species" class="form-label">Species</label>
                                                <input type="text" name="species" value="<?= $p['species'] ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="breed" class="form-label">Breed</label>
                                                <input type="text" name="breed" value="<?= $p['breed'] ?>" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="text" name="age" value="<?= $p['age'] ?>" class="form-control">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label for="qty" class="form-label">Qty</label>
                                            <input type="text" name="qty" value="<?= $p['qty'] ?>" class="form-control">
                                        </div>

                                        <div class="col-6">
                                            <label for="price" class="form-label">Price</label>
                                            <input type="text" name="price" value="<?= $p['price'] ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <?php if($p['status'] === 'Available') : ?>
                                                    <option selected value="Available">Available</option>
                                                    <option value="Sold_out">Sold Out</option>
                                                <?php else : ?>
                                                    <option selected value="Sold_out">Sold Out</option>
                                                    <option value="Available">Available</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="mb-2">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" value="<?= $p['description'] ?>" placeholder="Description Here" class="form-control"><?= $p['description'] ?></textarea>
                                    </div>
                                    
                                    <div class="">
                                        <label for="photo" class="form-label">Update Photo</label>
                                        <input type="file" name="photo" value="<?= $p['photo'] ?>" class="form-control">
                                    </div>
                                    
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary">Update Product</button>
                                    <span class="btn btn btn-secondary" data-bs-target="#productModal<?= $p['id'] ?>" data-bs-toggle="modal">Back</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                    <!-- Delete Product Modal -->
                <div class="modal fade" id="deleteModal<?= $p['product_id'] ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h4 class="modal-title text-white">Confirm Product Deletion</h4>
                                <span class="btn btn-close" data-bs-target="#productModal<?= $p['id'] ?>" data-bs-toggle="modal"></span>
                            </div>

                        <form action="/product/delete/<?= $p['id'] ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="modal-body">

                                <h5 class="text-danger">Are You Sure You Want to Delete This Product?</h5>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger" type="submit">Confirm</button>
                                <span class="btn btn-secondary" data-bs-target="#productModal<?= $p['id'] ?>" data-bs-toggle="modal">Cancel</span>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
        <?php 
            endif; 
        endforeach; 
        ?>

        <?php if(!$found): ?>
            <div class="container">
                <p class="text-center text-muted">No <?= $label ?> Available.</p>
            </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>