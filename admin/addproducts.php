<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Monkey Apes | Add Product</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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
        session_start();
        include("connect.php");

        if (isset($_POST['btn_save'])) {
            // Get and sanitize user input
            $product_name = mysqli_real_escape_string($db, $_POST['product_name']);
            $details = mysqli_real_escape_string($db, $_POST['details']);
            $price = mysqli_real_escape_string($db, $_POST['price']);
            $product_type = mysqli_real_escape_string($db, $_POST['product_type']);
            $brand = mysqli_real_escape_string($db, $_POST['brand']);
            $tags = mysqli_real_escape_string($db, $_POST['tags']);
            $materialused = mysqli_real_escape_string($db, $_POST['materialused']);

            $picture = $_FILES['picture']['name'];
            $tempname = $_FILES['picture']['tmp_name'];
            $folder = '../uploads/' . $picture;

            $sql = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_materialused, product_image, product_keywords) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_stmt_init($db);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssssss", $product_type, $brand, $product_name, $price, $details, $materialused, $picture, $tags);

                if (mysqli_stmt_execute($stmt)) {
                    // Redirect to a success page or do something else after successful insertion
                    header("location: product_uploaded.php?success=1");
                    exit();
                } else {
                    // Handle the case where the SQL query fails
                    echo "Error: " . mysqli_error($db);
                }
            } else {
                echo "Error in prepared statement: " . mysqli_error($db);
            }

            mysqli_stmt_close($stmt);
        }

        mysqli_close($db);
        include "admin-header.php";
    ?>


        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Add Products</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Element</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <form action="addproducts.php" method="post" type="form" name="form" enctype="multipart/form-data">
            <section class="section">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Product</h5>
                                <!-- Add Product Form -->
                                
                                    <div class="mb-3">
                                        <label for="product_name" class="form-label">Product Title</label>
                                        <input type="text" id="product_name" required name="product_name"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="picture" class="form-label">Add Image</label>
                                        <input type="file" name="picture" required class="form-control" id="picture" accept="image/png, image/jpg, image/jpeg">
                                    </div>
                                    <div class="mb-3">
                                        <label for="details" class="form-label">Description</label>
                                        <textarea rows="4" cols="80" id="details" required name="details"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="materialused" class="form-label">Material Used</label>
                                        <textarea rows="4" cols="80" id="materialused" required name="materialused"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Pricing</label>
                                        <input type="text" id="price" name="price" required class="form-control">
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
                                        <label for="product_type" class="form-label">Product Category</label>
                                        <input type="number" id="product_type" name="product_type" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="brand" class="form-label">Product Brand</label>
                                        <input type="number" id="brand" name="brand" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tags" class="form-label">Product Keywords</label>
                                        <input type="text" id="tags" name="tags" required class="form-control">
                                    </div>
                                </form><!-- End Categories Form -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" required
                                    class="btn btn-primary">Add Product</button>
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
                                            <br />
                                            <tr>
                                                <th>Category ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select cat_id, cat_title from category")or die ("query 2 incorrect.......");
                                                
                                                while(list($cat_id, $cat_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$cat_id</td><td>$cat_title</td>";
                                                }
                                                mysqli_close($db);
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
                                            <br />
                                            <tr>
                                                <th>Brand ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select brand_id, brand_title from brands")or die ("query 2 incorrect.......");
                                                
                                                while(list($brand_id, $brand_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$brand_id</td><td>$brand_title</td>";
                                                }
                                                mysqli_close($db);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

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