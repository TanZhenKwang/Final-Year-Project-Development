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
session_start();
include("connect.php");

if (isset($_POST['btn_save'])) {
    // Get and sanitize user input
    $fittingheight = mysqli_real_escape_string($db, $_POST['fittingheight']);
    $fittingweight = mysqli_real_escape_string($db, $_POST['fittingweight']);
    $product = mysqli_real_escape_string($db, $_POST['product']);

    $picture = $_FILES['picture']['name'];
    $tempname = $_FILES['picture']['tmp_name'];
    $folder = '../uploads/' . $picture;

    $sql = "INSERT INTO fittingroom (fittingheight, fittingweight, fittingroom_image, products) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($db);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $fittingheight, $fittingweight, $picture, $product);

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
                <h1>Add Fitting Room</h1>
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
                                <h5 class="title">Add Fitting Room Info</h5>
                            </div>
                            <div class="card-body">
                            <form action="addfittingroom.php" method="post" type="form" name="form" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <br />
                                        <label for="fittingheight" class="form-label">Fitting Height</label>
                                        <input type="number" id="fittingheight" name="fittingheight" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="fittingweight" class="form-label">Fitting Weight</label>
                                        <input type="number" id="fittingweight" name="fittingweight" required="[1-6]" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="picture" class="form-label">Add Image</label>
                                        <input type="file" name="picture" required class="form-control" id="picture" accept="image/png, image/jpg, image/jpeg">
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
                                                <th>Fitting Room Height ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select fittingheight_id, fittingheight_title from fitting_height")or die ("query 2 incorrect.......");
                                                
                                                while(list($fittingheight_id, $fittingheight_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$fittingheight_id</td><td>$fittingheight_title</td>";
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
                                                <th>Fitting Room Weight ID</th>
                                                <th>Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include("connect.php");
                                                $result=mysqli_query($db,"select fittingweight_id, fittingweight_title from fitting_weight")or die ("query 2 incorrect.......");
                                                
                                                while(list($fittingweight_id, $fittingweight_title) = mysqli_fetch_array($result)){
                                                    echo "<tr><td>$fittingweight_id</td><td>$fittingweight_title</td>";
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