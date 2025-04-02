<?php 
    require_once "config.php";
    require_once "config/database.php";
    require_once "includes/auth.php";
    require_once "includes/cart.php";
    require_once "stripe.php";
    include "layouts/app.php";
    requireLogin();

    $amount = round(getCartTotalPrice(), 2);
    $currency = "usd";
    $description = "";
    $products = [
        'product_id' => 'prod_123',
        'product_name' => 'Premium Widget',
        'quantity' => '1'
    ];
    $paymentIntent = createPayment($amount, $currency, $products);
  
?>


<section class="bg-light py-5  app-content">
    <div class="container py-5">
        <h3 class="mb-5">Checkout</h3>
        <div class="row">
            <div class="col-lg-8">

            </div>
            <div class="col-lg-4">
                <form id="payment-form">
                    <div class="card">
                        <div class="card-header">
                            <label for="payment-element">Payment details</label>
                        </div>
                        <div class="card-body">    
                            <div id="payment-element">
                            <!-- Elements will create input elements here -->
                            </div>

                            <!-- We'll put the error messages in this element -->
                            <div id="payment-errors" role="alert"></div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success w-100" id="submit">Pay</button>
                        </div>
                    </div>
                </form>

                <div id="messages" role="alert" style="display: none;"></div>
            </div>
        </div>
    </div>
</section>
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const stripe = Stripe('<?= $_ENV["STRIPE_PUBLISHABLE_KEY"]; ?>', {
            apiVersion: '2020-08-27',
        });

        const elements = stripe.elements({
            clientSecret: '<?= $paymentIntent->client_secret; ?>'
        });
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');

        const paymentForm = document.querySelector('#payment-form');
        paymentForm.addEventListener('submit', async (e) => {
            // Avoid a full page POST request.
            e.preventDefault();

            // Disable the form from submitting twice.
            paymentForm.querySelector('button').disabled = true;

            // Confirm the card payment that was created server side:
            const {error} = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: `${window.location.origin}/payment-success`
                }
            });
            if(error) {
            addMessage(error.message);

            // Re-enable the form so the customer can resubmit.
            paymentForm.querySelector('button').disabled = false;
            return;
            }
        });
    });
</script>

<?php include "layouts/footer.php" ?>