<?php extract($data); 
$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
$uuid = $orderDetails['uuid'];
$encryptedUuid = Tools::encrypt($uuid, $encryptionKey);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/css/font.css" />
    <link href="<?php echo Tools::companyLogo ?>" rel="shortcut icon" />
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .invoice-header h1 {
            margin: 10px 0;
            font-size: 24px;
            color: #333;
        }

        .invoice-header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .invoice-header .logo {
            position: absolute;
            top: 0;
            left: 20px;
            width: 80px;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .invoice-info div {
            width: 48%;
        }

        .invoice-info h4 {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .invoice-info p {
            margin: 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #f5f5f5;
            font-size: 14px;
        }

        table td {
            font-size: 14px;
        }

        .total-container {
            text-align: right;
        }

        .total-container p {
            margin: 5px 0;
            font-size: 16px;
        }

        .total-container .total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .print-footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }

        /* Print Styles */
        @media print {
            body {
                background: none;
                color: #000;
            }

            .invoice-container {
                border: none;
                box-shadow: none;
				margin: 20px auto;
            	padding: 20px;
            }

            .no-print {
                display: none;
            }

            @page {
                margin: 0;
            }
        }

        .action-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .action-buttons button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #0056b3;
        }

        .action-buttons .close-button {
            background-color: #3b5a9a; /* Green */
        }

        .action-buttons .close-button:hover {
            background-color: #218838;
        }

        .delAddress {
            font-size: 12px;
        }

        #btnClose {
            background-color: red;
        }

        #btnBack {
            background-color: green;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="<?php echo Tools::companyLogo ?>" alt="Company Logo" class="logo">
            <h1>RECEIPT</h1>
            <p><?= Tools::companyName ?> | <?= Tools::companyLocation ?> <br> <?= Tools::companyTelephone ?> | <?= Tools::companyWebsite ?></p>
        </div>

        <div class="invoice-info">
            <div>
                <h4>Billed To:</h4>
                <p><?= $orderDetails['customerName'] ?></p>
                <p><?= $orderDetails['customerResidence'] ?></p>
                <p><?= $orderDetails['customerEmail'] ?></p>
                <p><?= $orderDetails['customerPhone'] ?></p>
            </div>
            <div>
                <h4>Receipt Details:</h4>
                <p>Receipt #: <?= str_pad($orderDetails['orderId'], 7, '0', STR_PAD_LEFT); ?></p>
                <p>Date: <?php $createdAt = $orderDetails['createdAt'];
                                $timestamp = strtotime($createdAt);
                                if ($timestamp !== false) {
                                    $formattedDate = date('d-m-Y', $timestamp);
                                    echo $formattedDate;
                                } else {
                                    echo 'Invalid date format';
                                }
                            ?>
                </p>
                <p>Payment Status: <strong><?= $orderDetails['paymentStatus'] ?></strong></p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num = 1;
                foreach ($cartItems as $record): ?>
                <tr>
                    <td><?= $num++; ?></td>
                    <td><?= Tools::getProductName($record->productId) ?></td>
                    <td><?= $record->quantity ?></td>
                    <td><?= number_format($record->unitPrice,2) ?></td>
                    <td><?= number_format($record->quantity * $record->unitPrice,2) ?></td>
                </tr>
                <?php endforeach; ?>
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right">Subtotal</td>
                    <td><?= number_format(Tools::totalPrice($orderDetails['uuid']), 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Delivery Fee</td>
                    <td><?= number_format(Tools::getDeliveryPrice($orderDetails['uuid']), 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Total</td>
                    <td class="font-weight-bold"><strong><?= number_format(Tools::totalPrice($orderDetails['uuid']) + Tools::getDeliveryPrice($orderDetails['uuid']),2) ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="total-container">
            <p class="total">Total Amount: GHC <?= number_format(Tools::totalPrice($orderDetails['uuid']) + Tools::getDeliveryPrice($orderDetails['uuid']),2) ?></p>
        </div>

        <?php if (isset($orderDetails['deliveryMode']) && strtolower($orderDetails['deliveryMode']) === 'delivery'): ?>
            <h5 class="font-weight-bolder mb-3">Delivery Service Type:</h5>
            <div class="delAddress" style="text-transform: uppercase;">
                <?= htmlspecialchars($orderDetails['deliveryMode']) ?> at:
            </div>
            <div class="delAddress"><?= htmlspecialchars($orderDetails['address1'] ?? '') ?></div>
            <div class="delAddress"><?= htmlspecialchars($orderDetails['address2'] ?? '') ?></div>
            <div class="delAddress"><?= htmlspecialchars($orderDetails['city'] ?? '') ?></div>
            <div class="delAddress"><?= htmlspecialchars($orderDetails['region'] ?? '') ?></div>
        <?php endif; ?>


       
        <div class="total-container" style="text-align:center;margin-top:40px">
            <p>Thank you for your Purchase!</p>
        </div>
        <div class="print-footer">
           <p>We're thrilled to have you as a customer! Thank you for choosing <?= Tools::companyName ?>.</p>
        </div>
        <div class="action-buttons no-print">
            <hr>
            <button id="btnClose">Close</button>
           <!--  <button id="btnBack">Back</button> -->
            <button onclick="window.print();">Print</button>
        </div>
    </div>


    <script>
        var urlroot = window.location.origin;

        const btnClose = document.getElementById('btnClose');
        if (btnClose) {
            btnClose.addEventListener('click', function() {
                window.location.href = urlroot + '/orders/list';
            });
        } else {
            console.error('Element with id "btnClose" not found.');
        }

        const encryptedUuid = '<?= $encryptedUuid ?>';
        const btnBack = document.getElementById('btnBack');
        if (btnBack) {
            btnBack.addEventListener('click', function() {
                window.location.href = urlroot + `/orders/checkout?uuid=${encodeURIComponent(encryptedUuid)}`;
            });
        } else {
            console.error('Element with id "btnClose" not found.');
        }


        // Disable the browser's "Back" button
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            window.history.pushState(null, null, window.location.href);
        };

    </script>


</body>
</html>
