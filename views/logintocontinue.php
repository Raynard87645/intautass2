<?php 
require_once "config.php";
require_once "config/database.php";
require_once "includes/auth.php";

$username = isLoggedIn();
echo $username;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = 'Invalid email address';
    }else if (strlen($password)< 8) {
        $error = 'Password must be at least 8 characters long';
    }else if ($dbtype == "mysql" && login($email, $password)) {
        header('Location: '.$_SERVER['REQUEST_URI']);
        exit();
    }else {
        $error = 'Invalid email or password';
    }

    
}


?>
<style>
    .modal {
        display: none
    }
</style>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Login Required</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modala">Login</button>
            </div>
        </form>
        <div class="text-center mt-3">
                    <p>Don't have an account? <a href="/register">Register here</a></p>
                </div>
      </div>
    </div>
  </div>
</div>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
        keyboard: false
    })


    document.getElementById('staticBackdrop').addEventListener('hidden.bs.modal', function (event) {
        if (window.history.state && window.history.state.from)window.history.back();
        else  window.location.href = '/';
    })


    myModal.show()


</script>