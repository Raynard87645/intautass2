<?php 
    require_once "config.php";
    require_once "config/database.php";
    require_once "includes/auth.php";
    require_once "includes/cart.php";
    include "layouts/app.php";
    requireLogin();

    $cartitems = getCartContents();
?>


<section class="bg-light py-5  app-content">
    <div class="container py-5">
        <h3 class="mb-5">Your Shopping Cart</h3>
        <div class="row">
            <div class="col-lg-8">
                <!-- Cart Items -->
                <div class="card mb-4">
                    <div class="card-body">
                    <?php foreach ($cartitems as $key => $item): ?>
                      
                        <div class="row cart-item mb-3">
                            <div class="col-md-3">
                                <img src="<?php echo htmlspecialchars($item['avatar']);?>" alt="Product 1" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="text-muted">Category: <?php echo $item['category'] ?></p>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary btn-sm" type="button">-</button>
                                    <input style="max-width:100px" type="text" class="form-control  form-control-sm text-center quantity-input" value="<?php echo $item['quantity']?>">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="fw-bold">$<?php echo number_format($item['price'], 2); ?></p>
                                <button class="btn btn-sm btn-outline-danger" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                    </div>
                </div>
                <!-- Continue Shopping Button -->
                <div class="text-start mb-4">
                    <a href="/products" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- Cart Summary -->
                <div class="card cart-summary">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>$<?php echo number_format(getCartSubTotalPrice(), 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span>$<?php echo number_format(0.15 * getCartSubTotalPrice(), 2)  ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>$<?php echo number_format(getCartTotalPrice(), 2) ?></strong>
                        </div>
                        <a href="/checkout">
                            <button class="btn btn-primary w-100">Proceed to Checkout</button>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    

</section>

<?php include "layouts/footer.php" ?>

<script>

</script>