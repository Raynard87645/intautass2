

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/products.php">Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/views/home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/views/welcome.php">Welcome</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/views/products.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/views/contact.php">Contact</a>
            </li>
          </ul>
        </div>
        <?php if($_SESSION['name']){ ?>
          <div class="navbar-text">
              Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!
              <a href="/logout.php" class="btn btn-outline-light ms-3">Logout</a>
          </div>
        <?php } else { ?>
          <div class="navbar-text">
              <a href="/views/auth/login.php" class="btn btn-outline-light ms-3">Login</a>
          </div>
        <?php } ?>
    </div>
</nav>