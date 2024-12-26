<?php extract($data); ?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="30%">Product</th>
                    <th class="text-center" width="40%">Qty</th>
                    <th class="text-right" width="20%">Total Price (GHC)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $subtotal = 0; ?>
                <?php foreach ($cartItems as $record): ?>
                    <?php 
                    $productPrice = Tools::getProductPrice($record->productId);
                    $productTotal = $record->quantity * $productPrice;
                    $subtotal += $productTotal; 
                    ?>
                    <tr>
                        <td class="d-flex align-items-center font-weight-bolder">
                            <a href="#" class="text-dark text-hover-primary"><?= Tools::getProductName($record->productId) ?></a>
                        </td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-xs btn-light-success btn-icon mr-2 decrement">
                                <i class="ki ki-minus icon-xs"></i>
                            </button>
                            <input type="number" 
                                class="quantity-input mr-2 font-weight-bolder text-center" 
                                value="<?= $record->quantity ?>" 
                                min="1" 
                                data-price="<?= $productPrice ?>" 
                                data-id="<?= $record->productId ?>" 
                                data-cartid="<?= $record->cartId ?>" 
                                style="width: 60px;" />
                            <button type="button" class="btn btn-xs btn-light-success btn-icon increment">
                                <i class="ki ki-plus icon-xs"></i>
                            </button>
                        </td>
                        <td class="text-right align-middle font-weight-bolder font-sm">
                            <span class="total-price"><?= number_format($productTotal, 2) ?></span><br>
                            <small class="text-muted">
                                <span class="quantity-text"><?= $record->quantity ?></span> x GHC <?= number_format($productPrice, 2) ?>
                            </small>
                        </td>

                        <td class="text-right align-middle">
                            <a href="#" class="btn btn-sm btn-danger deleteCartItem font-weight-bolder font-size-sm" uuid="<?= $record->uuid  ?>" cartid="<?= $record->cartId ?>">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Subtotal Row -->
                <tr>
                    <td colspan="2"></td>
                    <td class="font-weight-bolder font-size-h4 text-right">Subtotal</td>
                    <td class="font-weight-bolder font-size-h4 text-right">
                        <span id="subtotalPrice">GHC <?= number_format($subtotal, 2) ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="border-0 text-muted text-right pt-0">Excludes Taxes, Discounts</td>
                </tr>
                <tr>
                    <td colspan="2" class="border-0 pt-10"></td>
                    <td colspan="2" class="border-0 text-right pt-10">
                        <a href="#" class="btn btn-success font-weight-bolder px-8">Proceed to Checkout</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script>

    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            var input = this.closest('td').querySelector('.quantity-input');
            var quantity = parseInt(input.value) || 1;
            input.value = quantity + 1; 
            input.dispatchEvent(new Event('input')); 
        });
    });


    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            var input = this.closest('td').querySelector('.quantity-input');
            var quantity = parseInt(input.value) || 1;
            if (quantity > 1) { 
                input.value = quantity - 1; 
                input.dispatchEvent(new Event('input'));
            }
        });
    });


    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', function () {
            var price = parseFloat(this.dataset.price);
            var quantity = parseInt(this.value);
            var productTotal = price * quantity;

            this.closest('tr').querySelector('.total-price').textContent = formatNumber(productTotal);

            var quantityTextElement = this.closest('tr').querySelector('.quantity-text');
            if (quantityTextElement) {
                quantityTextElement.textContent = quantity; 
            }

            updateSubtotal(); 

            var productId = this.dataset.id;
            var cartId = this.dataset.cartid;

            $.ajax({
                url: `${urlroot}/orders/updateQuantity`, 
                type: 'POST',
                data: {
                    productId: productId,
                    quantity: quantity,
                    cartId: cartId
                },
                success: function(response) {
                    if (response.success) {
                        console.log('Quantity updated successfully');
                    } else {
                        console.log('Failed to update quantity');
                    }
                },
                error: function() {
                    console.log('Error updating quantity');
                }
            });
        });
    });

    function formatNumber(number) {
        return number.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function updateSubtotal() {
        var subtotal = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            var price = parseFloat(input.dataset.price);
            var quantity = parseInt(input.value);
            subtotal += price * quantity;
        });

        document.getElementById('subtotalPrice').textContent = formatNumber(subtotal);
    }


    $(document).off('click', '.deleteCartItem').on('click', '.deleteCartItem', function() {
        var cartid = $(this).attr('cartid');
        var uuid = $(this).attr('uuid');
        var $row = $(this).closest('tr'); 

        var formData = {};
        formData.cartid = cartid; 
        formData.uuid = uuid; 

        $.confirm({
            title: 'Delete Record!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        saveForm(formData, `${urlroot}/orders/deleteCartItem`, function(response) {
                            $row.remove();

                            $.post(`${urlroot}/orders/cart`, {cartid, uuid}, function (response) {
                                $('#cartTable').html(response); 
                            });
                        });
                    }
                }
            }
        });
    });

</script>

<style>
 
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        appearance: textfield;
        -moz-appearance: textfield;
        
    }

    .quantity-input {
        width: 60px;
        text-align: center;
        font-weight: bolder;
    }

    .btn-light-success {
        border-radius: 50%;
        padding: 8px;
    }
</style>
