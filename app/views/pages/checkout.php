<link rel="stylesheet" href="<?php echo URLROOT ?>/public/webassets/css/style.min.css">

<?php include ('includes/webheader.php') ?>

    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li>
                    <a href="<?php echo URLROOT ?>/pages/cart">Shopping Cart</a>
                </li>
                <li class="active">
                    <a href="<?php echo URLROOT ?>/pages/checkout">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="<?php echo URLROOT ?>/pages/account">Order Complete</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-7">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title">Billing details</h2>

                            <form action="#" id="checkout-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name
                                                <abbr class="required" title="required">*</abbr>
                                            </label>
                                            <input type="text" class="form-control" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last name
                                                <abbr class="required" title="required">*</abbr></label>
                                            <input type="text" class="form-control" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Company name (optional)</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="select-custom">
                                    <label>Region
                                    <abbr class="required" title="required">*</abbr></label>
                                    <select name="region" class="form-control form-control-sm">
                                        <option value="">Select Region</option>
                                        <option value="Ahafo Region">Ahafo Region</option>
                                        <option value="Ashanti Region">Ashanti Region</option>
                                        <option value="Bono Region">Bono Region</option>
                                        <option value="Bono East Region">Bono East Region</option>
                                        <option value="Central Region">Central Region</option>
                                        <option value="Eastern Region">Eastern Region</option>
                                        <option value="Greater Accra Region">Greater Accra Region</option>
                                        <option value="North East Region">North East Region</option>
                                        <option value="Northern Region">Northern Region</option>
                                        <option value="Oti Region">Oti Region</option>
                                        <option value="Savannah Region">Savannah Region</option>
                                        <option value="Upper East Region">Upper East Region</option>
                                        <option value="Upper West Region">Upper West Region</option>
                                        <option value="Volta Region">Volta Region</option>
                                        <option value="Western Region">Western Region</option>
                                        <option value="Western North Region">Western North Region</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1 pb-2">
                                    <label>Street address
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" placeholder="House number and street name" required="">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" required="">
                                </div>

                                <div class="form-group">
                                    <label>Town / City
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="text" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label>Phone <abbr class="required" title="required">*</abbr></label>
                                    <input type="tel" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label>Email address
                                        <abbr class="required" title="required">*</abbr></label>
                                    <input type="email" class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <label class="order-comments">Order notes (optional)</label>
                                    <textarea class="form-control" placeholder="Notes about your order, e.g. special notes for delivery." required=""></textarea>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- End .col-lg-8 -->

                <div class="col-lg-5">
                    <div class="order-summary">
                        <h3>YOUR ORDER</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            Circled Ultimate 3D Speaker ×
                                            <span class="product-qty">4</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>$1,040.00</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="product-col">
                                        <h3 class="product-title">
                                            Fashion Computer Bag ×
                                            <span class="product-qty">2</span>
                                        </h3>
                                    </td>

                                    <td class="price-col">
                                        <span>$418.00</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal">
                                    <td>
                                        <h4>Subtotal</h4>
                                    </td>

                                    <td class="price-col">
                                        <span>$1,458.00</span>
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="2">
                                        <h4 class="m-b-sm">Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio d-flex">
                                                <input type="radio" class="custom-control-input" name="radio" checked="">
                                                <label class="custom-control-label">Local Pickup</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio d-flex mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Flat Rate</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-group -->
                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <b class="total-price"><span>$1,603.80</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment-methods">
                            <h4 class="">Payment methods</h4>
                            <div class="info-box with-icon p-0">
                                <p>
                                    Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                            Place order
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
                <!-- End .col-lg-4 -->
            </div>
        </div>

        <div class="mb-6"></div>
    </main>

<?php include ('includes/webfooter.php') ?>   

<script>

document.addEventListener("DOMContentLoaded", () => {
    // Retrieve data from localStorage
    const shippingDetails = JSON.parse(localStorage.getItem("shippingDetails"));
    const cart = JSON.parse(localStorage.getItem("cart"));

    // Select the target container
    const orderSummaryContainer = document.querySelector(".col-lg-5");

    // Generate dynamic HTML
    if (shippingDetails && cart) {
        let subtotal = 0;

        // Generate cart items
        let cartItemsHTML = cart.map(item => {
            const price = parseFloat(item.price.replace("GHC", "").replace(",", "").trim());
            const totalItemPrice = price * item.quantity;
            subtotal += totalItemPrice;

            return `
                <tr>
                    <td class="product-col">
                        <h3 class="product-title">${item.name} × <span class="product-qty">${item.quantity}</span></h3>
                    </td>
                    <td class="price-col">
                        <span>GHC ${totalItemPrice.toLocaleString()}</span>
                    </td>
                </tr>
            `;
        }).join("");

        // Generate full replacement HTML
        const newOrderSummaryHTML = `
            <div class="order-summary">
                <h3>YOUR ORDER</h3>
                <table class="table table-mini-cart">
                    <thead>
                        <tr>
                            <th colspan="2">Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${cartItemsHTML}
                    </tbody>
                    <tfoot>
                        <tr class="cart-subtotal">
                            <td><h4>Subtotal</h4></td>
                            <td class="price-col"><span>GHC ${subtotal.toLocaleString()}</span></td>
                        </tr>
                        <tr class="order-shipping">
                            <td class="text-left" colspan="2">
                                <h4 class="m-b-sm">Shipping</h4>
                                <p><strong>Method:</strong> ${shippingDetails.method}</p>
                                <p><strong>Region:</strong> ${shippingDetails.region}</p>
                                <p><strong>City:</strong> ${shippingDetails.city}</p>
                                <p><strong>Street:</strong> ${shippingDetails.street}</p>
                            </td>
                        </tr>
                        <tr class="order-total">
                            <td><h4>Total</h4></td>
                            <td><b class="total-price"><span>GHC ${subtotal.toLocaleString()}</span></b></td>
                        </tr>
                    </tfoot>
                </table>
                <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                    Place order
                </button>
            </div>
        `;

        // Replace the content
        orderSummaryContainer.innerHTML = newOrderSummaryHTML;
    } else {
        orderSummaryContainer.innerHTML = `
            <div class="order-summary">
                <h3>YOUR ORDER</h3>
                <p>No order data found. Please add items to your cart and proceed.</p>
            </div>
        `;
    }
});


</script>

