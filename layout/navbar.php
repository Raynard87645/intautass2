<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Quick Cart</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
            <li class="nav-item">
              <a class="nav-link <?php  echo basename($_SERVER['PHP_SELF']) == 'index.php' ?'active' :'' ?>" aria-current="page" href="/">Home</a>
            </li>
            <?php if($_SESSION['name']){ ?>
            <li class="nav-item">
              <a class="nav-link  <?php  echo basename($_SERVER['PHP_SELF']) == 'home.php' ?'active' :'' ?>" href="/views/home.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  <?php  echo basename($_SERVER['PHP_SELF']) == 'products.php' ?'active' :'' ?>" href="/views/products.php">Products</a>
            </li>
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link  <?php  echo basename($_SERVER['PHP_SELF']) == 'contact.php' ?'active' :'' ?>" href="/views/contact.php">Contact</a>
            </li>
          </ul>
        </div>
        <?php if($_SESSION['name']){ ?>
          <div class="navbar-text">
              <!-- Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>! -->
              <a href="/includes/logout.php" class="btn btn-primary ms-3">Logout</a>
          </div>
        <?php } else { ?>
          <div class="navbar-text">
              <a href="/views/auth/login.php" class="btn btn-primary ms-3">Login</a>
          </div>
        <?php } ?>
    </div>
</nav>