<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monkey Apes | Edit Product</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" href="assets/img/favicon.png">
    <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <?php    
    include("admin-header.php");
    session_start();
    include("connect.php");

    $product_id = $_REQUEST['product_id'];

    // Retrieve product information based on product_id
    $result = mysqli_query($db, "SELECT product_id, product_image, product_title, product_desc, product_price, product_materialused, product_cat, product_brand, product_keywords FROM products WHERE product_id = '$product_id'") or die("Query is incorrect.....");
    
    if ($result && mysqli_num_rows($result) > 0) {
        list($product_id, $product_image, $product_title, $product_desc, $product_price, $product_materialused, $product_cat, $product_brand, $product_keywords) = mysqli_fetch_array($result);
    } else {
        // Handle the case where no product with the specified ID was found
        echo "<p>No product found with the given ID.</p>";
        exit; // You may want to add a link to go back to a product listing page
    }

    if (isset($_POST['update'])) {
        // Sanitize and validate form inputs here
    
        $product_title = $_POST['product_title'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_keywords = $_POST['product_keywords'];
        $product_materialused = $_POST['product_materialused'];
        $size = $_POST['size'];
        $color = $_POST['color'];
        
    
        // File upload handling
        $picture = $_FILES['picture']['name'];
        $tempname = $_FILES['picture']['tmp_name'];
        $folder = '../uploads/' . $picture;
    
        // Make sure to properly escape variables for the SQL query to prevent SQL injection
        $product_title = mysqli_real_escape_string($db, $product_title);
        $product_desc = mysqli_real_escape_string($db, $product_desc);
        $product_price = mysqli_real_escape_string($db, $product_price);
        $product_cat = mysqli_real_escape_string($db, $product_cat);
        $product_brand = mysqli_real_escape_string($db, $product_brand);
        $product_keywords = mysqli_real_escape_string($db, $product_keywords);
        $picture = mysqli_real_escape_string($db, $picture);
        $product_materialused = mysqli_real_escape_string($db, $product_materialused);
        $product_size = mysqli_real_escape_string($db, $product_size);
        $product_color = mysqli_real_escape_string($db, $product_color);
    
        // Construct the SQL query with proper syntax
        $update = "UPDATE products SET product_image='$picture', product_title='$product_title', product_desc='$product_desc', product_materialused='$product_materialused' product_price='$product_price', product_cat='$product_cat', product_brand='$product_brand', product_keywords='$product_keywords', product_size='$product_size', product_color='$product_color' WHERE product_id ='$product_id'";
        
        if (mysqli_query($db, $update)) {
            $message = 'Product Info Updated Successfully';
            echo '<meta http-equiv="refresh" content="2">';
        } else {
            $message = 'Error: ' . mysqli_error($db);
        }
    }
    

    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Element</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        if (isset($message)) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ri-check-line"></i> ' . $message .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        ?>

        <form action="editproduct.php?product_id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
            <section class="section">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit Product</h5>
                                <!-- Edit Product Form -->
                                <div class="mb-3">
                                    <label for="product_title" class="form-label">Product Title</label>
                                    <input type="text" id="product_title" required name="product_title" class="form-control" value="<?php echo $product_title; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Add Image</label>
                                    <input type="file" name="picture" required class="form-control" id="picture" accept="image/png, image/jpg, image/jpeg" value="<?php echo $imagePath; ?>">
                                </div>

                                <?php 
                                    $result = mysqli_query($db, "SELECT product_id, product_image FROM products") or die("Query is incorrect.....");
                                    $image = $product_image;    
                                    $imagePath = '../admin/products_images/' . $product_image; 
                                ?>

                                <div class="mb-3">
                                    <label for="current_image" class="form-label">Current Image</label>
                                    <br />
                                    <img src="<?php echo $imagePath; ?>" alt="Current Product Image" class="img-fluid" width="250" height="2500">
                                </div>

                                <div class="mb-3">
                                    <label for="product_desc" class="form-label">Description</label>
                                    <textarea rows="4" cols="80" id="product_desc" required name="product_desc" class="form-control"><?php echo $product_desc; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="product_materialused" class="form-label">Material Used</label>
                                    <textarea rows="4" cols="80" id="product_materialused" required name="product_materialused" class="form-control"><?php echo $product_materialused; ?></textarea>
                                </div>

                                    
                                <div class="mb-3">
                                    <label for="product_price" class="form-label">Pricing</label>
                                    <input type="text" id="product_price" name="product_price" required class="form-control" value="<?php echo $product_price; ?>">
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Categories</h5>
                                <!-- Categories Form -->
                                <div class="mb-3">
                                    <label for="product_cat" class="form-label">Product Category</label>
                                    <input type="number" id="product_cat" name="product_cat" required class="form-control" value="<?php echo $product_cat; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="product_brand" class="form-label">Product Brand</label>
                                    <input type="number" id="product_brand" name="product_brand" required class="form-control" value="<?php echo $product_brand; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="product_keywords" class="form-label">Product Keywords</label>
                                    <input type="text" id="product_keywords" name="product_keywords" required class="form-control" value="<?php echo $product_keywords; ?>">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="update" name="update" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>

        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tablesorter table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Category ID</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = mysqli_query($db, "SELECT cat_id, cat_title FROM category") or die("Query is incorrect.......");
                                        while (list($cat_id, $cat_title) = mysqli_fetch_array($result)) {
                                            echo "<tr><td>$cat_id</td><td>$cat_title</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tablesorter table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>Brand ID</th>
                                            <th>Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = mysqli_query($db, "SELECT brand_id, brand_title FROM brands") or die("Query is incorrect.......");
                                        while (list($brand_id, $brand_title) = mysqli_fetch_array($result)) {
                                            echo "<tr><td>$brand_id</td><td>$brand_title</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
