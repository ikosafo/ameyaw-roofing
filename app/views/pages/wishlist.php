<?php include ('includes/webheader.php');
extract($data);
?>
<style>   
    .wishlist-container {
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .wishlist-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
    }
    .wishlist-item:last-child {
        border-bottom: none;
    }
    .item-details {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    .item-details img {
        width: 50px;
        height: 50px;
        border-radius: 5px;
    }
    .item-details .name {
        font-size: 16px;
        font-weight: bold;
    }
    .remove-btn {
        background-color: #ff4d4d;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .remove-btn:hover {
        background-color: #ff1a1a;
    }
    .empty-message {
        text-align: center;
        color: #888;
        font-size: 18px;
    }
</style>

    <main class="main about">
        <div class="page-header page-header-bg text-left" style="background: 50%/cover #D4E1EA url('<?php echo URLROOT ?>/public/webassets/images/custom/11.jpg');">
            <div class="container">
                <h1 class="text-white"><span class="text-white"></span>MY WISHLIST</h1>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo URLROOT ?>/pages/index"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
                </ol>
            </div>
        </nav>


        <section class="trendy-section mb-2 mt-5">
                <div class="container">
                    <h2 class="section-title appear-animate animated fadeInUpShorter appear-animation-visible" data-animation-name="fadeInUpShorter" data-animation-delay="200" style="animation-duration: 1000ms;">My Wishlist</h2>

                    <div id="wishlist">
                        <!-- Wishlist items will be dynamically generated here -->
                    </div>
                </div>
            </section>

    </main>

<?php include ('includes/webfooter.php') ?>   

<script>
    // Sample data for wishlist in localStorage
    const sampleWishlist = [
        { id: 1, name: "Product 1", image: "https://via.placeholder.com/50" },
        { id: 2, name: "Product 2", image: "https://via.placeholder.com/50" },
        { id: 3, name: "Product 3", image: "https://via.placeholder.com/50" }
    ];

    // Initialize wishlist in localStorage if not already set
    if (!localStorage.getItem('wishlist')) {
        localStorage.setItem('wishlist', JSON.stringify(sampleWishlist));
    }

    const wishlistContainer = document.getElementById('wishlist');

    function renderWishlist() {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlistContainer.innerHTML = '';

        if (wishlist.length === 0) {
            wishlistContainer.innerHTML = '<p class="empty-message">Your wishlist is empty.</p>';
            return;
        }

        wishlist.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('wishlist-item');

            itemElement.innerHTML = `
                <div class="item-details">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="name">${item.name}</div>
                </div>
                <button class="remove-btn" onclick="removeFromWishlist(${item.id})">Remove</button>
            `;

            wishlistContainer.appendChild(itemElement);
        });
    }

    function removeFromWishlist(id) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(item => String(item.id) !== String(id)); // Convert both to strings for comparison
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        renderWishlist();
    }


    // Initial render
    renderWishlist();
</script>