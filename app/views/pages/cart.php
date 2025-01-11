<link rel="stylesheet" href="<?php echo URLROOT ?>/public/webassets/css/style.min.css">
<?php include ('includes/webheader.php') ?>

    <main class="main">
        <div class="container">
            <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
                <li class="active">
                    <a href="<?php echo URLROOT ?>/pages/cart">Shopping Cart</a>
                </li>
                <li>
                    <a href="<?php echo URLROOT ?>/pages/checkout">Checkout</a>
                </li>
                <li class="disabled">
                    <a href="<?php echo URLROOT ?>/pages/account">Order Complete</a>
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
                                <tr class="product-row">
                                    <td class="text-right"><span class="subtotal-price">$17.90</span></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="clearfix">
                                       
                                        <!-- <div class="float-right">
                                            <button type="submit" class="btn btn-shop btn-update-cart">
                                                Update Cart
                                            </button>
                                        </div> -->
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="cart-summary">
                        <h3>CART TOTAL</h3>

                        <table class="table table-totals">
                            <tbody>
                               <!--  <tr>
                                    <td>Subtotal</td>
                                    <td>$17.90</td>
                                </tr> -->

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <div class="form-group form-group-custom-control">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="radio" class="custom-control-input" checked="">
                                                <label class="custom-control-label">Delivery</label>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-custom-control mb-0">
                                            <div class="custom-control custom-radio mb-0">
                                                <input type="radio" class="custom-control-input" name="radio">
                                                <label class="custom-control-label">Local pickup</label>
                                            </div>
                                        </div>

                                        <form action="#" class="mt-3 transportDiv">
                                            <div class="form-group form-group-sm">
                                                <label>Transport to </label>
                                                <div class="select-custom">
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
                                            </div>


                                            <div class="form-group form-group-sm">
                                                <input type="text" name="city" class="form-control form-control-sm" placeholder="Town / City">
                                            </div>

                                            <div class="form-group form-group-sm">
                                                <input type="text" name="street" class="form-control form-control-sm" placeholder="Street">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="checkout-methods">
                            <a href="<?php echo URLROOT ?>/pages/checkout" class="btn btn-block checkoutBtn btn-dark">Proceed to Checkout
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

    document.addEventListener("DOMContentLoaded", function () {
        const cartTableBody = document.querySelector(".table-cart tbody");
        const transportDiv = document.querySelector(".transportDiv");
        const subtotalElement = document.querySelector(".subtotal-price");
        const totalElement = document.querySelector(".table-totals tfoot td:last-child");
        const shippingOptions = document.querySelectorAll("input[name='radio']");
        const updateCartButton = document.querySelector(".btn-update-cart");

        // Load cart from localStorage
        const loadCart = () => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            cartTableBody.innerHTML = "";

            let subtotal = 0;

            cart.forEach(product => {
                const { id, name, price, image, quantity = 1 } = product;
                const numericPrice = parseFloat(price.replace(/[^0-9.-]+/g, ""));
                subtotal += numericPrice * quantity;

                const row = `
                    <tr class="product-row" data-id="${id}">
                        <td>
                            <figure class="product-image-container">
                                <a href="#" class="product-image">
                                    <img src="${image}" alt="${name}" style="height:80px; width:80px;">
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
            });

            updateTotals(subtotal);
        };

        // Update totals
        const updateTotals = (subtotal) => {
            subtotalElement.textContent = `GHC ${subtotal.toFixed(2)}`;
            totalElement.textContent = `GHC ${subtotal.toFixed(2)}`;
        };

        // Update cart dropdown notification
        const updateCartDropdown = () => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const cartProductsContainer = document.querySelector(".dropdown-cart-products");
            const cartTotalPriceElement = document.querySelector(".cart-total-price");
            let cartHTML = "";
            let cartTotalPrice = 0;

            if (cart.length === 0) {
                cartProductsContainer.innerHTML = '<p class="empty-cart">Your cart is empty!</p>';
                cartTotalPriceElement.textContent = "GHC 0.00";
                return;
            }

            cart.forEach(item => {
                const { name, price, image, quantity = 1 } = item;
                const numericPrice = parseFloat(price.replace(/[^0-9.-]+/g, ""));
                const itemTotal = numericPrice * quantity;
                cartTotalPrice += itemTotal;

                cartHTML += `
                    <div class="product">
                        <div class="product-details">
                            <h4 class="product-title">
                                <a href="#">${name}</a>
                            </h4>
                            <span class="cart-product-info">
                                <span class="cart-product-qty">${quantity}</span> × GHC ${numericPrice.toFixed(2)}
                            </span>
                        </div>
                        <figure class="product-image-container">
                            <a href="#" class="product-image">
                                <img src="${image}" alt="${name}" style="height:80px; width:80px;">
                            </a>
                            <a href="#" class="btn-remove" title="Remove Product" data-id="${item.id}">
                                <span>×</span>
                            </a>
                        </figure>
                    </div>
                `;
            });

            cartProductsContainer.innerHTML = cartHTML;
            cartTotalPriceElement.textContent = `GHC ${cartTotalPrice.toFixed(2)}`;
        };

        // Update cart quantities on input change
        cartTableBody.addEventListener("input", (e) => {
            if (e.target.classList.contains("horizontal-quantity")) {
                const row = e.target.closest(".product-row");
                const id = row.getAttribute("data-id");
                const quantity = parseInt(e.target.value, 10);
                const cart = JSON.parse(localStorage.getItem("cart")) || [];
                const productIndex = cart.findIndex(item => item.id === id);

                if (productIndex !== -1) {
                    const product = cart[productIndex];
                    const numericPrice = parseFloat(product.price.replace(/[^0-9.-]+/g, ""));
                    product.quantity = quantity;
                    cart[productIndex] = product;

                    const subtotalPriceElement = row.querySelector(".subtotal-price");
                    subtotalPriceElement.textContent = `GHC ${(numericPrice * quantity).toFixed(2)}`;

                    localStorage.setItem("cart", JSON.stringify(cart));

                    let subtotal = cart.reduce((sum, item) => {
                        return sum + parseFloat(item.price.replace(/[^0-9.-]+/g, "")) * item.quantity;
                    }, 0);

                    updateTotals(subtotal);
                    updateCartDropdown();
                }
            }
        });

        // Event listener for removing a product
        cartTableBody.addEventListener("click", (e) => {
            const cart = JSON.parse(localStorage.getItem("cart")) || [];
            const target = e.target;

            if (target.closest(".btn-remove")) { // Adjusted selector for the remove button
                const row = target.closest(".product-row");
                const id = row.getAttribute("data-id");

                const productIndex = cart.findIndex(item => item.id === id);
                if (productIndex !== -1) {
                    cart.splice(productIndex, 1); // Remove the product from the cart
                    localStorage.setItem("cart", JSON.stringify(cart));

                    row.remove(); // Remove the product row from the table

                    // Recalculate totals
                    let subtotal = cart.reduce((sum, item) => {
                        return sum + parseFloat(item.price.replace(/[^0-9.-]+/g, "")) * item.quantity;
                    }, 0);

                    updateTotals(subtotal);
                    updateCartDropdown();
                }
            }
        });

        // Handle increment and decrement of quantity
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
                    // Increment quantity
                    inputField.value = parseInt(inputField.value, 10) + 1;
                } else if (e.target.classList.contains("btn-decrement")) {
                    // Decrement quantity
                    if (parseInt(inputField.value, 10) > 1) {
                        inputField.value = parseInt(inputField.value, 10) - 1;
                    }
                }

                // Update product quantity in cart
                product.quantity = parseInt(inputField.value, 10);
                cart[productIndex] = product;
                localStorage.setItem("cart", JSON.stringify(cart));

                // Update subtotal for the product
                const subtotalPriceElement = row.querySelector(".subtotal-price");
                subtotalPriceElement.textContent = `GHC ${(numericPrice * product.quantity).toFixed(2)}`;

                // Recalculate and update totals
                let subtotal = 0;
                cart.forEach(item => {
                    subtotal += parseFloat(item.price.replace(/[^0-9.-]+/g, "")) * item.quantity;
                });
                updateTotals(subtotal);

                // Update the cart dropdown
                updateCartDropdown();
            }
        });

        shippingOptions.forEach(option => {
            option.addEventListener("change", () => {
                if (document.querySelector("input[name='radio']:checked").nextElementSibling.textContent === "Delivery") {
                    transportDiv.style.display = "block";
                } else {
                    transportDiv.style.display = "none";
                }
            });
        });


        const checkoutButton = document.querySelector(".checkoutBtn");

        // Save or update shipping/delivery options and details
        checkoutButton.addEventListener("click", (e) => {
            e.preventDefault(); // Prevent default navigation

            // Get selected shipping option
            const selectedOption = document.querySelector("input[name='radio']:checked")
                ?.nextElementSibling?.textContent;

            // Get transport details if delivery is selected
            let shippingDetails = null;
            if (selectedOption === "Delivery") {
                const region = document.querySelector("select[name='region']").value;
                const city = document.querySelector("input[name='city']").value;
                const street = document.querySelector("input[name='street']").value;

                if (!region || !city || !street) {
                    alert("Please fill in all delivery details.");
                    return;
                }

                shippingDetails = {
                    method: selectedOption,
                    region,
                    city,
                    street,
                };
            } else {
                shippingDetails = {
                    method: selectedOption || "Local pickup",
                };
            }

            // Save details to localStorage
            localStorage.setItem("shippingDetails", JSON.stringify(shippingDetails));

            console.log("Shipping details saved successfully!");

            // Optionally, navigate to the checkout page
            window.location.href = e.target.href;
        });

        // Preload saved shipping details
        const loadShippingDetails = () => {
            const savedDetails = JSON.parse(localStorage.getItem("shippingDetails"));

            if (savedDetails) {
                if (savedDetails.method === "Delivery") {
                    document.querySelector("input[name='radio']:nth-of-type(1)").checked = true;
                    document.querySelector("select[name='region']").value = savedDetails.region;
                    document.querySelector("input[name='city']").value = savedDetails.city;
                    document.querySelector("input[name='street']").value = savedDetails.street;
                    document.querySelector(".transportDiv").style.display = "block";
                } else if (savedDetails.method === "Local pickup") {
                    document.querySelector("input[name='radio']:nth-of-type(2)").checked = true;
                    document.querySelector(".transportDiv").style.display = "none";
                }
            }
        };

        // Load saved details on page load
        loadShippingDetails();

   
        // Initial load
        loadCart();
        updateCartDropdown();
    });

</script>
