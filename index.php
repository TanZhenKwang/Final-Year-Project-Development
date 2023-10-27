<!DOCTYPE html>
<html lang="en">
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monkey Apes | Home Page</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
    

    <?php include 'header.php';?>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="./shop.php" class="primary-btn">Shop now<span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Winter Collections 2030</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                    commitment to exceptional quality.</p>
                                <a href="./shop.php" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Clothing Collections 2030</h2>
                            <a href="./shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="./shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Spring 2030</h2>
                            <a href="./shop.php">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                    </ul>
                </div>
            </div>
            <div class='row product__filter'> 
                <?php
                    include 'connect.php';
                                    
                    $result = mysqli_query($db, "SELECT product_id, product_image, product_title, product_brand, product_desc, product_price FROM products") or die("Query is incorrect.....");
                    if(mysqli_num_rows($result) > 0){

                        while($row = mysqli_fetch_array($result)){
                            $product_id    = $row['product_id'];
                            $product_brand = $row['product_brand'];
                            $product_title = $row['product_title'];
                            $product_price = $row['product_price'];
                            $product_image = $row['product_image'];

                            $imagePath = './admin/products_images/' . $row["product_image"];
                            $product_details_url = "shop-details.php?product_id=" . $product_id;

                            echo"         
                                <div class='col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals'>
                                    <div class='product__item'>
                                        <a href='shop-details.php?p=$product_id'><div class='product__item__pic set-bg' data-setbg='". $imagePath . "'></a>

                                            <span class='label'>New</span>
                                            <ul class='product__hover'>
                                                <li>
                                                    <form action='wishlist-code.php' method='post'>
                                                        <input type='hidden' name='product_image' value='". $product_image ."'>
                                                        <input type='hidden' name='product_name' value='". $product_title ."'>
                                                        <input type='hidden' name='product_price' value='". $product_price ."'>
                                                        <input type='hidden' name='product_id' value='". $product_id ."'>
                                                        <button type='submit' value='Add to Wishlist' name='add_to_wishlist' class='btn btn-default' style='background-color: white; width: 37px; height: 37px; position: relative;'>
                                                            <i class='fa fa-heart-o' style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);'></i>
                                                        </button>
                                                    </form>
                                                </li>
                                        
                                                <li><a href='" . $product_details_url . "'><img src='img/icon/search.png' alt=''></a></li>
                                            </ul>
                                        </div>
                                        <div class='product__item__text'>
                                            <h6>$product_title</h6>
                                            <form action='shop-details-code.php' method='post'>
                                                <input type='hidden' name='product_image' value='". $product_image ."'>
                                                <input type='hidden' name='product_name' value='". $product_title ."'>
                                                <input type='hidden' name='product_price' value='". $product_price ."'>
                                                <input type='hidden' name='product_id' value='". $product_id ."'>
                                                <a href='shopping-cart.php' class='add-cart-link'>
                                                    <button type='submit' value='Add to Cart' name='add_to_cart' class='add-cart-button'><b>+ Add to Cart</b></button>
                                                </a>
                                            </form>
                                        
                                            <br />
                                            <h5>RM $product_price</h5>
                                        </div>
                                    </div>
                                </div>
                            ";
                        };
                    }
                ?> 
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>RM 29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="shop.php" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Ratings Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>The user giving our website comment!</span>
                        <h2>Comments</h2>
                    </div>
                </div>
            </div>
            <div class="container mt-5 mb-5">
                <div class="row g-2">
                    <?php
                        $query = "SELECT r.rating, r.review, c.cust_id, c.username 
                                FROM ratings r
                                INNER JOIN user c ON r.cust_id = c.cust_id";
                        $result = $db->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $rating = $row['rating'];
                                $username = $row['username'];
                                $review = $row['review'];

                                // Generate HTML for each user's ratings and review
                                echo '<div class="col-md-4">
                                        <div class="card p-3 text-center px-4">
                                            <div class="user-content">
                                                <h5 class="mb-0">' . $username . '</h5>
                                                <br />
                                                <p>' . $review . '</p>
                                            </div>
                                            <div class="ratings">';
                                            
                                for ($i = 1; $i <= 5; $i++) {
                                    $starClass = ($i <= $rating) ? 'fa fa-star' : 'fa fa-star-o';
                                    echo '<i class="' . $starClass . '"></i>';
                                }
                                            
                                echo '</div>
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo 'No ratings and reviews found.';
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Ratings Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Monkey Apes is an artisanal fashion clothing brand that stands at the intersection of
                            artistry, design selection, and impeccable craftsmanship. With an unwavering commitment to
                            creating wearable masterpieces, this brand has become synonymous with luxury, precision, and
                            the celebration of creativity.</p>
                        <h3>#Monkey Apes</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <br /><br /><br /><br />

    <?php include 'footer.php';?>

    <div id="customer-service-chatbox" style="position: fixed; bottom: 20px; right: 20px; z-index: 100;">
        <div id="chat-button">
            <a href="./chat/login.php"><img src="img/customer-service.png" alt="Chat" width="50" height="50" style="cursor: pointer;"></a>
        </div>
    </div>

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