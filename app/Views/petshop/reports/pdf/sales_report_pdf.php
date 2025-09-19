<!DOCTYPE html>
<html>
<?php
$logoPath = FCPATH . 'assets/images/logo.png';
$type = pathinfo($logoPath, PATHINFO_EXTENSION);
$data = file_get_contents($logoPath);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<head>
    <title><?= $month . ' ' . $year ?> Rai Rai Refugio Petshop Sales Report</title>
    <link rel="icon" href="<?= $base64 ?>" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
        }

        /* header table for logo + title */
        .header-table {
            width: 100%;
            margin-bottom: 10px;
            border-collapse: collapse;
        }

        .header-logo {
            width: 100px;
            text-align: center;
            vertical-align: middle;
        }

        .header-title {
            text-align: left;
            vertical-align: middle;
        }

        .header-title h2 {
            font-size: 18px;
            margin: 0;
            color: #000080;
        }

        h4 {
            margin-top: 20px;
            font-size: 14px;
            color: #333;
        }

        table.report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table.report-table th,
        table.report-table td {
            border: 1px solid #333;
            padding: 6px;
            font-size: 11px;
        }

        .total-sales {
            font-size: 14px;
            text-align: right;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- Header with logo + title side by side -->
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="<?= $base64 ?>" style="width: 90px; height: auto;" type="image/png">
            </td>
            <td class="header-title">
                <h2>Rai Rai Refugio Petshop<br>Sales Report for <?= $month ?> <?= $year ?></h2>
            </td>
        </tr>
    </table>
    <hr>

    <?php foreach ($groupedReports as $date => $data): ?>
        <h4><?= date('F j, Y', strtotime($date)) ?></h4>
        <table class="report-table">
            <thead>
                <tr>
                    <th style="background-color:#343a40; color:#fff;">Time Sold</th>
                    <th style="background-color:#343a40; color:#fff;">Product</th>
                    <th style="background-color:#343a40; color:#fff;">Category</th>
                    <th style="background-color:#343a40; color:#fff;">Qty</th>
                    <th style="background-color:#343a40; color:#fff;">Price</th>
                    <th style="background-color:#343a40; color:#fff;">Amount</th>
                    <th style="background-color:#343a40; color:#fff;">In-Charge</th>
                    <th style="background-color:#343a40; color:#fff;">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['records'] as $index => $sale): ?>
                    <tr <?= $index % 2 == 0 ? 'style="background-color:#f9f9f9;"' : '' ?>>
                        <td><?= date('h:i A', strtotime($sale['date_sold'])) ?></td>
                        <td><?= esc(ucfirst($sale['product_name'])) ?></td>
                        <td><?= esc(ucfirst($sale['category'])) ?></td>
                        <td style="text-align:center;"><?= esc($sale['total_qty']) ?></td>
                        <td>P<?= esc(number_format($sale['price'], 2)) ?></td>
                        <td>P<?= esc(number_format($sale['total_amount'], 2)) ?></td>
                        <td>
                            <?php if (!empty(esc($sale['sold_by']))): ?>
                                <?= esc(ucfirst($sale['sold_by'])) ?>
                            <?php else: ?> -
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if (!empty(esc($sale['remarks']))): ?>
                                <?= esc($sale['remarks']) ?>
                            <?php else: ?> -
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr style="background-color:#e9ecef; font-weight:bold;">
                    <td colspan="5">Daily Total:</td>
                    <td colspan="3">P<?= esc(number_format($data['daily_total'], 2)) ?></td>
                </tr>
            </tbody>
        </table>
    <?php endforeach; ?>

    <hr>
    <div class="total-sales">
        <strong>Total Sales for <?= $month ?> <?= $year ?>: P<?= esc(number_format($monthlyTotal, 2)) ?></strong>
    </div>
</body>

</html>
