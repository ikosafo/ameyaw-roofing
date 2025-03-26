<?php extract($data);
    $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
    $invoiceId = Tools::generateOrderId($inspectionDetails['inspectionid']);
    $encryptedUuid = Tools::encrypt($invoiceId, $encryptionKey);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/assets/css/font.css" />
    <link href="<?php echo Tools::companyLogo() ?>" rel="shortcut icon" />
    <style>
        body {
            font-family: Poppins, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        .invoice-container {
            max-width: 850px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .invoice-header img {
            width: 120px;
        }

        .company-details {
            text-align: right;
            font-size: 14px;
        }

        .company-details p {
            margin: 2px 0;
        }

        .invoice-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-title h1 {
            font-size: 26px;
            color: #007bff;
            margin: 0;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 10px;
        }

        .invoice-info div {
            width: 48%;
            font-size: 14px;
            padding: 12px;
            background-color: #f8f9fa;
        }

        .invoice-info h4 {
            font-size: 15px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 8px;
        }

        .invoice-info p {
            margin: 3px 0;
            font-size: 13px;
        }

        .profile-material {
            padding: 15px;
            border-radius: 8px;
            background-color: #e3f2fd;
            border: 1px solid #90caf9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            font-size: 14px;
        }

        .profile-material p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background: #007bff;
            color: white;
        }

        .total-container {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
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
        }

        .action-buttons button:hover {
            background-color: #0056b3;
        }

        .signature-container {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            font-size: 14px;
        }

        .signature-box {
            width: 30%;
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #000;
        }

        .terms {
            font-size: 12px;
            margin-top: 20px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        @media print {
            body {
                background: none;
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none !important;
                border-radius: 0 !important;
                padding: 1px !important;
                margin: 0 !important;
                width: 100% !important;
            }

            .invoice-header {
                border-bottom: 1px solid black !important;
                margin-bottom: 10px !important;
            }

            .invoice-info div {
                background-color: white !important;
                padding: 5px !important;
            }

            table {
                font-size: 12px !important;
                width: 100% !important;
            }

            table th, table td {
                padding: 6px !important;
                /* border: 1px solid black !important; */
            }

            .total-container {
                font-size: 14px !important;
            }

            .action-buttons {
                display: none;
            }
        }

        @media print {
            @page {
                size: A4; /* or letter, depends on your region */
                margin: 10mm; /* Reduce margins */
            }
            body {
                margin: 0;
                padding: 0;
            }

            thead th {
                background: none !important; 
                color: black !important; 
                font-weight: bold;
                text-transform: uppercase;
                border-bottom: 2px solid black !important;
            }
        }

        thead {
            background-color: black;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="<?php echo Tools::companyLogo(); ?>" alt="Company Logo" style="width:100px;height:80px">
            <div class="company-details">
                <p><strong><?= Tools::companyName ?></strong></p>
                <p><?= Tools::companyLocation() ?></p>
                <p>Phone: <?= Tools::companyTelephone() ?></p>
                <p>Website: <?= Tools::companyWebsite ?></p>
            </div>
        </div>

        <div class="invoice-title">
            <h1>INVOICE</h1>
        </div>

        <div class="invoice-info">
            <div>
                <h4>Bill To:</h4>
                <p><strong><?= $inspectionDetails['clientName'] ?></strong></p>
                <p>Email: <?= $inspectionDetails['clientEmail'] ?></p>
                <p>Phone: <?= $inspectionDetails['clientTelephone'] ?></p>
                <p>Date: <?= date('d-m-Y', strtotime($inspectionDetails['createdAt'])); ?></p>
            </div>
            <div>
                <h4>Invoice Details:</h4>
                <p><strong>Invoice #:</strong> <?= strtoupper(str_pad($invoiceId, 7, '0', STR_PAD_LEFT)); ?></p>
                <p><strong>Profile:</strong> <?= Tools::getProfileName($inspectionDetails['profile']) ?></p>
                <p><strong>Material Type:</strong> <?= Tools::getTypeName($inspectionDetails['materialType']) ?></p>
            </div>
        </div>


        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Length</th>
                    <th>Rate (GHC)</th>
                    <th>Total (GHC)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $num = 1;
                $subtotal = 0;
                $groupedProducts = [];

                // Calculate correct amount for each product
                foreach ($listProduction as $record) {
                    $productId = $record->productid;
                    $rate = Tools::getProductRate($productId);
                    $length = isset($record->length) ? $record->length : 0; // Default to 0 if NULL
                
                    if (!isset($groupedProducts[$productId])) {
                        $groupedProducts[$productId] = [
                            'name' => Tools::getProductName($productId),
                            'quantity' => 0,
                            'length' => 0,  // Store length properly
                            'rate' => $rate,
                            'amount' => 0
                        ];
                    }
                
                    // Accumulate quantity
                    $groupedProducts[$productId]['quantity'] += $record->quantity;
                
                    // Accumulate length correctly
                    if ($length > 0) {
                        $groupedProducts[$productId]['length'] += $length; 
                        $groupedProducts[$productId]['amount'] += $length * $record->quantity * $rate;
                    } else {
                        $groupedProducts[$productId]['amount'] += $record->quantity * $rate;
                    }
                }
                

                // Generate table rows
                foreach ($groupedProducts as $productId => $product) {
                    $subtotal += $product['amount'];
                ?>
                    <tr>
                        <td><?= $num++; ?></td>
                        <td>
                            <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                <?= $product['name'] ?>
                            </span>
                        </td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= number_format($product['length'], 2) ?></td>
                        <td><?= number_format($product['rate'], 2) ?></td>
                        <td class="align-middle font-weight-bolder font-sm">
                            <?= number_format($product['amount'], 2) ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>


            <tfoot>
                <tr>
                    <td colspan="5" class="text-right"><strong>Material Cost</strong></td>
                    <td><strong><?= number_format($subtotal, 2); ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Delivery</td>
                    <td><?= number_format($inspectionDetails['delivery'] ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Installation</td>
                    <td><?= number_format($inspectionDetails['installation'] ?? 0, 2); ?></td>
                </tr>
                <?php 
                    $totalPrice = $subtotal ?? 0;
                    $delivery = $inspectionDetails['delivery'] ?? 0;
                    $installation = $inspectionDetails['installation'] ?? 0;
                    $discount = $inspectionDetails['discount'] ?? 0;
                    
                    $subTotal = $totalPrice + $delivery + $installation;
                    $grandTotal = $subTotal - $discount;
                ?>
                <tr>
                    <td colspan="5" class="text-right"><strong>Sub Total</strong></td>
                    <td><strong><?= number_format($subTotal, 2); ?></strong></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Discount</td>
                    <td><?= number_format($discount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right"><strong>GRAND TOTAL</strong></td>
                    <td><strong style="font-size: 16px;"><?= number_format($grandTotal, 2); ?></strong></td>
                </tr>
            </tfoot>

        </table>

        <div class="terms">
            <h4>TERMS AND CONDITIONS</h4>
            <ul>
                <li>100% payment for materials before delivery.</li>
                <li>Prices may change with prior notice to customers.</li>
                <li>Goods once processed are not refundable.</li>
                <li>R.K. AMEYAW Roofing will not be responsible for any damages of sheet produced for more than 2 weeks.</li>
                <li>R.K. AMEYAW Roofing will not be responsible for any damaged goods transported by trucks other than the recommended trucks.</li>
                <li>Provision of electricity and scaffold if needed is at the client's cost.</li>
            </ul>
        </div>

        <div class="signature-container">
            <div class="signature-box">Manager's Signature</div>
            <div class="signature-box">Approved By</div>
            <!-- <div class="signature-box">Customer's Signature</div> -->
        </div>

        <div class="action-buttons no-print">
            <hr>
            <button style="background-color: red;" onclick="window.location.href='/orders/invoicing';">Close</button>
            <button onclick="window.print();">Print</button>
        </div>

    </div>
</body>
</html>