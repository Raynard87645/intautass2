
<?php
require_once "../../config.php";
require_once "../../config/database.php";
require_once "../../config/database.php";
require_once "../../includes/auth.php";
include "../../layout/auth.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = 'Invalid email address';
    }else if (strlen($password)< 8) {
        $error = 'Password must be at least 8 characters long';
    }else if ($dbtype == "mysql" && login($email, $password)) {
        header('Location: ../welcome.php');
        exit();
    }else if (loginCSV($email, $password)) {
        header('Location: ../welcome.php');
        exit();
    } else {
        $error = 'Invalid email or password';
    }

    
}
?>


<div class="row justify-content-center align-items-center auth-layout">
    <div class="col-md-6 col-lg-4">
        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login</h2>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form method="POST" class="<?php echo !empty($error)? 'was-validated': ''; ?>" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
