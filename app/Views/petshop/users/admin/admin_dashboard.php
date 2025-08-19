<?php 
$this->extend('petshop/users/admin/layout/layout');
?>
<?php $this->section('title') ?> Admin <?php $this->endSection() ?>

<?php $this->section('content') ?>
<div class="container row">
    <div class="col">
        <a href="/admin/users" style="text-decoration: none">
            <div class="card text-bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="bi bi-people-fill me-2"></i>Total Users</div>
                <div class="card-body">
                    <?php if(!empty($approvedCount)) : ?>
                        <h2 class="card-text text-center"><?= $approvedCount ?></h2>
                    <?php else :?>
                        <h2 class="card-text text-center">0</h2>
                    <?php endif ?>
                </div>
            </div>
        </a>
    </div>

    <div class="col">
        <a href="/admin/users/rejected" style="text-decoration: none">
            <div class="card text-bg-danger mb-3" style="max-width: 18rem;">
            <div class="card-header"><i class="bi bi-person-fill-slash me-2"></i>Rejected Users</div>
            <div class="card-body">
                <?php if(!empty($rejectedCount)) : ?>
                        <h2 class="card-text"><?= $rejectedCount ?></h2>
                    <?php else :?>
                        <h2 class="card-text text-center">0</h2>
                <?php endif ?>
            </div>
        </div>
        </a>
    </div>

    <div class="col">
        <a href="/admin/users/pending" style="text-decoration: none">
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header text-white"><i class="bi bi-person-fill-exclamation me-2"></i>Pending Users</div>
                <div class="card-body">
                    <?php if(!empty($PendingCount)) : ?>
                        <h2 class="card-text text-center text-white"><?= $PendingCount ?></h2>
                    <?php else :?>
                        <h2 class="card-text text-center text-white">0</h2>
                    <?php endif ?>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="container mt-5">

<h3>Sales for Today</h3>
<hr>


<?php if (!empty($reports)): ?>
        <div class="table-responsive table-scroll" style="max-height: 250px; overflow-y: auto;">
            <table class="table table-bordered table-striped table-hover mt-2">
            <thead class="table-dark sticky-top">
                <tr>
                    <th>Date Sold</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Qty</th>
                    <th>Total Amount</th>
                    <th>In-Charge</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody class="" >
                <?php foreach ($reports as $sale): ?>
                    <tr>
                        <td><?= date('F j \a\t h:i A', strtotime($sale['date_sold'])) ?></td>
                        <td><?= esc($sale['product_name']) ?></td>
                        <td><?= esc(ucfirst($sale['category'])) ?></td>
                        <td>₱<?= number_format($sale['price'], 2) ?></td>
                        <td><?= esc($sale['total_qty']) ?></td>
                        <td>₱<?= number_format($sale['total_amount'], 2) ?></td>
                        <td><?php if(!empty(esc($sale['sold_by']))) : ?>
                                <?= esc($sale['sold_by']) ?>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </td>
                        <td><?php if(!empty(esc($sale['remarks']))) : ?>
                                <?= esc($sale['remarks']) ?>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total Revenue for Today: <strong class="text-success">₱<?= number_format($Totalprice, 2) ?></strong></p>
        </div>
<?php else: ?>
    <p class="text-muted mt-4">Sales not yet made today.</p>
<?php endif; ?>
</div>
<?php $this->endSection() ?>