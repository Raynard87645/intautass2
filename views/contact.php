<?php 
    require_once "../includes/auth.php";
    include "../layout/app.php";

    $errors = [];
    $success = "";

    // Form Submission Handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);
        $phone = trim($_POST["phone"]);

        // Validate Name
        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        // Validate Email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email is required.";
        }

        // Validate Phone (Optional, but should be numbers)
        if (!empty($phone) && !preg_match('/^\d{10}$/', $phone)) {
            $errors[] = "Phone number must be 10 digits.";
        }

        // Validate Message
        if (empty($message)) {
            $errors[] = "Message cannot be empty.";
        }

        // If No Errors, Save Message
        if (empty($errors)) {
            $messageData = "Name: $name | Email: $email | Phone: $phone | Message: $message\n";
            file_put_contents("messages.txt", $messageData, FILE_APPEND);
            $success = "Your message has been sent successfully!";
        }
    }


?>


<section class="bg-light py-5  app-content"">
<div class="contact-container mt-5">
    <h2 class="text-center">Contact Us</h2>

    <!-- Business Contact Details -->
    <div class="card p-4 mb-4">
        <h4>Business Contact Details</h4>
        <p><strong>Location:</strong> Kingston, Jamaica</p>
        <p><strong>Phone:</strong> +1 876-123-4567</p>
        <p><strong>Email:</strong> QuickFood@gmail..com</p>
        <p><strong>Operating Hours:</strong> Mon-Fri, 9 AM - 5 PM</p>
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

    <!-- Contact Form -->
    <form method="post" action="contact.php">
        <div class="mb-3">
            <label for="InputName" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="InputName" name="name" placeholder="Enter your name" required>
        </div>

        <div class="mb-3">
            <label for="InputEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Enter your email" required>
        </div>

        <div class="mb-3">
            <label for="InputPhone" class="form-label">Phone (Optional)</label>
            <input type="text" class="form-control" id="InputPhone" name="phone" placeholder="Enter your phone number">
        </div>

        <div class="mb-3">
            <label for="InputMessage" class="form-label">Message</label>
            <textarea class="form-control" id="InputMessage" name="message" rows="4" placeholder="Enter your message" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
    </div>
</section>

<?php include "../layout/footer.php" ?>