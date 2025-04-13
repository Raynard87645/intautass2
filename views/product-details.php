
<?php
require_once "config.php";
require_once "config/database.php";
require_once "includes/auth.php";
require_once "includes/cart.php";
include "layouts/app.php";

$id = $params['id'];
if (preg_match("/[a-z]/i", $id)) {
    http_response_code(500);
    include "views/notfound.php";
    include "layouts/footer.php";
    die();
}else{
    $product = null;
    $category = "";
    $result = $conn->query("SELECT * FROM products WHERE id = $id");

    if ($result === false) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $category = $product["category"];
    } else {
        echo "No user found";
    }

    $stmt = $conn->prepare("SELECT * FROM products WHERE NOT id = $id AND category = ? LIMIT 4");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_array()) {
            $products[] = $row;
        }
    }

    $result->close();
    $conn->close();
}
$productincart = productInCart($product['id']);
$productquantity = !empty($productincart)? $productincart['quantity'] :1;


function renderHtml($content) {
    echo $content;
}

// echo htmlspecialchars($product["item_features"]);
foreach(json_decode($product["item_features"]) as $rear) {
    echo $rear;
}
// clearCart()
?>

<style>
    .product-display-img {
        height: calc(100% - 80px);
        border-radius: 8px;
    }
    .product-display-img img {
        object-fit: cover;
        border-radius: 8px;
        height: 100%;
    }
</style>

<section class="bg-light py-5 app-content">
    <div class="container py-5">
        <div class="row gx-5">
        <aside class="col-lg-6">
            <div class="border rounded-4 mb-3 d-flex justify-content-center product-display-img">
            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?php echo htmlspecialchars($product['image_url']);?>">
                <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo htmlspecialchars($product['image_url']);?>" />
            </a>
            </div>
            <div class="d-flex justify-content-center mb-3">
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="/public/images/noimage.jpg" class="item-thumb">
                <img width="60" height="60" class="rounded-2" src="/public/images/noimage.jpg" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="/public/images/noimage.jpg" class="item-thumb">
                <img width="60" height="60" class="rounded-2" src="/public/images/noimage.jpg" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="/public/images/noimage.jpg" class="item-thumb">
                <img width="60" height="60" class="rounded-2" src="/public/images/noimage.jpg" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="/public/images/noimage.jpg" class="item-thumb">
                <img width="60" height="60" class="rounded-2" src="/public/images/noimage.jpg" />
            </a>
            <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="/public/images/noimage.jpg" class="item-thumb">
                <img width="60" height="60" class="rounded-2" src="/public/images/noimage.jpg" />
            </a>
            </div>
            <!-- thumbs-wrap.// -->
            <!-- gallery-wrap .end// -->
        </aside>
        <main class="col-lg-6">
            <div class="ps-lg-3">
            <h4 class="title text-dark">
                <?php echo htmlspecialchars($product['name']); ?>
            </h4>
            <div class="d-flex flex-row my-3">
                <div class="text-warning mb-1 me-2">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <span class="ms-1">
                    4.5
                </span>
                </div>
                <span class="text-muted"><i class="fa fa-cart-arrow-down fa-sm mx-1"></i>154 orders</span>
                <?php if($product['status']){ ?>
                <span class="text-success ms-2">In stock</span>
                <?php }else{ ?>
                <span class="text-danger ms-2">Out stock</span>
                <?php } ?>
            </div>

            <div class="mb-3">
                <span class="h5">$<?php echo number_format($product['price'], 2); ?></span>
                <span class="text-muted">/per unit</span>
            </div>

            <p>
            <?php echo htmlspecialchars($product['description']); ?>
            </p>

            <div class="row">
                <dt class="col-3">Type:</dt>
                <dd class="col-9">Regular</dd>

                <dt class="col-3">Color</dt>
                <dd class="col-9">Brown</dd>

                <dt class="col-3">Material</dt>
                <dd class="col-9">Cotton, Jeans</dd>

                <dt class="col-3">Brand</dt>
                <dd class="col-9">Reebook</dd>
            </div>

            
            <?php if($product['status']){ ?>
            <hr />
            <div class="row mb-4">
                <?php if($product['sizes']){ ?>
                <div class="col-md-4 col-6">
                    <label class="mb-2">Size</label>
                    <select class="form-select border border-secondary" style="height: 35px;">
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                    </select>
                </div>
                <?php } ?>
                <!-- col.// -->
                <div class="col-md-4 col-6 mb-3">
                <label class="mb-2 d-block">Quantity</label>
                <div class="input-group mb-3" style="width: 170px;">
                    <button data-pid="<?php echo $product['id']?>" data-update="minus" class="btn btn-white border border-secondary px-3 update-cart-item-button" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                    <i class="fa fa-minus"></i>
                    </button>
                    <input type="text" id="cart-quantity<?php echo $product['id'] ?>" value="<?php echo $productquantity; ?>" class="form-control text-center border border-secondary" placeholder="<?php echo $productquantity; ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                    <button data-pid="<?php echo $product['id']?>" data-update="add" class="btn btn-white border border-secondary px-3 update-cart-item-button" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                    <i class="fa fa-plus"></i>
                    </button>
                </div>
                </div>
            </div>
            
            <a href="/cart" class="btn btn-warning shadow-0"> Buy now </a>
            <?php if(empty($productincart)){ ?><a href="#" class="btn btn-primary shadow-0 add-to-cart-button"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a> <?php }?>
            <?php } ?>
            </div>
        </main>
        </div>
    </div>

    <div class="container bg-light border-top py-4">
        <div class="row gx-4">
            <div class="col-lg-8 mb-4">
                <div class="border rounded-2 px-3 py-2 bg-white">

                <!-- Pills content -->
                <div class="tab-content" id="ex1-content">
                    <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <?php echo 
                        $product['item_description'];
                    ?>
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($product["item_features"] as $pf): ?>
                                <li><i class="fa fa-check text-success me-2"></i><?php echo $pf['description']?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <table class="table border mt-3 mb-2">
                        <tr>
                        <th class="py-2">Display:</th>
                        <td class="py-2">13.3-inch LED-backlit display with IPS</td>
                        </tr>
                        <tr>
                        <th class="py-2">Processor capacity:</th>
                        <td class="py-2">2.3GHz dual-core Intel Core i5</td>
                        </tr>
                        <tr>
                        <th class="py-2">Camera quality:</th>
                        <td class="py-2">720p FaceTime HD camera</td>
                        </tr>
                        <tr>
                        <th class="py-2">Memory</th>
                        <td class="py-2">8 GB RAM or 16 GB RAM</td>
                        </tr>
                        <tr>
                        <th class="py-2">Graphics</th>
                        <td class="py-2">Intel Iris Plus Graphics 640</td>
                        </tr>
                    </table>
                    </div>
                    
                </div>
                <!-- Pills content -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="px-0 border rounded-2 shadow-0">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Similar items</h5>
                    <?php foreach ($products as $sp): ?>
                    <div class="d-flex mb-3">
                        <a href="#" class="me-3">
                            <img onerror="this.src = '/public/images/noimage.jpg'" src="<?php echo htmlspecialchars($sp['image_url']);?>" alt="<?php echo htmlspecialchars($product['name']);?>" style="width: 96px; height: 96px; object-fit: cover;" class="img-md img-thumbnail" />
                        </a>
                        <div class="info">
                            <a href="/products/<?php echo $sp['id'] ?>" class="nav-link mb-1 p-0">
                                <?php echo htmlspecialchars($sp['name']); ?>
                            </a>
                            <p class="text-muted">Category: <?php echo $sp['category'] ?></p>
                            <strong class="text-dark"> $<?php echo number_format($product['price'], 2); ?></strong>
                        </div>
                    </div>
                    <?php endforeach ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    
</section>

<script>
    document.querySelector('.add-to-cart-button')?.addEventListener("click", () => {
        const id = "<?php echo $product['id'] ?>"
        const name = "<?php echo $product['name'] ?>"
        const price = "<?php echo $product['price'] ?>"
        const avatar = "<?php echo $product['id'] ?>";
        const category = "<?php echo $product['category'] ?>";
        
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

    document.querySelectorAll('button.update-cart-item-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-pid');
            let quantity = document.getElementById(`cart-quantity${id}`)?.value
            const update = this.getAttribute('data-update');
            switch (update) {
                case "add":
                    quantity = parseInt(quantity) + 1
                    break;
            
                default:
                    quantity = parseInt(quantity) - 1
                    break;
            }
           
            fetch('/update-cartitem', {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}&quantity=${quantity}`//JSON.stringify({id: id, name: name, price: price, avatar: avatar, category: category})
            }).then(response => response.text())
            .then(response => {
                const data= JSON.parse(response)
                document.getElementById("cart-count").innerHTML = data['count']

                document.getElementById(`cart-quantity${id}`).value = quantity
            });

            

        });
        
    });

  
</script>

<?php include "layouts/footer.php" ?>