
<?php 
  require_once "includes/auth.php";
  include "layouts/app.php";
?>



<!-- Header-->
<header  style="background-image: url('../public/images/banner.jpg'); background-size: cover;">
        <div class="py-5" style="background: rgba(0, 0, 0, 0.6);">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-5">
                        <!-- Header text content-->
                        <div class="text-center text-xxl-start">
                            <?php if(isset($_SESSION['name'])): ?>
                                <div class="fs-3 welcome text-white">Logged in as <?php echo htmlspecialchars( $_SESSION['name']); ?><div/>
                            <?php endif; ?>
                            <div class="badge bg-gradient-primary-to-secondary text-white mb-4"><div class="text-uppercase">Hungry &middot; Order &middot; Eat</div></div>
                            <div class="fs-3 fw-light text-white text-muted">I get the best food product</div>
                            <h1 class="display-3 fw-bolder text-white mb-5"><span class="text-gradient d-inline">Get food fast and easy</span></h1>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="/products">Start Shoping</a>
                                <a class="btn btn-outline-info btn-lg px-5 py-3 fs-6 fw-bolder" href="/contact">Get In Touch</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7">
                        
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- About Section-->
    <section class="bg-light py-5">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xxl-8">
                    <div class="text-center my-5">
                        <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">About Quick Cart</span></h2>
                        <p class="lead fw-light mb-4">Get food delivered to you anywhere at your own convenience.</p>
                        <p class="text-muted">Let Quick Cart bring you the best in value for all your food needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="row justify-content-center">
            <div class="col-md-12 justify-content-center">
                <div class="display-image">
                    <img src="/public/images/logo.jpg" alt = "Logo">
                </div>
            </div>
        </div>
    </section>        

    

    <?php include "layouts/footer.php"; ?>