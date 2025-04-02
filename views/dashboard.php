<?php 
    require_once "includes/auth.php";
    include "layouts/app.php";
    //ensure only logged in Session can view this page
    requireLogin();
?>
<section class="bg-light py-5 app-content">
    <div class="container">
        <div class="logo">Quick Food</div>
        <?php if(isset($_SESSION['name'])): ?>
        <p class="welcome">Welcome <?php echo htmlspecialchars( $_SESSION['name']); ?></p>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <h1>Welcome to QuickFood - Fast Food, Anywhere, Anytime!</h1>
                <p class="description"> Want your favourite foods but can't bother to wait in lines, we will do it for you, Bringing
                it straight to you. From your screen to your hands
                </p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                    <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="/views/products.php">Start Shoping</a>
                    <a class="btn btn-outline-info btn-lg px-5 py-3 fs-6 fw-bolder" href="/views/contact.php">Get In Touch</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class = "display-image">
                    <img src="/public/images/logo.jpg" alt = "Logo">
                </div>
            </div>
        </div>
        
        
    </div>
</section>

<?php include "layouts/footer.php" ?>