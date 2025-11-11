<?php $this->extend('layout/layout'); ?>

<?php $this->section('page_title') ?> Rai Rai Refugio Petshop <?php $this->endSection() ?>

<?php $this->section('body') ?>

<div class="">
    <form action="" method="GET" class="d-flex justify-content-between align-items-center">
        <?= csrf_field() ?>
        <input type="text" name="search" id="" class="form-control" placeholder="Search Product...">
        <button class="btn btn-primary" style="margin-left: 5px"><i class="bi bi-search"></i></button>
    </form>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-3">
        <?php if ($products) : ?>
            <?php foreach ($products as $p) : ?>
                <div class="col">
                    <a class="" data-bs-toggle="modal" data-bs-target="#productModal<?= esc($p['product_id']) ?>" style="text-decoration: none" href="">
                        <div class="card h-100 shadow-lg">
                            <img src="uploads/<?= esc($p['photo']) ?>" class="rounded" style="height: 200px; width: 100%; object-fit: cover;" alt="img">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold"><?= esc($p['product_name']) ?></h5>
                                <p class="card-text text-muted"><?= esc($p['description']) ?></p>
                                <?php if ($p['category'] === 'pet') : ?>
                                    <p class="card-text text-muted">Breed: <?= esc($p['breed']) ?></p>
                                    <p class="card-text text-muted">Age: <?= esc($p['age']) ?></p>
                                <?php endif ?>
                                <p class="card-text text-muted">Qty: <?= esc($p['qty']) ?></p>
                                <div class="mt-auto">
                                    <p class="fw-bold">₱<?= esc(number_format($p['price'], 2)) ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="productModal<?= esc($p['product_id']) ?>" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body p-4">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <img src="uploads/<?= esc($p['photo']) ?>" class="rounded img-fluid" alt="Product Image">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h4 class="fw-bold"><?= esc($p['product_name']) ?></h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <h5 class="text-success mb-3">₱<?= esc(number_format($p['price'], 2)) ?></h5>

                                        <p class="text-muted">
                                            <?php if (!empty(esc($p['description']))) : ?>
                                                <?= esc($p['description']) ?>
                                            <?php else : ?>
                                        <p>No Description.</p>
                                    <?php endif; ?>
                                    </p>

                                    <?php if ($p['category'] === 'pet'): ?>
                                        <p>Breed: <?= esc($p['breed']) ?></p>
                                        <p>Age: <?= esc($p['age']) ?> y.o</p>
                                    <?php endif; ?>
                                    <p>Arrived: <?= esc(date('F j, Y \a\t g:i A', strtotime($p['arrival_date']))) ?></p>
                                    <p class="text-success"><strong>Available Quantity: <?= esc($p['qty']) ?></strong></p>

                                    <form action="/buy/<?= esc($p['id']) ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <div class="row mb-3 mt-2">
                                            <div class="col-6">
                                                <label for="qty" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="qty" name="qty" value="1" min="1">
                                            </div>

                                            <div class="col-6">
                                                <label for="qty" class="form-label">In Charge</label>
                                                <input type="text" class="form-control" value="<?= esc($user['firstname'] . " " . $user['lastname']) ?>" placeholder="Optional" name="sold_by">
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
            <?php endforeach ?>
        <?php else : ?>
            <div class="container mt-5">
                <h4 class="text-center">No Products Available.</h4>
            </div>
        <?php endif ?>
    </div>
</div>




<?php $this->endSection(); ?>