<link rel="stylesheet" href="<?php echo URLROOT ?>/public/webassets/css/style.min.css">
<?php include ('includes/webheader.php') ?>

    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="cart.html">Shopping Cart</a>
                </li>
                <li>
                    <a href="checkout.html">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="cart.html">Order Complete</a>
                </li>
            </ul>

            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table-container">
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="thumbnail-col"></th>
                                    <th class="product-col">Product</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                               

                            </tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                       
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-shop btn-update-cart">
                                                Update Cart
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTALS</h3>

                        <table class="table table-totals">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>$17.90</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="radio" checked="">
                                                <label class="custom-control-label">Local pickup</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" name="radio" class="custom-control-input">
                                                <label class="custom-control-label">Delivery</label>
                                            </div>
                                        </div>

                                        <form action="#" class="mt-3">
                                            <div class="form-group form-group-sm">
                                                <label>Transport to </label>
                                                <div class="select-custom">
                                                    <select class="form-control form-control-sm">
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
                                            </div>


                                            <div class="form-group form-group-sm">
                                                <input type="text" class="form-control form-control-sm" placeholder="Town / City">
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <input type="text" class="form-control form-control-sm" placeholder="Street">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td>$17.90</td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="cart.html" class="btn btn-block btn-dark">Proceed to Checkout
                                <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6"></div>
    </main>

<?php include ('includes/webfooter.php') ?>   

<script>

    $("input.horizontal-quantity").TouchSpin({
        initval: 1,
        postfix: " pcs",
        verticalbuttons: false, 
    });


    document.addEventListener("DOMContentLoaded", function () {
        const cartTableBody = document.querySelector(".table-cart tbody");
        const transportDiv = document.querySelector("form.mt-3");
        const subtotalElement = document.querySelector(".subtotal-price");
        const totalElement = document.querySelector(".table-totals tfoot td:last-child");
        const shippingOptions = document.querySelectorAll("input[name='radio']");
        const updateCartButton = document.querySelector(".btn-update-cart");

        // Load products from local storage and populate the table
        const loadCart = () => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            cartTableBody.innerHTML = ""; // Clear existing rows

            let subtotal = 0;

            cart.forEach((product, index) => {
                const { id, name, price, image, quantity = 1 } = product; // Default quantity if not present
                const numericPrice = parseFloat(price.replace(/[^0-9.-]+/g, "")); // Extract numeric price

                const row = `
                    <tr class="product-row" data-id="${id}">
                        <td>
                            <figure class="product-image-container">
                                <a href="#" class="product-image">
                                    <img src="${image}" alt="${name}">
                                </a>
                                <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                            </figure>
                        </td>
                        <td class="product-col">
                            <h5 class="product-title">${name}</h5>
                        </td>
                        <td>${price}</td>
                        <td>
                            <div class="product-single-qty">
                                <input class="horizontal-quantity form-control" type="number" value="${quantity}" min="1">
                            </div>
                        </td>
                        <td class="text-right"><span class="subtotal-price">GHC ${(numericPrice * quantity).toFixed(2)}</span></td>
                    </tr>
                `;


                cartTableBody.insertAdjacentHTML("beforeend", row);
                subtotal += numericPrice * quantity;
            });

            updateTotals(subtotal);
        };

        // Show transport form if delivery is selected
        const toggleTransportForm = () => {
            const deliverySelected = document.querySelector("input[name='radio']:checked").nextElementSibling.textContent.trim() === "Delivery";
            transportDiv.style.display = deliverySelected ? "block" : "none";
        };

        // Update total values
        const updateTotals = (subtotal) => {
            subtotalElement.textContent = `GHC ${subtotal.toFixed(2)}`;
            totalElement.textContent = `GHC ${subtotal.toFixed(2)}`; // Add shipping logic if needed
        };

        // Handle quantity changes, increment, and decrement
        cartTableBody.addEventListener("click", (e) => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const row = e.target.closest(".product-row");
            if (!row) return;

            const id = row.getAttribute("data-id");
            const inputField = row.querySelector(".horizontal-quantity");
            const productIndex = cart.findIndex(item => item.id === id);

            if (productIndex !== -1) {
                let product = cart[productIndex];
                const numericPrice = parseFloat(product.price.replace(/[^0-9.-]+/g, ""));

                if (e.target.classList.contains("btn-increment")) {
                    inputField.value = parseInt(inputField.value, 10) + 1;
                } else if (e.target.classList.contains("btn-decrement")) {
                    if (parseInt(inputField.value, 10) > 1) {
                        inputField.value = parseInt(inputField.value, 10) - 1;
                    }
                }

                product.quantity = parseInt(inputField.value, 10);
                cart[productIndex] = product;
                localStorage.setItem("cart", JSON.stringify(cart));

                // Update subtotal for this product
                const subtotalPriceElement = row.querySelector(".subtotal-price");
                subtotalPriceElement.textContent = `GHC ${(numericPrice * product.quantity).toFixed(2)}`;

                // Recalculate totals
                let subtotal = 0;
                cart.forEach(item => {
                    subtotal += parseFloat(item.price.replace(/[^0-9.-]+/g, "")) * item.quantity;
                });
                updateTotals(subtotal);
            }
        });

        // Remove product
        cartTableBody.addEventListener("click", (e) => {
            if (e.target.classList.contains("btn-remove")) {
                e.preventDefault();
                const row = e.target.closest(".product-row");
                const id = row.getAttribute("data-id");
                let cart = JSON.parse(localStorage.getItem("cart")) || [];
                
                // Remove the product from localStorage
                cart = cart.filter(product => product.id !== id);
                localStorage.setItem("cart", JSON.stringify(cart));

                // Refresh the table
                loadCart();
            }
        });

        // Handle shipping option change
        shippingOptions.forEach(option => {
            option.addEventListener("change", toggleTransportForm);
        });

        // Update cart button
        updateCartButton.addEventListener("click", (e) => {
            e.preventDefault();
            
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            
            // Loop through each row in the table
            cartTableBody.querySelectorAll(".product-row").forEach(row => {
                const id = row.getAttribute("data-id");
                const inputField = row.querySelector(".horizontal-quantity");
                const quantity = parseInt(inputField.value, 10);

                // Find the product in the cart and update its quantity
                const productIndex = cart.findIndex(product => product.id === id);
                if (productIndex !== -1) {
                    cart[productIndex].quantity = quantity;
                }
            });

            // Save the updated cart back to local storage
            localStorage.setItem("cart", JSON.stringify(cart));

            // Reload the cart to reflect updates
            loadCart();
        });


        // Initial load
        loadCart();
            toggleTransportForm();
        });

</script>