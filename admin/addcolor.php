<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Monkey Apes | Add Color</title>
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

            $color = $_POST["color"];

            // SQL query to insert data into the database
            $sql = "INSERT INTO color (color_title) VALUES ('$color')";

            // Execute the SQL query
            if ($db->query($sql) === TRUE) {
                echo "Size added successfully!";
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
            <h1>Add Color</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
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
                            <h5 class="title">Add Color</h5>
                        </div>
                        <div class="card-body">
                            <form action="addcolor.php" name="form" method="post">
                                <div class="mb-3">
                                    <br />
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" id="color" name="color" required class="form-control">
                                </div>
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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