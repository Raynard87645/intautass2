<?php
// Make sure the configuration file is good.
if (!$_ENV['STRIPE_SECRET_KEY']) {
    ?>
  
    <h1>Invalid <code>.env</code></h1>
    <p>Make a copy of <code>.env.example</code> and name it <code>.env</code>, then populate the variables.</p>
    <p>It should look something like the following, but contain your <a href='https://dashboard.stripe.com/test/apikeys'>API keys</a>:</p>
    <pre>STRIPE_PUBLISHABLE_KEY=pk_test...
  STRIPE_SECRET_KEY=sk_test...
  STRIPE_WEBHOOK_SECRET=whsec_...
  DOMAIN=http://localhost:4242</pre>
    <hr>
  
    <p>You can use this command to get started:</p>
    <pre>cp .env.example .env</pre>
  
    <?php
    exit;
  }
  
  // For sample support and debugging. Not required for production:
\Stripe\Stripe::setAppInfo(
    "stripe-samples/accept-a-payment/payment-element",
    "0.0.2",
    "https://github.com/stripe-samples"
);

function stripe() {
    $stripe = new \Stripe\StripeClient([
        'api_key' => $_ENV['STRIPE_SECRET_KEY'],
        'stripe_version' => '2020-08-27',
    ]);
    return $stripe;
}

// Set your secret key
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

// Create a PaymentIntent
function createPayment($amount = 1, $currency = "usd", $products = [], $description = null) {

    try {
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $amount * 100, // amount in cents
            'currency' => $currency,
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
            'metadata' => $products,
            'description' => $description
        ]);
        
        return $paymentIntent;

    } catch (Error $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }

}