
<?php
// require_once "../config.php";
require_once "../config/database.php";
require_once "../includes/auth.php";
include "../layout/app.php";

//ensure only logged in Session can view this page
requireLogin();

$search = strtolower($_GET['search']) ?? '';
$category = strtolower($_GET['category']) ?? '';
$loadingitems = [1,2,3,4,5,6];
$products = getProducts($search, $category);
$categories = getCategories();
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
?>


    
<section class="bg-light py-5">
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
                    <?php $product; ?>
                        <img src="<?php echo htmlspecialchars($product['image_url']);?>" 
                                class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>"
                                style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text"><?php $description = htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); echo $description; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-5 fw-bold">$<?php echo number_format($product['price'], 2); ?></span>
                                <span class="badge bg-<?php echo $product['status'] ? 'success' : 'danger'; ?>">
                                    <?php echo $product['status'] ? 'Instock' : 'Outstock'; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            

        </div>

    </div>
</section>


<?php include "../layout/footer.php" ?>