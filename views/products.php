
<?php
require_once "config.php";
require_once "config/database.php";
require_once "includes/auth.php";
require_once "includes/cart.php";
include "layouts/app.php";

//ensure only logged in Session can view this page
requireLogin();




$search = strtolower($_GET['search']) ?? '';
$category = strtolower($_GET['category']) ?? '';
$loadingitems = [1,2,3,4,5,6];
// $products = getProducts($search, $category);
// $categories = getCategories();

$query = "SELECT * FROM products WHERE 1=1";
$params = [];

if ($search) {
    $query .= " AND name LIKE ?";
    $params[] = "%$search%";
}

if ($category) {
    $query .= " AND category = ?";
    $params[] = $category;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while($row = $result->fetch_array()) {
        $products[] = $row;
    }
}


$categoryStmt = $conn->query("SELECT DISTINCT category FROM products");
$categories = [];// $categoryStmt->fetchAll(PDO::FETCH_COLUMN);
if ($categoryStmt->num_rows > 0) {
    // Output data of each row
    while ($row = $categoryStmt->fetch_assoc()) {
        $categories[] = $row["category"];
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();


function getProducts($search, $category) {
    global $productsCSV;
    
    $results = [];

    if (($handle = fopen($productsCSV, 'r')) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ',');
        

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $products = array_combine($headers, $row);
            switch (true) {
                case !empty($search) && !empty($category):
                    if (strpos(strtolower($products["category"]), $category) !== FALSE && strpos(strtolower($products["name"]), $search) !== FALSE) $results[] = $products;
                    break;

                case empty($search) && !empty($category):
                    if (strpos(strtolower($products["category"]), $category) !== FALSE) $results[] = $products;
                    break;

                case !empty($search) && empty($category):
                    if (strpos(strtolower($products["name"]), $search) !== FALSE) $results[] = $products;
                    break;
                
                default:
                    $results[] = $products;
                    break;
            }
            
        }

        // Close the file handle
        fclose($handle);
    }
    return $results;
}

function getCategories() {
    global $productsCSV;
    
    $results = [];

    if (($handle = fopen($productsCSV, 'r')) !== FALSE) {
        $headers = fgetcsv($handle, 1000, ',');
        

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $products = array_combine($headers, $row);
            $results[] = $products["category"];
        }

        // Close the file handle
        fclose($handle);
    }
    return array_unique($results);
}

// clearCart()

?>


    
<section class="bg-light py-5 app-content">
    <div class="container">  
        <div class="row mb-4">
            <div class="col-md-12"><h3>Hello, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h3></div>
            <div class="col-md-6"><h3>Products</h3></div>
            <div class="col-md-6 text-left">
                <form class="d-flex" method="GET">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search products..." 
                            value="<?php echo htmlspecialchars($search); ?>">
                    <select name="category" class="form-select me-2" style="width: auto;">
                        <option value="" <?php echo $_GET['category'] === "" ? 'selected' : ''; ?>>All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>" 
                                    <?php echo $_GET['category'] === $cat ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            <?php if(empty($products)): ?>
                <div class="col-md-12">
                    <div class="no-item-container">
                        <img src="/public/images/no-item-found.webp" alt="no-item"/>
                        <h4>No Product Found</h4>
                    </div>
                </div>
            <?php endif ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($product['image_url']);?>" 
                                class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <a href="/products/<?php echo $product['id'] ?>"><h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5></a>
                            <p class="card-text"><?php $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); echo $description; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold">$<?php echo number_format($product['price'], 2); ?></span>
                                <span class="badge bg-<?php echo $product['status'] ? 'success' : 'danger'; ?>">
                                    <?php echo $product['status'] ? 'Instock' : 'Outstock'; ?>
                                </span>
                            </div>
                            <?php if($product['status']){ ?>
                                

                                <button type="button" class="btn btn-warning btn-sm mt-2 add-to-cart-button"  data-pid="<?php echo $product['id'] ?>" data-price="<?php echo $product['price'] ?>" data-name="<?php echo $product['name'] ?>" data-avatar="<?php echo $product['image_url'] ?>"  data-category="<?php echo $product['category'] ?>">Add to cart</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            

        </div>

    </div>
</section>

<script>
    document.querySelectorAll('button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-pid');
            const name = this.getAttribute('data-name');
            const price = this.getAttribute('data-price');
            const avatar = this.getAttribute('data-avatar');
            const category = this.getAttribute('data-category');
           
            fetch('/addcart', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}&name=${name}&price=${price}&avatar=${avatar}&category=${category}`//JSON.stringify({id: id, name: name, price: price, avatar: avatar, category: category})
            }).then(response => response.text())
            .then(data => {
                document.getElementById("cart-count").innerHTML = data
            });

            

        });
        
    });

  
</script>
<?php include "layouts/footer.php" ?>