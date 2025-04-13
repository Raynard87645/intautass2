<?php 
    require_once "includes/auth.php";
    include "layouts/app.php";
    //ensure only logged in Session can view this page
    requireLogin();
?>
<section class="bg-light py-5 app-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Welcome to Digital Orbit - Up to date, Cutting Edge, The future is now!</h1>
                <p class="description"> At Digital Orbit, we aim to revolutionize the e-commerce experience by combining cutting-edge technology with exceptional customer service. 
                We believe that shopping online should be easy, secure, and enjoyable for everyone.
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                    <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="/products">Start Shoping</a>
                    <a class="btn btn-outline-info btn-lg px-5 py-3 fs-6 fw-bolder" href="/contact">Get In Touch</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class = "display-image">
                    <img src="/public/images/banner.jpg" alt = "Logo">
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<?php include "layouts/footer.php" ?>