<?php
  require_once "includes/auth.php";
  include "layouts/app.php";
$companyName = "Digital Orbit";
$foundedYear = "2020";
$phone = "+1 (876) 123-4567";
$address = "NCU, Mandeville, Jamaica";


$year = date("Y");
?>

<section class="bg-light py-5  app-content">
    

    <div class="banner">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bolder"><span class="text-gradient d-inline">About <?php echo $companyName; ?></span></h2>
                <p>Your trusted partner in e-commerce technology</p>
            </div>
            
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="about-content mb-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class = "display-image">
                            <img src="/public/images/banner.jpg" alt = "Logo">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h2>Our Story</h2>
                        <p>Founded in <?php echo $foundedYear; ?>, <?php echo $companyName; ?> started with a simple mission: to make online shopping better through technology. We're a relatively new company focusing on online advertising, cloud computing, digital streaming, artificial intelligence, and e-commerce.</p>
                        <p>Our e-commerce division has quickly grown to become a key part of our business, helping retailers of all sizes succeed in the digital marketplace.</p>

                        <h3 class="card-title">Innovation</h3>
                            <p class="card-text text-muted">We constantly push the boundaries of what's possible in e-commerce technology.
                            </p>
                    </div>
                </div>
                
            </div>
            
           
            
            <div class="container py-5">
                

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4">
                            <div class="icon-wrapper bg-soft-primary">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    class="text-primary">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                </svg>
                            </div>
                            <h3 class="card-title">Innovation</h3>
                            <p class="card-text text-muted">We constantly push the boundaries of what's possible in e-commerce technology.
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4">
                            <div class="icon-wrapper bg-soft-success">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    class="text-success">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                                </svg>
                            </div>
                            <h3 class="card-title">Quality</h3>
                            <p class="card-text text-muted">We deliver reliable, high-quality solutions that our clients can depend on.</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card feature-card h-100 p-4">
                            <div class="icon-wrapper bg-soft-warning">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    class="text-warning">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                </svg>
                            </div>
                            <h3 class="card-title">Customer Focus</h3>
                            <p class="card-text text-muted">We put our customers at the center of everything we do.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-content">
                <h2>Contact Information</h2>
                <div class="contact-info">
                    <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                    <p><strong>Address:</strong> <?php echo $address; ?></p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; <?php echo $year; ?> <?php echo $companyName; ?>. All rights reserved.</p>
        </div>
    </footer>
</section>
<?php include "layouts/footer.php" ?>