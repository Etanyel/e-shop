<!DOCTYPE html>
<html>
<head>
    <title><?= $month . ' ' . $year ?> Rai Rai Refugio Petshop Sales Report</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="icon" href="<?= base_url('assets/images/logo.png') ?>" type="image/png">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Rai Rai Refugio Petshop <br> Sales Report for <?= $month ?> <?= $year ?></h2>
    <hr>

    <?php foreach ($groupedReports as $date => $data): ?>
        <h4><?= date('F j, Y', strtotime($date)) ?></h4>
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Time Sold</th>
                    <th>Product</th>
                    <th>Product Category</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>In-Charge</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['records'] as $sale): ?>
                    <tr>
                        <td><?= date('h:i A', strtotime($sale['date_sold'])) ?></td>
                        <td><?= esc(ucfirst($sale['product_name'])) ?></td>
                        <td><?= esc(ucfirst($sale['category'])) ?></td>
                        <td class="text-center"><?= esc($sale['total_qty']) ?></td>
                        <td>P<?= number_format($sale['price'], 2) ?></td>
                        <td>P<?= number_format($sale['total_amount'], 2) ?></td>
                        <td><?php if(!empty(esc($sale['sold_by']))) : ?>
                                <?= esc(ucfirst($sale['sold_by'])) ?>
                            <?php else : ?>
                                -
                            <?php endif ?>
                        </td>
                        <td><?php if(!empty(esc($sale['remarks']) )) : ?>
                                <?= esc($sale['remarks']) ?>
                            <?php else : ?>
                                -    
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><strong>Daily Total:</strong></td>
                    <td colspan="3"><strong>P<?= number_format($data['daily_total'], 2) ?></strong></td>
                </tr>
            </tbody>
        </table>
        <br>
    <?php endforeach; ?>

    <hr>
    <h3>Total Sales for <?= $month ?> <?= $year ?>: P<?= number_format($monthlyTotal, 2) ?></h3>

</body>
</html>
