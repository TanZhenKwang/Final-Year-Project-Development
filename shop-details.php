<?php 
    
    include 'header.php';
    include 'connect.php';

    if (isset($_SESSION['cust_id'])) {
        $cust_id = $_SESSION['cust_id'];
    } else {
        echo '<div class="alert alert-warning" role="alert">Please log in to search products.</div>';
        exit; // Stop script execution
    }

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Shop Details</title>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="css/Modal/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

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

        .sizecolor {
            text-align: center;
            margin: 0 auto;
            width: 13%;
        }
    
        .row1 {
            display: flex;
            justify-content: space-between;
        }

        .row2 {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        details {
            margin-right: 80px;
        }


        .button-container-right {
            position: fixed;
            top: 100%; /* Adjust as needed */
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        /* Style for the buttons, adjust as needed */
        #virtualFittingRoomBtnContainer {
            float: left;
            margin-right: 10px; /* Adjust the margin as needed */
        }

        #virtualFittingRoomBtn {
            background-color: #FFCAAF; /* Change the background color as needed */
            color: white;
            border: none;
            padding: 10px 20px;
            left: 100px; /* Move the button 100 pixels to the left */
            cursor: pointer;
        }


        /* Style for the "Customer Service" button (adjust as needed) */
        #customer-service-chatbox {
            position: fixed;
            bottom: 50px;
            right: 200px;
            z-index: 100;
        }

        .container-fittingroom {
            background-color: white;
            padding: 10px; /* Add padding for spacing */
            border: 1px solid #ccc; /* Add a border for clarity */
        }

        .container-fittingroom button {
            width: 100%; /* Make the button span the full width */
        }
    
        #fittingRoomContainer {
            text-align: center; /* Center its child elements horizontally */
        }

        #fittingRoomImage {
            display: block; /* Make the image a block-level element */
            margin: 0 auto; /* Center the image horizontally */
        }

        .content-container {
            max-width: 100px; /* Adjust the maximum width as needed */
            margin: 0 auto; /* Center the container horizontally */
            padding: 20px; /* Add padding for spacing */
        }


    </style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
            <!-- Shop Details Section Begin -->
            <section class="shop-details">
                <div class="product__details__pic">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__details__breadcrumb">
                                    <a href="./index.php">Home</a>
                                    <a href="./shop.php">Shop</a>
                                    <span>Product Details</span>
                                </div>
                            </div>
                        </div>

            <?php
                $product_id = $_GET['product_id'];
                
                $sql = mysqli_query($db,"SELECT * FROM products where product_id= $product_id");

                while($row = mysqli_fetch_array($sql)){
                    $product_image = $row["product_image"];
                    $product_title = $row["product_title"];
                    $product_price = $row["product_price"];
                    $product_id = $row["product_id"];

                    $imagePath = './admin/products_images/' . $row["product_image"];
                
                    echo'
                        <div class="row">
                            <div class="col-lg-3 col-md-3">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                            <div class="product__thumb__pic set-bg"  data-setbg="'. $imagePath . '">
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__pic__item">
                                            <img src="'. $imagePath .'" alt="Product Image" width="350" height="500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__details__content">
                    <div class="container">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-10">
                                <div class="product__details__text">
                                    <h4>'. $row['product_title'] .'</h4>
                                    <h3>RM '. $row['product_price'] .'</h3>
                                    <br />
                                    <div class="product__details__option">'; 
            ?>  
                                            <form action="shop-details-code.php" method="post">
                                            <div class="sizecolor">
                                            <?php
                                                $product_id = $_GET['product_id'];

                                                include 'connect.php';

                                                $product_id = mysqli_real_escape_string($db, $product_id);
                                   
                                                $sql2 = "SELECT products_info.productsinfo_id, products_info.quantity, size.size_title, color.color_title
                                                        FROM products_info
                                                        INNER JOIN size ON size.size_id = products_info.size
                                                        INNER JOIN color ON color.color_id = products_info.color
                                                        WHERE products_info.product = '$product_id'";

                                                $result2 = $db->query($sql2);

                                                if ($result2->num_rows > 0) {
                                                    echo '<label for="productsinfo">Size and Color:</label>';
                                                    echo '<br />';
                                                    echo '<select id="productsinfo" name="productsinfo">';

                                                    while ($row2 = $result2->fetch_assoc()) {
                                                        $productsinfo_id = $row2['productsinfo_id'];
                                                        $quantity = $row2['quantity'];
                                                        $size_title = $row2['size_title'];
                                                        $color_title = $row2['color_title'];

                                                        echo "<option value='{$productsinfo_id}'>{$size_title} - {$color_title}</option>";
                                                    }

                                                    echo '</select>';
                                                } else {
                                                    echo "No size or color options available for this product.";
                                                }
                                            ?>
                                            </div>

                                            <br /><br />

            <?php           
                                    echo'<br />
                                    <div class="product__details__cart__option">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="number" value="1" id="quantityInput" name="quantity">
                                            </div>
                                        </div>
                                    </div>

                                        <br /><br />
                                        
                                        <form action="shop-details-code.php" method="post">
                                        <input type="hidden" name="product_image" value="'. $product_image .'">
                                        <input type="hidden" name="product_name" value="'. $product_title .'">
                                        <input type="hidden" name="product_price" value="'. $product_price .'">
                                        <input type="hidden" name="product_id" value="'. $product_id .'">
                                            <button type="submit" value="Add to Cart" name="add_to_cart" class="primary-btn">Add to Cart</button>
                                        </form>';  
                                        
                                        $product_id = $_GET['product_id'];

                                        include 'connect.php';

                                        $product_id = mysqli_real_escape_string($db, $product_id);

                                        $sql5 = "SELECT quantity FROM products_info WHERE product = '$product_id'";
                                        $result5 = $db->query($sql5);

                                        if ($result5 === false) {
                                            // Display a specific database error message
                                            echo "Database error: " . $db->error;
                                        } else {
                                            if ($result5->num_rows > 0) {
                                                while ($row4 = $result5->fetch_assoc()) {
                                                    $quantity = $row4['quantity'];
                                                }

                                                echo "Left products: $quantity";
                                            } else {
                                                echo "No quantity found for this product.";
                                            }
                                        }

                                        
                                    echo'</div>

                                    <div class="product__details__btns__option">
                                        <form action="wishlist-code.php" method="post">
                                            <input type="hidden" name="product_image" value="'. $product_image .'">
                                            <input type="hidden" name="product_name" value="'. $product_title .'">
                                            <input type="hidden" name="product_price" value="'. $product_price .'">
                                            <input type="hidden" name="product_id" value="'. $product_id .'">
                                            <button type="submit" value="Add to Wishlist" name="add_to_wishlist" class="add-wishlist-button" style="border: 1px solid white; padding: 5px 20px; font-size: 14px; background-color: transparent; color: black;">
                                                <i class="fa fa-heart" style="margin-right: 5px;"></i><b>ADD TO WISHLIST</b>
                                            </button>
                                        </form>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__details__tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                            role="tab">Description</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Size</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                            <div class="product__details__tab__content">
                                                <div class="product__details__tab__content__item">
                                                    <h5>Products Infomation</h5>
                                                    <p>'. $row['product_desc'] .'</p>
                                                </div>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Material used</h5>
                                                    <p>'. $row['product_materialused'] .'</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-7" role="tabpanel">
                                            <div class="product__details__tab__content">
                                                <p class="note">Following the Size to buying your lover cloth.</p>
                                                <div class="product__details__tab__content__item">
                                                    <h5>Size</h5>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Height</th>
                                                                <th scope="col">Weight</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">XS</th>
                                                                <td>150/160</td>
                                                                <td>40</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">S</th>
                                                                <td>150/160/170</td>
                                                                <td>50/60</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">M</th>
                                                                <td>150/160/170</td>
                                                                <td>70</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">L</th>
                                                                <td>150/160/170</td>
                                                                <td>80/90</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <br /><br />
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Height</th>
                                                                <th scope="col">Weight</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">M</th>
                                                                <td>180/190</td>
                                                                <td>60/70</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">L</th>
                                                                <td>180/190</td>
                                                                <td>80/90</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Shop Details Section End -->
            ';
        }
            ?>

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
            <?php
                    include 'connect.php';
                                    
                    $result = mysqli_query($db, "SELECT product_id, product_image, product_title, product_brand, product_desc, product_price FROM products ORDER BY product_id DESC LIMIT 4") or die("Query is incorrect.....");
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
    <!-- Related Section End -->

    <!-- Fitting Room Section Begin -->
    <div class="container">
        <div id="fittingRoomContainer" class="container-fittingroom" style="display: none; border:none;">
            <?php
                include 'connect.php'; // Include your database connection script

                if (isset($_GET['product_id'])) {
                    $product_id = $_GET['product_id']; // Use the product_id from the URL
                } else {
                    // You can set a default product_id here if needed
                    $product_id = 1; // Replace with the default product ID
                }

                if (isset($_GET['fittingheight'])) {
                    $fittingheight = $_GET['fittingheight']; // Use the fitting height from the URL
                } else {
                    // Set a default fitting height if needed
                    $fittingheight = 1; // Replace with the default fitting height
                }

                if (isset($_GET['fittingweight'])) {
                    $fittingweight = $_GET['fittingweight']; // Use the fitting weight from the URL
                } else {
                    // Set a default fitting weight if needed
                    $fittingweight = 1; // Replace with the default fitting weight
                }

                $sql = "SELECT fittingroom_image FROM fittingroom WHERE products = $product_id AND fittingheight = $fittingheight AND fittingweight = $fittingweight";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    $images = array();
                    while ($row = $result->fetch_assoc()) {
                        $images[] = './admin/fittingroom/' . $row['fittingroom_image'];
                    }
                } else {
                    echo json_encode(['images' => []]); // Add some debug information here.
                }

            ?>

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Fitting Room</h3>
                    <h5>Body Shape</h5>
                    <img src="./img/fittingroom/Hourglass.png">
                    <img src="./img/fittingroom/Straight.png">
                    <img src="./img/fittingroom/Pear.png">
                    <img src="./img/fittingroom/Apple.png">

                    <br /><br />

                    <h5>Figure</h5>
                    <img src="./img/fittingroom/Flatter.png">
                    <img src="./img/fittingroom/Average.png">
                    <img src="./img/fittingroom/Curvier.png">

                    <br /><br />
                    <p>Those was sutiable the cloth</p>
                </div>
            </div>

            <br />

            <img id="fittingRoomImage" src="" alt="Fitting Room Image">
            <br /><br />
            <button id="prevImageBtn" onclick="loadPreviousImage()" style="width: 500px; height: 40px;">Previous</button>
            <br /><br />
            <button id="nextImageBtn" onclick="loadNextImage()" style="width: 500px; height: 40px;">Next</button>
            <br /><br />
            <p>My Look</p>
            <button id="editAvatarBtn" onclick="editAvatar()" style="width: 500px; height: 40px;">Edit Avatar</button>
            <br /><br />
                
            <form id="avatarForm" style="display: none" method="GET">
                <div class="content-container">
                    <br />
                    Fitting Height:
                    <br />
                    <select id="fittingHeightSelect" name="fittingheight">
                        <option value="1">150</option>
                        <option value="2">160</option>
                        <option value="3">170</option>
                        <option value="4">180</option>
                        <option value="5">190</option>
                    </select>
                    <br /><br /><br />

                    Fitting Weight:
                    <br />
                    <select id="fittingWeightSelect" name="fittingweight"> 
                        <option value="1">40</option>
                        <option value="2">50</option>
                        <option value="3">60</option>
                        <option value="4">70</option>
                        <option value="5">80</option>
                        <option value="6">90</option>
                    </select>
                    <br /><br /><br />
                </div>
                <p>**Reminder = After Press Save Avater Go To Next Press Again Virtual Fitting Room**</p>

                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"> <!-- Include the product_id as a hidden field -->
                <button type="submit" style="width: 500px; height: 40px;">Check Size</button>
            </form>
                
            <!-- Hidden next image element -->
            <img id="nextFittingRoomImage" style="display: none;">
        </div>
    </div>
    <!-- Fitting Room Section Begin -->

    <?php include 'footer.php';?>

    <div class="row1">
        <div class="button-container-right">
            <!-- Virtual Fitting Room Button -->
            <button id="virtualFittingRoomBtn">Virtual Fitting Room</button>

            <!-- Customer Service Button -->
            <div id="customer-service-chatbox" style="position: relative;">
                <a href="./chat/login.php">
                    <img src="img/customer-service.png" alt="Chat" width="50" height="50" style="cursor: pointer;">
                </a>
            </div>
        </div>
    </div>

        <script>
            var currentImageIndex = 0;
            var imageUrls = <?php echo json_encode($images); ?>;

            function loadCurrentImage() {
                var fittingRoomImage = document.getElementById('fittingRoomImage');
                fittingRoomImage.src = imageUrls[currentImageIndex];
            }

            function loadNextImage() {
                if (currentImageIndex < imageUrls.length - 1) {
                    currentImageIndex++;
                    loadCurrentImage();
                }
            }

            function loadPreviousImage() {
                if (currentImageIndex > 0) {
                    currentImageIndex--;
                    loadCurrentImage();
                }
            }

            document.getElementById('virtualFittingRoomBtn').addEventListener('click', function () {
                showFittingRoomImages(<?php echo $product_id; ?>); // Replace with the actual product ID
                this.style.display = 'none';
            });

            function showFittingRoomImages(product_id) {
                imageUrls = <?php echo json_encode($images); ?>;
                loadCurrentImage();
                document.getElementById('fittingRoomContainer').style.display = 'block';
            }

            loadCurrentImage();
        </script>

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
    </div>

    <!-- Include your JavaScript files at the end of the HTML document -->
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

    <script>
        function decreaseQuantity() {
            var inputElement = document.getElementById("quantityInput");
            var currentQuantity = parseInt(inputElement.value);

            if (currentQuantity > 1) {
                inputElement.value = currentQuantity - 1;
            }
        }

        function increaseQuantity() {
            var inputElement = document.getElementById("quantityInput");
            var currentQuantity = parseInt(inputElement.value);

            if (currentQuantity < 10) {
                inputElement.value = currentQuantity + 1;
            }
        }
    </script>

    <script>
        // Function to show the fitting room image when the button is clicked
        document.getElementById('virtualFittingRoomBtn').addEventListener('click', function () {
            var product_id = <?php echo $product_id; ?>; // Get the product ID from your PHP variable

            // Hide the button
            this.style.display = 'none';

        });
    </script>

    <script>
        function editAvatar() {
            var avatarForm = document.getElementById('avatarForm');
            var editAvatarBtn = document.getElementById('editAvatarBtn');

            // Toggle the display property of the avatar form
            if (avatarForm.style.display === 'none' || avatarForm.style.display === '') {
                avatarForm.style.display = 'block';
                editAvatarBtn.innerText = 'Hide Avatar'; // Change the button text
            } else {
                avatarForm.style.display = 'none';
                editAvatarBtn.innerText = 'Edit Avatar'; // Change the button text back
            }
        }
    </script>

</body>

</html>