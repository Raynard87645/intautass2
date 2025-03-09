
<?php
require_once "../../config.php";
require_once "../../config/database.php";
require_once "../../includes/auth.php";
include "../../layout/auth.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    
    if ($password !== $password2) {
        $error = 'Passwords do not match';
    } else {
        try {
            $rowcount = 0;
            $userexist = false;

            if (($handle = fopen($usersCSV, 'r')) !== FALSE) {
                $headers = fgetcsv($handle, 1000, ',');
                $results = [];
                $rowcount = count($headers);
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $users = array_combine($headers, $row);
                    if (strpos($users["email"], $email) !== FALSE || strpos($users["username"], $username) !== FALSE) {
                        $userexist = true;
                    }
                }
                fclose($handle);
            }   
            if (!$userexist && ($handle = fopen($usersCSV, 'a')) !== FALSE) {
                // Write user's data as a row in the CSV file
                fputcsv($handle, [$rowcount, $name, $username, $email, password_hash($password, PASSWORD_DEFAULT)]);
                $_SESSION['user_id'] = $rowcount;
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                header('Location: ../products.php');
                exit();
                
            }else {
                $error = "Username or email already exists";
            }
        } catch (PDOException $e) {
            $error = 'Username or email already exists';
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
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control invalid" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
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
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
