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
            <h1>About <?php echo $companyName; ?></h1>
            <p>Your trusted partner in e-commerce technology</p>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="about-content">
                <h2>Our Story</h2>
                <p>Founded in <?php echo $foundedYear; ?>, <?php echo $companyName; ?> started with a simple mission: to make online shopping better through technology. We're a relatively new company focusing on online advertising, cloud computing, digital streaming, artificial intelligence, and e-commerce.</p>
                <p>Our e-commerce division has quickly grown to become a key part of our business, helping retailers of all sizes succeed in the digital marketplace.</p>
            </div>
            
            <div class="about-content">
                <h2>Our Mission</h2>
                <p>At Digital Orbit, we aim to revolutionize the e-commerce experience by combining cutting-edge technology with exceptional customer service. We believe that shopping online should be easy, secure, and enjoyable for everyone.</p>
            </div>
            
            <div class="about-content">
                <h2>Our Values</h2>
                <div class="values-container">
                    <div class="value-box">
                        <h3>Innovation</h3>
                        <p>We constantly push the boundaries of what's possible in e-commerce technology.</p>
                    </div>
                    <div class="value-box">
                        <h3>Customer Focus</h3>
                        <p>We put our customers at the center of everything we do.</p>
                    </div>
                    <div class="value-box">
                        <h3>Quality</h3>
                        <p>We deliver reliable, high-quality solutions that our clients can depend on.</p>
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