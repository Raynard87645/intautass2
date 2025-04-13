<?php 
    require_once "config.php";
    require_once "config/database.php";
    require_once "includes/auth.php";
    require_once "includes/cart.php";
    include "layouts/app.php";

    if(loginToContinue()) include "logintocontinue.php";
    // requireLogin();

    $cartitems = getCartContents();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        removeFromCart($id);
    }
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
                      
                        <div class="row cart-item mb-3" id="cart-item<?php echo $key?>">
                            <div class="col-md-3">
                                <img onerror="this.src = '/public/images/noimage.jpg'" src="<?php echo htmlspecialchars($item['avatar']);?>" alt="Product 1" class="img-fluid rounded">
                            </div>
                            <div class="col-md-5">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="text-muted">Category: <?php echo $item['category'] ?></p>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <button data-pid="<?php echo $key?>" data-update="minus" class="btn btn-outline-secondary btn-sm update-cart-item-button" type="button">-</button>
                                    <input id="cart-quantity<?php echo $key?>" style="max-width:100px" type="text" class="form-control  form-control-sm text-center quantity-input" value="<?php echo $item['quantity']?>">
                                    <button data-pid="<?php echo $key?>" data-update="add" class="btn btn-outline-secondary btn-sm update-cart-item-button" type="button" onclick="">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <p class="fw-bold">$<?php echo number_format($item['price'], 2); ?></p>
                                
                                <button data-pid="<?php echo $key?>" type="submit" class="btn btn-sm btn-outline-danger remove-cart-item-button" >
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
                            <span id="cart-subtotal">$<?php echo number_format(getCartSubTotalPrice(), 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Tax</span>
                            <span id="cart-tax">$<?php echo number_format(0.15 * getCartSubTotalPrice(), 2)  ?></span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong id="cart-total">$<?php echo number_format(getCartTotalPrice(), 2) ?></strong>
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
    document.querySelectorAll('button.remove-cart-item-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-pid');
           
            fetch('/delete-cartitem', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`//JSON.stringify({id: id, name: name, price: price, avatar: avatar, category: category})
            }).then(response => response.text())
            .then(response => {
                const data= JSON.parse(response)
                document.getElementById("cart-count").innerHTML = data['count']
                document.getElementById("cart-subtotal").innerHTML = data['subtotal'].toFixed(2)
                document.getElementById("cart-tax").innerHTML = (0.15 * data['subtotal']).toFixed(2)
                document.getElementById("cart-total").innerHTML = data['total'].toFixed(2)
                document.getElementById(`cart-item${id}`).remove()
            });

            

        });
        
    });

    document.querySelectorAll('button.update-cart-item-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-pid');
            let quantity = document.getElementById(`cart-quantity${id}`)?.value
            const update = this.getAttribute('data-update');
            switch (update) {
                case "add":
                    quantity = parseInt(quantity) + 1
                    break;
            
                default:
                    quantity = parseInt(quantity) - 1
                    break;
            }
           
            fetch('/update-cartitem', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}&quantity=${quantity}`//JSON.stringify({id: id, name: name, price: price, avatar: avatar, category: category})
            }).then(response => response.text())
            .then(response => {
                const data= JSON.parse(response)
                document.getElementById("cart-count").innerHTML = data['count']
                document.getElementById("cart-subtotal").innerHTML = data['subtotal'].toFixed(2)
                document.getElementById("cart-tax").innerHTML = (0.15 * data['subtotal']).toFixed(2)
                document.getElementById("cart-total").innerHTML = data['total'].toFixed(2)

                document.getElementById(`cart-quantity${id}`).value = quantity
            });

            

        });
        
    });

  
</script>