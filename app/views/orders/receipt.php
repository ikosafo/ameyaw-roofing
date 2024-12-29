<?php extract($data); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/css/font.css" />
    <link href="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" rel="shortcut icon" />
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

           /*  .print-footer {
                display: none;
            } */

            @page {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="<?php echo URLROOT ?>/public/assets/media/logos/logo.png" alt="Company Logo" class="logo">
            <h1>RECEIPT</h1>
            <p>R. K. Ameyaw Roofing Expert | Amasaman - Kwashiekuma, Accra <br> 0553550219 | www.ameyawroofing.com</p>
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

       
        <div class="total-container" style="text-align:center;margin-top:40px">
            <p>Thank you for your Purchase!</p>
        </div>
        <div class="print-footer">
           <p>We're thrilled to have you as a customer! Thank you for choosing R.K Ameyaw Roofing Experts.</p>
        </div>
    </div>

    <script>
        // Automatically trigger print on page load
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
