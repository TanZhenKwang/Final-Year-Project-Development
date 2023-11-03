<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <style>
        .add-cart-link {
            text-decoration: none;
        }

        /* Style for the button */
        .add-cart-button {
            background-color: transparent;
            border: none;
            color: red;
            cursor: pointer;
            padding: 0;
        }
    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php 
        include 'header.php';
        include 'connect.php';

        $result = mysqli_query($db, "SELECT product_id, product_image, product_title, product_brand, product_desc, product_price FROM products") or die("Query is incorrect.....");

    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form id="search-form" method="POST">
                                <input type="text" name="search" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                            <?php
                                include 'connect.php'; // Include your database connection script

                                if (isset($_POST['search'])) {
                                    $search = '%' . $_POST['search'] . '%'; // Add wildcard characters to match partial strings
                                
                                    // Perform the database query
                                    $sql = "SELECT * FROM products WHERE product_title LIKE ?";
                                    $stmt = $db->prepare($sql);
                                
                                    if ($stmt) {
                                        $stmt->bind_param("s", $search); // "s" indicates a string parameter
                                        $stmt->execute();
                                
                                        $result = $stmt->get_result();
                                
                                        if ($result->num_rows > 0) {
                                            // Display search results
                                            while ($row = $result->fetch_assoc()) {
                                                // Output search results as needed, for example, the product title
                                                $product_id = $row['product_id'];
                                                $product_title = $row['product_title'];
                                
                                                // Create a link to the product details page with the product_id
                                                $product_details_url = "shop-details.php?product_id=" . $product_id;
                                
                                                echo '<a href="' . $product_details_url . '"> ' . $product_title . '</a><br>';
                                            }
                                        } else {
                                            echo "No results found.";
                                        }
                                
                                        $stmt->close();
                                    } else {
                                        echo "Error in preparing the statement.";
                                    }
                                }
                            ?>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php
                                                        $result = mysqli_query($db, "SELECT cat_id, cat_title FROM category") or die("Query is incorrect.....");
                                                        
                                                        if ($result->num_rows > 0) {
                                                            $uniqueCats = [];

                                                            // Loop through the results
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $cat = $row['cat_title'];
                                                                // Output the brand as list item
                                                                echo '<li><a href="?category=' . urlencode($cat) . '">' . $cat . '</a></li>';
                                                                
                                                                // Add the brand to the uniqueBrands array
                                                                $uniqueCats[] = $cat;
                                                            }
                                                        }

                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <?php
                                                        $result = mysqli_query($db, "SELECT brand_id, brand_title FROM brands") or die("Query is incorrect.....");
                                                        
                                                        if ($result->num_rows > 0) {
                                                            $uniqueBrands = [];

                                                            // Loop through the results
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $brand = $row['brand_title'];
                                                                // Output the brand as list item
                                                                echo '<li><a href="?brands=' . urlencode($brand) . '">' . $brand . '</a></li>';
                                                                
                                                                // Add the brand to the uniqueBrands array
                                                                $uniqueBrands[] = $brand;
                                                            }
                                                        }

                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                            // Check if a category filter is provided in the URL
                            if (isset($_GET['category']) && !empty($_GET['category'])) {
                                $selectedCategory = mysqli_real_escape_string($db, $_GET['category']);
                                $query = "SELECT p.product_id, p.product_image, p.product_title, p.product_price 
                                        FROM products p
                                        INNER JOIN category c ON p.product_cat = c.cat_id
                                        WHERE c.cat_title = '$selectedCategory'";
                            } else if (isset($_GET['brands']) && !empty($_GET['brands'])) {
                                // Check if a brand filter is provided in the URL
                                $selectedBrand = mysqli_real_escape_string($db, $_GET['brands']);
                                $query = "SELECT p.product_id, p.product_image, p.product_title, p.product_price 
                                        FROM products p
                                        INNER JOIN brands b ON p.product_brand = b.brand_id
                                        WHERE b.brand_title = '$selectedBrand'";
                            } else {
                                // If no category or brand is selected, retrieve all products
                                $query = "SELECT product_id, product_image, product_title, product_price FROM products";
                            }

                            $result = mysqli_query($db, $query) or die("Query is incorrect.....");

                            if ($result->num_rows > 0) {
                                // Loop through the results and display products
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = $row['product_id'];
                                    $image = $row['product_image'];
                                    $product_name = $row['product_title'];
                                    $price = $row['product_price'];

                                    $imagePath = './admin/products_images/' . $row["product_image"];

                                    $product_details_url = "shop-details.php?product_id=" . $product_id;

                                    echo '<div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <a href="' . $product_details_url . '"> 
                                                <div class="product__item__pic set-bg" data-setbg="' . $imagePath . '">
                                            </a>
                                                <ul class="product__hover">
                                                    <li>
                                                        <form action="wishlist-code.php" method="post">
                                                            <input type="hidden" name="product_image" value="' . $image . '">
                                                            <input type="hidden" name="product_name" value="' . $product_name . '">
                                                            <input type="hidden" name="product_price" value="' . $price . '">
                                                            <input type="hidden" name="product_id" value="' . $product_id . '">
                                                            <button type="submit" value="Add to Wishlist" name="add_to_wishlist" class="btn btn-default" style="background-color: white; width: 37px; height: 37px; position: relative;">
                                                                <i class="fa fa-heart-o" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li><a href="' . $product_details_url . '"><img src="img/icon/search.png" alt=""></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6>' . $product_name . '</h6>
                                                <form action="shop-details-code.php" method="post">
                                                    <input type="hidden" name="product_image" value="' . $image . '">
                                                    <input type="hidden" name="product_name" value="' . $product_name . '">
                                                    <input type="hidden" name="product_price" value="' . $price . '">
                                                    <input type="hidden" name="product_id" value="' . $product_id . '">
                                                    <a href="shopping-cart.php" class="add-cart-link">
                                                        <button type="submit" value="Add to Cart" name="add_to_cart" class="add-cart-button"><b>+ Add to Cart</b></button>
                                                    </a>
                                                </form>
                                                <h5>RM ' . $price . '</h5>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo "No products found.";
                            }
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <div id="customer-service-chatbox" style="position: fixed; bottom: 20px; right: 20px; z-index: 100;">
        <div id="chat-button">
            <a href="./chat/login.php"><img src="img/customer-service.png" alt="Chat" width="50" height="50" style="cursor: pointer;"></a>
        </div>
    </div>

    <?php include 'footer.php';?>

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    
</body>

</html>