<?php extract($data); 
//$uuid = Tools::generateUUID();
$inspectionid =  $inspectionDetails['inspectionid'];
$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
$encryptedUuid = Tools::encrypt($inspectionid, $encryptionKey);

?>
<div class="card card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ITEM & DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th>TOTAL LENGTH</th> 
                    <th>RATE</th>
                    <th>AMOUNT (GHC)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $subtotal = 0;
                $groupedProducts = [];

                // Group products by productid and calculate total quantity & total length
                foreach ($listProduction as $record) {
                    $productId = $record->productid;
                    $rate = Tools::getProductRate($productId);
                    $length = isset($record->length) ? $record->length : 0; // Default to 0 if NULL
                
                    if (!isset($groupedProducts[$productId])) {
                        $groupedProducts[$productId] = [
                            'name' => Tools::getProductName($productId),
                            'quantity' => 0,
                            'rate' => $rate,
                            'totalLength' => 0 
                        ];
                    }
                
                    // Accumulate total quantity
                    $groupedProducts[$productId]['quantity'] += $record->quantity;
                    
                    // Accumulate total length based only on length, not quantity
                    $groupedProducts[$productId]['totalLength'] += $length;
                }
                


                // Generate table rows
                foreach ($groupedProducts as $productId => $product) {
                    if ($product['totalLength'] == 0) {
                        $amount = $product['rate'] * $product['quantity'];
                    }
                    else {
                        $amount = $product['totalLength'] * $product['rate'] * $product['quantity'];
                    }
                   
                    $subtotal += $amount;

                ?>
                    <tr>
                        <td>
                            <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                <?= $product['name'] ?>
                            </span>
                        </td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= number_format($product['totalLength'], 2) ?></td> 
                        <td><?= number_format($product['rate'], 2) ?></td>
                        <td class="align-middle font-weight-bolder font-sm">
                            <?= number_format($amount, 2) ?> <!-- Length × Rate × Quantity -->
                        </td>
                    </tr>


                <?php } ?>
                
                <tr>
                    <td class="font-weight-bolder font-size-h4 text-right" colspan="3">Subtotal</td>
                    <td class="font-weight-bolder font-size-h4 text-center" colspan="2">
                        <span id="subtotalPrice">GHC <?= number_format($subtotal, 2) ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="border-0 text-muted text-right pt-0">Excludes Taxes, Discounts</td>
                </tr>
            </tbody>
        </table>
    </div>

   
    <div class="text-center pt-10">
        <a href="#" type="button" id="checkOut" class="btn btn-success font-weight-bolder px-8">Print Invoice</a>
    </div>
</div>



<script>
    $(document).ready(function () {
        $("#checkOut").on("click", function (event) {
            //alert('test');
            event.preventDefault();
            const encryptedUuid = '<?= $encryptedUuid ?>';
            const checkoutUrl = `/orders/getinvoice?uuid=${encodeURIComponent(encryptedUuid)}`;
            window.location.href = checkoutUrl;
        });
    });
</script>

