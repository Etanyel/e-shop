<?php $this->extend('petshop/users/admin/layout/layout'); ?>
<?= $this->section('title') ?> Admin Sales<?= $this->endSection() ?>
<?php $this->section('content'); ?>

<h3>Sales Report</h3>
<hr>

<!-- Filter Form -->
<form method="get" action="/admin/sales/q" class="row g-3 mb-4">
    <?= csrf_field() ?>
    <div class="col-md-3">
        <label for="month" class="form-label">Select Month</label>
        <input type="month" class="form-control" name="month" id="month" value="<?= esc($selectedMonth ?? '') ?>">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-dark">Filter</button>
        <a href="/admin/sales/q" class="btn btn-secondary">Clear</a>
    </div>
    <div class="col-md-3 align-self-end">
        <a href="<?= base_url('reports/monthlyReport' . (!empty($selectedMonth) ? '?month=' . $selectedMonth : '')) ?>" class="btn btn-success">Generate PDF</a>
    </div>
</form>


<div class="table-responsive table-scroll" style="max-height: 400px; overflow-y: auto;">
    <?php if (!empty($groupedReports)): ?>
    <?php foreach ($groupedReports as $monthLabel => $sales): ?>
        <h5 class="mt-4"><?= $monthLabel ?></h5>
        <table class="table table-bordered table-hover mt-2">
            <thead class="table-dark sticky-top">
                <tr>
                    <th>No.</th>
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
            <tbody>
                <?php $no = 1; foreach ($sales as $sale): ?>
                    <tr>
                        <td><?= $no++ ?></td>
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
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-muted mt-4">No sales data found for the selected period.</p>
<?php endif; ?>
</div>

<?php $this->endSection(); ?>
