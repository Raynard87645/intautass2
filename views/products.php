
<?php
require_once "../config.php";
require_once "../config/database.php";
require_once "../includes/auth.php";
include "../layout/app.php";

requireLogin();

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

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
?>


    

<div class="container">  
    <div class="row mb-4">
    <div class="col-md-6"><h3>Products</h3></div>
        <div class="col-md-6 text-left">
            <form class="d-flex" method="GET">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products..." 
                        value="<?php echo htmlspecialchars($search); ?>">
                <select name="category" class="form-select me-2" style="width: auto;">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>" 
                                <?php echo $category === $cat ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="row">
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