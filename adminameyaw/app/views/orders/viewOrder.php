<?php extract($data); ?>

<style>
  table.no-border {
    border-collapse: collapse;
    border: none;
  }
  table.no-border th,
  table.no-border td {
    border: none;
  }
</style>

<div class="card card-custom viewProductCard mt-5">
   
    <div class="card-header h-auto py-4">
        <div class="card-title">
            <h3 class="card-label" style="text-transform: uppercase;"><?= Tools::getOrderId($orderDetails['orderId']) ?> 
            <span class="d-block text-muted pt-2 font-size-sm">ORDER ID</span></h3>
        </div>
    </div>


    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Customer Name:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['customerName'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Customer Email:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['customerEmail'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Customer Phone:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['customerPhone'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Customer Resience:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['customerResidence'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Delivery Mode:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['deliveryMode'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Delivery Cost:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['deliveryCost'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Address Line 1:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['address1'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Address Line 2:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['address2'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">City:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['city'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Region:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['region'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Total Amount:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['totalAmount'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Payment Method:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['paymentMethod'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Payment Status:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['paymentStatus'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Notes/Comments:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['notes'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Created At:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['createdAt'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Last Updated:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $orderDetails['updatedAt'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<hr>
    <div class="table-responsive">
        <table class="table no-border">
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
    </div>


    <div class="card-footer">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <a href="javascript:void(0);" class="btn btn-primary font-weight-bold mr-2" id="goBackBtn">Go Back</a>
                    <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    document.getElementById("goBackBtn").addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.viewProductCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });
</script>