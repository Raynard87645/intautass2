<?php
require_once "config.php";
require_once "includes/auth.php";
require_once "includes/cart.php";
include "layouts/app.php";
require_once "stripe.php";

requireLogin();

// Returning after redirecting to a payment method portal.
$paymentIntent = stripe()->paymentIntents->retrieve(
   $_GET['payment_intent'],
);

clearCart()

?>

<section class="bg-light py-5  app-content">
  <div class="container py-5">
    <h3 class="mb-5">Payment Successfull</h3>
    
    <div class="card">
      <div class="card-body">
        <p>ID <?= $paymentIntent->id; ?></p>
        <p>Status: <?= $paymentIntent->status; ?></p>
        <p>Amount: <?= $paymentIntent->amount; ?></p>
        <p>Currency: <?= $paymentIntent->currency; ?></p>
        <p>Payment Method: <?= $paymentIntent->payment_method; ?></p>
        
      </div>
    </div>
  </div>
</section>
      

<script>
  document.getElementById("cart-count").innerHTML = 0
</script>
<script src="https://js.stripe.com/v3/"></script>
<?php include "layouts/footer.php" ?>