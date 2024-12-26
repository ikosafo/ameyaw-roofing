<?php extract($data); 
$orderItemsCount = (isset($orderItems) && is_array($orderItems)) ? count($orderItems) : 0;
?>
<div>
    <?php if (!empty($orderItems)): ?>
        <p id="resultsCount" class="results-count text-muted font-weight-bold">Showing <?= $orderItemsCount ?> <?= $orderItemsCount === 1 ? 'result' : 'results' ?></p>
        <?php foreach ($orderItems as $record): ?>
            <div class="d-flex align-items-center mb-8">
                <div class="d-flex flex-column">
                    <a href="#" class="text-dark-75 font-weight-bolder text-hover-primary font-size-lg"><?= $record->productName ?></a>
                    <span class="text-muted font-weight-bold font-size-sm pb-4"><?= Tools::getProductCategoryName($record->categoryId) ?>
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
                        <button type="button" class="btn btn-light font-weight-bolder font-size-sm py-2">Add to cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p id="resultsCount" class="results-count text-muted font-weight-bold">Showing <?= $orderItemsCount ?> <?= $orderItemsCount === 1 ? 'result' : 'results' ?></p>
        <p class="no-results text-muted font-weight-bold">No results found.</p>
    <?php endif; ?>
</div>


<script>
   // Get the elements by ID
    var resultsCount = document.getElementById("resultsCount");
    var resultsShow = document.getElementById("resultsShow");

    // Update the content of the 'resultsShow' span with the content of 'resultsCount'
    resultsShow.innerHTML = resultsCount.innerHTML;

    // Hide 'resultsCount' and show 'resultsShow'
    resultsCount.style.display = "none";
    resultsShow.style.display = "block";

</script>
