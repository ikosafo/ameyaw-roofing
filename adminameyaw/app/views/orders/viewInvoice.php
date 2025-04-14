<?php extract($data); 
$orderid =  $orderDetails['orderid'];
$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
$encryptedUuid = Tools::encrypt($orderid, $encryptionKey);

?>

<div class="card card-body mt-5">
    <div class="card-header">
        <h3 class="card-title">
            View Invoice details of <span class="ml-2 text-uppercase"><strong> <?= $inspectionDetails['clientName'] ?></strong></span>
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ITEM & DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th>TOTAL LENGTH</th>
                    <th>RATE</th>
                    <th>RATE x LENGTH</th>
                    <th>AMOUNT (RATE x LENGTH x QUANTITY)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $grandTotal = 0;
                foreach ($listProduction as $record):
                    $productName = Tools::getProductName($record->productid);
                    $rate = Tools::getProductRate($record->productid);
                    $productCategory = Tools::getProductCategoryName(Tools::getCategoryName($record->productid));

                    // Calculate amount based on length or quantity
                    $amount = ($record->length && $record->length > 0) 
                        ? $record->length * $record->quantity * $rate 
                        : $record->quantity * $rate;

                    $grandTotal += $amount;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($productName . ' - ' . $productCategory) ?></td>
                        <td><?= intval($record->quantity) ?></td>
                        <td><?= number_format(floatval($record->length) ?: 0, 2) ?></td>
                        <td><?= number_format($rate, 2) ?></td>
                        <td><?= number_format($rate * $record->length, 2) ?></td>
                        <td><?= number_format($amount, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

            <tfoot>
                <?php
                $installation = floatval($orderDetails['installation']);
                $delivery = floatval($orderDetails['delivery']);
                $discount = floatval($orderDetails['discount']);

                $grandTotal += $installation + $delivery - $discount;
                ?>
                <tr>
                    <td>INSTALLATION</td>
                    <td colspan="5"><?= number_format($installation, 2) ?></td>
                </tr>
                <tr>
                    <td>DELIVERY</td>
                    <td colspan="5"><?= number_format($delivery, 2) ?></td>
                </tr>
                <tr>
                    <td>DISCOUNT</td>
                    <td colspan="5">-<?= number_format($discount, 2) ?></td>
                </tr>
                <tr>
                    <td><strong>GRAND TOTAL</strong></td>
                    <td colspan="5"><strong><?= number_format($grandTotal, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>

    </div>

    <div class="text-center pt-10">
        <a href="#" type="button" id="checkOut" class="btn btn-success font-weight-bolder px-8">Print Invoice</a>
        <a href="#" id="printProduction" class="btn btn-danger font-weight-bolder px-8 ml-2" onclick="printProduction()">Production Form</a>
    </div>
</div>




<script>
    $(document).ready(function () {
        $("#checkOut").on("click", function (event) {
            event.preventDefault();
            const encryptedUuid = '<?= $encryptedUuid ?>';
            const checkoutUrl = `/orders/getinvoice?uuid=${encodeURIComponent(encryptedUuid)}`;
            window.location.href = checkoutUrl;
        });


        $("#printProduction").on("click", function (event) {
            event.preventDefault();
            const encryptedUuid = '<?= $encryptedUuid ?>';
            const checkoutUrl = `/orders/getproduction?uuid=${encodeURIComponent(encryptedUuid)}`;
            window.location.href = checkoutUrl;
        });
    });
</script>

