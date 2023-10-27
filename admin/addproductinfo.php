<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Monkey Apes | Add Product Info</title>
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
        include "admin-header.php";
        include("connect.php");

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $size = $_POST['size'];
            $color = $_POST["color"];
            $quantity = $_POST["quantity"];
            $product = $_POST["product"];

            // SQL query to insert data into the database
            $sql = "INSERT INTO products_info (size, color, quantity, product) VALUES ('$size', '$color', '$quantity', '$product')";

            // Execute the SQL query
            if ($db->query($sql) === TRUE) {
                echo "Product Info added successfully!";
                $_SESSION['status'] = "Successful add to database.";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }

            // Close the database connection
            $db->close();
        }         
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
            
            <?php
                if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-success">
                        <h5>
                            <?= $_SESSION['status']; ?>
                        </h5>
                    </div>
                    <?php
                        unset($_SESSION['status']);
                }        
            ?>
        
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class="title">Add Info</h5>
                            </div>
                            <div class="card-body">
                                <form action="addproductinfo.php" name="form" method="post">
                                    <div class="mb-3">
                                        <br />
                                        <label for="size" class="form-label">Size</label>
                                        <input type="number" id="size" name="size" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="number" id="color" name="color" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="text" id="quantity" name="quantity" required class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="product" class="form-label">Product</label>
                                        <input type="number" id="product" name="product" required="[1-6]" class="form-control">
                                    </div>
                                    <button type="submit" id="btn_save" name="btn_save" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                                <th>Size ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select size_id, size_title from size")or die ("query 2 incorrect.......");
                                                
                                                while(list($size_id, $size_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$size_id</td><td>$size_title</td>";
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
                                                <th>Color ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select color_id, color_title from color")or die ("query 2 incorrect.......");
                                                
                                                while(list($color_id, $color_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$color_id</td><td>$color_title</td>";
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
                                                <th>Product ID</th>
                                                <th>Image</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result = mysqli_query($db, "SELECT product_id, product_image, product_title FROM products") or die("Query is incorrect.....");

                                                // Display the product information within table rows
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $product_id = $row['product_id'];
                                                    $image = $row['product_image'];
                                                    $product_title = $row['product_title'];

                                                    $imagePath = '../admin/products_images/' . $image;

                                                    echo "<tr>";
                                                        echo "<td>$product_id</td>";
                                                        echo "<td><img src='" . $imagePath . "' width='100px' height='100px'></td>";
                                                        echo "<td>$product_title</td>";
                                                    echo "</tr>";
                                                }

                                                // Close the result set
                                                mysqli_free_result($result);

                                                // Close the database connection
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