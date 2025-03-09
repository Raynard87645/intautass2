<?php 
    require_once "../includes/auth.php";
    include "../layout/app.php";
?>
<section class="bg-light py-5">
    <div class="container">
        <div class="logo">Quick Food</div>
        <?php if(isset($_SESSION['name'])): ?>
        <p class="welcome">Logged in as <?php echo htmlspecialchars( $_SESSION['name']); ?></p>
        <?php endif; ?>

        <h1>Welcome to QuickFood - Fast Food, Anywhere, Anytime!</h1>
        <p class="description"> Want your favourite foods but can't bother to wait in lines, we will do it for you, Bringing
        it straight to you. From your screen to your hands
        </p>

        <div class = "image">
            <img src="/public/images/logo.jpg" alt = "Logo">
        </div>
    </div>
</section>

<?php include "../layout/footer.php" ?>