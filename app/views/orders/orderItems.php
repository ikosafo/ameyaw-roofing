<?php extract($data); 
$orderItemsCount = (isset($orderItems) && is_array($orderItems)) ? count($orderItems) : 0;
?>
<div id="orderProducts">
    <?php if (!empty($orderItems)): ?>
        <p id="resultsCount" class="results-count text-muted font-weight-bold">
            Showing <?= $orderItemsCount ?>  of <?= $orderItemsNumber ?> <?= $orderItemsNumber == 1 ? 'result' : 'results' ?>
        </p>

        <?php foreach ($orderItems as $record): ?>
            <div class="d-flex align-items-center mb-8">
                <div class="d-flex flex-column">
                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><?= $record->productName ?></a>
                    <span class="text-muted font-weight-bold font-size-sm pb-4">
                        <?= Tools::getProductCategoryName($record->categoryId) ?>
                        <br>
                        <a href="javascript:void(0);" class="text-primary">GHC <?= $record->unitPrice ?></a>
                        <?php
                        $labelClass = $record->stockQuantity < 20 ? 'label-light-danger' : 'label-light-success';
                        ?>
                        <span class="label label-inline <?= $labelClass ?> font-weight-bolder">
                            <?= $record->stockQuantity ?> left
                        </span>
                    </span>
                    <div>
                        <?php if ($record->stockQuantity > 0): ?>
                            <button type="button" class="btn btn-sm btn-light font-weight-bolder font-size-sm py-2 addToCart" cartid='<?= $record->productId ?>'>Add to cart</button>
                        <?php else: ?>
                            <span class="text-danger p-2 rounded font-weight-bolder font-size-xs">Item not available</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr>

        <?php endforeach; ?>
    <?php else: ?>
        <p id="resultsCount" class="results-count text-muted font-weight-bold">Showing <?= $orderItemsCount ?> <?= $orderItemsCount === 1 ? 'result' : 'results' ?></p>
        <p class="no-results text-muted font-weight-bold">No results found.</p>
    <?php endif; ?>
</div>


<script>
    var resultsCount = document.getElementById("resultsCount");
    var resultsShow = document.getElementById("resultsShow");
    resultsShow.innerHTML = resultsCount.innerHTML;
    resultsCount.style.display = "none";
    resultsShow.style.display = "block";

    $(document).off('click', '.addToCart').on('click', '.addToCart', function () {
        var cartid = $(this).attr('cartid'); 
        var uuid = '<?php echo $uuid ?>'; 
        var dataToSend = { cartid,uuid };

        $.post(`${urlroot}/orders/cart`, dataToSend, function (response) {
            response = response.trim();
            //alert(response);
            if (response.charAt(0) == 1) {
               $("#orderProducts").notify("Item added to cart", {
                    position: "top center",
                    className: "success"
                });
                $('#cartTable').html(response); 
            }
            else {
                $("#orderProducts").notify("Item already in cart", {
                    position: "top center",
                    className: "error"
                });
            }
           
        });
    });

</script>
