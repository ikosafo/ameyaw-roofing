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
                        $productName = Tools::getProductName($record->productId);
                        $productPrice = Tools::getProductPrice($record->productId);
                        $productTotal = $record->quantity * $productPrice;
                        $subtotal += $productTotal;

                        $style = (!$productName || $record->quantity <= 0) ? 'style="display: none;"' : '';
                    ?>
                    
                    <tr <?= $style ?>>
                        <td class="d-flex align-items-center font-weight-bolder">
                            <a href="#" class="text-dark text-hover-primary"><?= $productName ?></a>
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
                        <a href="#" id="checkOut" class="btn btn-success font-weight-bolder px-8">Proceed to Checkout</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php 
    function encrypt($data, $key) {
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';

    $encryptedUuid = encrypt($uuid, $encryptionKey);
    $encryptedSubtotal = encrypt((string)$subtotal, $encryptionKey);
?>


<script>

    function formatNumber(number) {
        return number.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }


    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('input', function () {
            var price = parseFloat(this.dataset.price);
            var originalQuantity = parseInt(this.dataset.originalQuantity) || parseInt(this.value); 
            var quantity = parseInt(this.value);

            if (isNaN(quantity) || quantity <= 0) {
                console.error("Invalid quantity:", quantity);
                return;
            }

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
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        console.log('Quantity updated successfully');
                        input.dataset.originalQuantity = quantity; 
                    } else {
                        $.notify(response.message, { 
                            position: "top center",
                            className: "error"
                        });
                        console.log('Failed to update quantity: ' + response.message);
                        input.value = originalQuantity;
                        input.closest('tr').querySelector('.quantity-text').textContent = originalQuantity;
                    }
                },
                error: function() {
                    console.log('Error updating quantity');
                    $.notify("Error updating quantity", { 
                        position: "top center",
                        className: "error"
                    });
                    input.value = originalQuantity;
                    input.closest('tr').querySelector('.quantity-text').textContent = originalQuantity;
                }
            });
        });
    });



 
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


    function updateSubtotal() {
        var subtotal = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            var price = parseFloat(input.dataset.price);
            var quantity = parseInt(input.value);

            if (isNaN(quantity) || quantity <= 0 || isNaN(price)) {
                console.error("Invalid quantity or price:", quantity, price);
                return; 
            }

            subtotal += price * quantity;
        });

        document.getElementById('subtotalPrice').textContent = formatNumber(subtotal);
    }



    $(document).off('click', '.deleteCartItem').on('click', '.deleteCartItem', function() {
        var cartid = $(this).attr('cartid');
        var uuid = $(this).attr('uuid');

        var formData = {};
        formData.cartid = cartid; 
        formData.uuid = uuid; 

        $.confirm({
            title: 'Delete Item in cart!',
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
                           
                            $.post(`${urlroot}/orders/cart`, {cartid, uuid}, function (response) {
                                $('#cartTable').html(response); 
                            });
                        });
                    }
                }
            }
        });
    });

    $("#checkOut").click(function() {
        event.preventDefault(); 
        const encryptedUuid = '<?= $encryptedUuid ?>';
        const encryptedSubtotal = '<?= $encryptedSubtotal ?>';

        const checkoutUrl = `/orders/checkout?uuid=${encodeURIComponent(encryptedUuid)}&subtotal=${encodeURIComponent(encryptedSubtotal)}`;
        window.location.href = checkoutUrl;
    })

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
