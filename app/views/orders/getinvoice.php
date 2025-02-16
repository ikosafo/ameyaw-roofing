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
            margin: 3px 0; /* Reduce space between paragraphs */
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

        .profile-material {
            margin-bottom: 20px;
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
        @media print {
            .action-buttons { display: none; }
        }

        @media print {
            body {
                background: none;
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                box-shadow: none !important; /* Remove shadow */
                border-radius: 0 !important; /* Remove border radius */
                padding: 10px !important; /* Reduce padding */
                margin: 0 !important; /* Remove margins */
                width: 100% !important; /* Full width */
            }

            .invoice-header {
                border-bottom: 1px solid black !important; /* Make border visible */
                margin-bottom: 10px !important; /* Reduce margin */
            }

            .invoice-info div {
                background-color: white !important; /* Remove background color */
                padding: 5px !important; /* Reduce padding */
            }

            table {
                font-size: 12px !important; /* Reduce font size */
            }

            table th, table td {
                padding: 6px !important; /* Reduce cell padding */
                border: 1px solid black !important; /* Ensure clear borders */
            }

            .total-container {
                font-size: 14px !important; /* Reduce total text size */
            }
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
                padding: 10px !important;
                margin: 0 !important;
                width: 100% !important;
            }

            table {
                font-size: 12px !important; /* Reduce font size */
                width: 100% !important; /* Ensure full width */
            }

            table th, table td {
                padding: 6px !important; /* Reduce padding */
                border: 1px solid black !important; /* Ensure clear borders */
            }
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
                <p><strong>Profile:</strong> <?= $inspectionDetails['profile'] ?></p>
                <p><strong>Material Type:</strong> <?= $inspectionDetails['materialType'] ?></p>
            </div>
        </div>


        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Rate (GHC)</th>
                    <th>Total (GHC)</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; foreach ($listInvoice as $item): ?>
                <tr>
                    <td><?= $num++; ?></td>
                    <td><?= Tools::getProductName($item->productid) ?></td>
                    <td><?= $item->quantity ?></td>
                    <td><?= number_format($item->rate,2) ?></td>
                    <td><?= number_format($item->quantity * $item->rate,2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right"><strong>Subtotal</strong></td>
                    <td>GHC <?= number_format(Tools::totalPrice($inspectionDetails['uuid']) ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Delivery</strong></td>
                    <td>GHC <?= number_format($inspectionDetails['delivery'] ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Installation</strong></td>
                    <td>GHC <?= number_format($inspectionDetails['installation'] ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Discount</strong></td>
                    <td>- GHC <?= number_format($inspectionDetails['discount'] ?? 0, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right"><strong>Total</strong></td>
                    <td><strong>GHC <?= number_format(Tools::totalPrice($inspectionDetails['uuid']) + $inspectionDetails['delivery'] + $inspectionDetails['installation'] - $inspectionDetails['discount'], 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="action-buttons no-print">
            <hr>
            <button onclick="window.print();">Print</button>
        </div>
    </div>
</body>
</html>