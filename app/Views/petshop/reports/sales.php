<?php $this->extend('/layout/layout'); ?>
<?php $this->section('body'); ?>

<h4 class="text-center">Sales Report</h4>
<hr>

<!-- Filter Form -->
<form method="get" action="<?= base_url('reports') ?>" class="row g-3 mb-4">
    <div class="col-md-3">
        <label for="month" class="form-label">Select Month</label>
        <input type="month" class="form-control" name="month" id="month" value="<?= esc($selectedMonth ?? '') ?>">
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-dark">Filter</button>
        <a href="<?= base_url('reports') ?>" class="btn btn-secondary">Clear</a>
    </div>
    <div class="col-md-3 align-self-end">
        <a href="<?= base_url('reports/monthlyReport') . (!empty($selectedMonth) ? '?month=' . urlencode($selectedMonth) : '') ?>"
            class="btn btn-success">
            Generate PDF
        </a>

    </div>
</form>

<?php if (!empty($groupedReports)): ?>
    <?php foreach ($groupedReports as $monthLabel => $sales): ?>
        <h5 class="mt-4"><?= $monthLabel ?></h5>
        <div style="max-height: 500px; overflow-y: auto;">
            <table class="table table-responsive table-bordered table-striped table-hover mt-2" style="max-height: 500px;">
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
                    <?php $no = 1;
                    foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc(date('F j \a\t h:i A', strtotime($sale['date_sold']))) ?></td>
                            <td><?= esc($sale['product_name']) ?></td>
                            <td><?= esc(ucfirst($sale['category'])) ?></td>
                            <td>₱<?= esc(number_format($sale['price'], 2)) ?></td>
                            <td><?= esc($sale['total_qty']) ?></td>
                            <td>₱<?= esc(number_format($sale['total_amount'], 2)) ?></td>
                            <td><?php if (!empty(esc($sale['sold_by']))): ?>
                                    <?= esc($sale['sold_by']) ?>
                                <?php else: ?>
                                    -
                                <?php endif ?>
                            </td>
                            <td><?php if (!empty(esc($sale['remarks']))): ?>
                                    <?= esc($sale['remarks']) ?>
                                <?php else: ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <p class="text-muted mt-4">No sales data found for the selected period.</p>
<?php endif; ?>

<?php $this->endSection(); ?>