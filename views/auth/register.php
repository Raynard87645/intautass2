
<?php
require_once "config.php";
require_once "config/database.php";
require_once "includes/auth.php";
require_once "includes/mail.php";
require_once "email/templates.php";
include "layouts/auth.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
  
    if ($password !== $password2) {
        $error = 'Passwords do not match';
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = 'Invalid email address';
    }else if (strlen($password)< 8) {
        $error = 'Password must be at least 8 characters long';
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, email, password_hash) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $username, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $user = login($email, $password);
            $stmt->close();
            $conn->close();
           
            $subject = "User Registration";
            $company = "Orbit Eccomerce";
            $name = $user["first_name"]. " ". $user["last_name"];
            $body = registrationTemplate($name, $company, $email, $username);
            $content = "<p>Test content</p>";

            sendMail($subject, $body , $content, $email, $name);
            header('Location: /dashboard');
            exit();
        } catch (PDOException $e) {
            $error = 'Name or email already exists';
        }
    }

}

?>


<div class="row justify-content-center align-items-center auth-layout">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Register</h2>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form method="POST" class="<?php echo !empty($error)? 'was-validated': ''; ?>" novalidate>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control invalid" id="first_name" name="first_name" value="<?php echo htmlspecialchars($firstname); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control invalid" id="last_name" name="last_name" value="<?php echo htmlspecialchars($lastname); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password2" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
