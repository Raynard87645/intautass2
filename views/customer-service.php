<?php
    require_once "config.php";
    require_once "config/database.php";
    require_once "email/templates.php";
    require_once "includes/auth.php";
    include "layouts/app.php";
    requireLogin();


if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);
    $phone = trim($_POST["phone"]);

    // Validate Name
    if (empty($name)) {
        $errors[] = "name is required";
    }
    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is required.";
}
    // Validate Message
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
}

    // If No Errors, Save Message
    if ($dbtype == "mysql" && empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $message, $phone]);
        $stmt->close();
        $conn->close();

        $subject = "Customer Service";
        $company = "Orbit Eccomerce";
        $body = customerServiceTemplate($name, $company, $email, $subject);
        $content = "<p>Test content</p>";

        sendMail($subject, $body , $content, $email, $name);
        

        // $success = "Your message has been sent successfully!";
    }else if (empty($errors)) {
        $messageData = "Name: $name | Email: $email | Message: $message\n";
        file_put_contents("messages.txt", $messageData, FILE_APPEND);
        $success = "Your message has been sent successfully!";
    }
}

?>


<section class="bg-light py-5  app-content">
    <!-- Service 10 - Bootstrap Brain Component -->
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12">
        <div class="mt-5 mb-5 text-center">           
           <h2 class="display-6 fw-bolder "><span class="text-gradient d-inline">Customer Service</span></h2>
            <p class="text-muted">Let Digital Orbit bring you the best in value for all your needs.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="container-fluid">
          <div class="row gy-3 gy-md-4">
            <div class="col-12 col-lg-4">
              <div class="card ">
                <div class="card-body p-3 p-md-4 p-xxl-5 d-flex justify-content-center align-items-center">
                  <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                      <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="mb-1">Free Shipping</h4>
                    <p class="m-0 text-secondary">Eliminates shipping costs</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="card ">
                <div class="card-body p-3 p-md-4 p-xxl-5 d-flex justify-content-center align-items-center">
                  <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-chat-left-heart-fill" viewBox="0 0 16 16">
                      <path d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 3.993c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="mb-1">24/7 Support</h4>
                    <p class="m-0 text-secondary">Better shopping experience</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4">
              <div class="card ">
                <div class="card-body p-3 p-md-4 p-xxl-5 d-flex justify-content-center align-items-center">
                  <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-folder-symlink-fill" viewBox="0 0 16 16">
                      <path d="M13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2l.04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3M2.19 3q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672a1 1 0 0 1 .707.293L7.586 3zm9.608 5.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="mb-1">Free Returns</h4>
                    <p class="m-0 text-secondary">Customer's peace of mind</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="contact-container mt-5">
    <div class="row mb-4">
        <div class="mt-5 text-center">           
           <h2 class="display-6 fw-bolder "><span class="text-gradient d-inline">Get In Touch</span></h2>
            <p class="text-muted">Let Digital Orbit bring you the best in value for all your needs.</p>
        </div>
    </div>

    <!-- Detals of the Customer Service -->
    <div class="card p-4 mb-4">
        <p><strong>Address:</strong> Kingston, Jamaica</p>
        <p><strong>Call Us:</strong> +1 (876) 876-123-4567</p>
        <p><strong>Opening Hours:</strong><br></p>
        <p>Monday - Friday: 10 AM - 5 PM<br></p>
        <p>Saturday - Sunday: Closed<br></p>

    </div>

        <!-- Display Success or Error Messages -->
        <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Customer Service Form -->
    <form method="post" action="">
        <div class="mb-3">
            <label for="InputName" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="InputName" name="name" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="InputMessage" class="form-label">Message</label>
            <textarea class="form-control" id="InputMessage" name="message" rows="4" placeholder="Enter your message" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</section>

<?php include "layouts/footer.php" ?>
