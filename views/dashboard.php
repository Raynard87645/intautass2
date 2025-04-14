<?php 
    require_once "config.php";
    require_once "config/database.php";
    require_once "includes/auth.php";
    include "layouts/app.php";
    //ensure only logged in Session can view this page
    requireLogin();

    $products = [];
    $stmt = $conn->prepare("SELECT products.* FROM products LEFT JOIN orders ON products.id = orders.product_id ORDER BY orders.id DESC LIMIT 10");
    // $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_array()) {
            $products[] = $row;
        }
    }

    $result->close();
    $conn->close();

?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<section class="bg-light py-5 app-content">
    <div class="container ">
        <div class="row mb-5">
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
        <div class="mt-5">
           
            <h2 class="display-6 fw-bolder "><span class="text-gradient d-inline">Orbit best seller</span></h2>
                <p class="text-muted">Let Digital Orbit bring you the best in value for all your needs.</p>
            </div>
            <div class="swiper-content position-relative mt-5 px-5">
                <div class="swiper topsellerswiper">
                    <div class="swiper-wrapper">   
                        <?php foreach ($products as $product): ?>
                            <div class="swiper-slide rounded-pill bg-light d-flex justify-content-center align-items-center">
                                <div class="card h-100 w-100">
                                    <img onerror="this.src = '/public/images/noimage.jpg'" src="<?php echo htmlspecialchars($product['image_url']);?>" 
                                            class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                            style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <a href="/products/<?php echo $product['id'] ?>"><h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5></a>
                                        <p class="card-text nowrap"><?php $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); echo $description; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 fw-bold">$<?php echo number_format($product['price'], 2); ?></span>
                                            <span class="badge bg-<?php echo $product['status'] ? 'success' : 'danger'; ?>">
                                                <?php echo $product['status'] ? 'Instock' : 'Outstock'; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        
                    </div><!--.swiper-wrapper-->
                </div><!--.swiper-->
                <div class="swiper-button-next bg-white rounded-circle"></div>
                <div class="swiper-button-prev bg-white rounded-circle"></div><!--.swiper-btns-->
            </div><!--.content-->
        </div><!--.container-->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="/public/js/app.js"></script>

<?php include "layouts/footer.php" ?>