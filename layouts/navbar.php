<?php 
require_once "includes/cart.php";
$itemcount = getCartTotalItems();
$search = "";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">
      <img src="/public/images/logo.jpeg" class="logo" alt = "Logo">
      <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
      Orbit
    </a>
    <form action="/products" class="d-flex input-group w-auto">
      <input
        type="search"
        name="search"
        class="form-control rounded"
        placeholder="Search"
        aria-label="Search"
        aria-describedby="search-addon"
        value="<?php echo htmlspecialchars($search); ?>"
      />
      <button type="submit" class="input-group-text border-0" id="search-addon">
        <i class="fa fa-search"></i>
      </button>
    </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
            <li class="nav-item">
              <a class="nav-link <?php  echo $_SERVER['REQUEST_URI'] == '/' ?'active' :'' ?>" aria-current="page" href="/">Home</a>
            </li>
            <?php if($_SESSION['name']){ ?>
            <li class="nav-item">
              <a class="nav-link  <?php  echo $_SERVER['REQUEST_URI'] == '/dashboard' ?'active' :'' ?>" href="/dashboard">Dashboard</a>
            </li>
            
            <?php } ?>
            <li class="nav-item">
              <a class="nav-link  <?php  echo $_SERVER['REQUEST_URI'] == '/products' ?'active' :'' ?>" href="products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  <?php  echo $_SERVER['REQUEST_URI'] == '/about-us' ?'active' :'' ?>" href="/about-us">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  <?php  echo $_SERVER['REQUEST_URI'] == '/contact' ?'active' :'' ?>" href="/contact">Contact</a>
            </li>
          </ul>
        </div>
        
        
        <?php if($_SESSION['name']){ ?>
          <div class="d-flex align-items-center gap-3">
          <a href="/cart">
            <div class="navbar-text position-relative">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <span class="position-absolute top-30 start-10 translate-middle badge rounded-pill bg-danger">
                <span id="cart-count"><?php echo getCartTotalItems() ?></span>
                <span class="visually-hidden">items</span>
              </span>
            </div>
          </a>
            <div class="dropdown ">
                <a href="#" class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img
                      src="https://i.pravatar.cc/150?u=fake@pravatar.com"
                      class="rounded-circle"
                      height="22"
                      alt="Portrait of a Woman"
                      loading="lazy"
                    />
                </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/customer-service">Customer Service</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="/cart">Cart</a></li>
                <li><a class="dropdown-item" href="/includes/logout.php">logout</a></li>
              </ul>
            </div>
          </div>
        <?php } else { ?>
          <a href="/cart">
            <div class="navbar-text position-relative">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <span class="position-absolute top-30 start-10 translate-middle badge rounded-pill bg-danger">
                <span id="cart-count"><?php echo getCartTotalItems() ?></span>
                <span class="visually-hidden">items</span>
              </span>
            </div>
          </a>
          <div class="navbar-text">
              <a href="/login" class="btn btn-primary ms-3">Login</a>
          </div>
        <?php } ?>
    </div>
</nav>