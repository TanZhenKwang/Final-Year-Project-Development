<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Monkey Apes | Orders</title>

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

  <!-- Custom Styles for Tables -->
  <style>
    .table-responsive.ps {
      position: relative;
      overflow: hidden;
    }

    .table-responsive.ps .ps__rail-x,
    .table-responsive.ps .ps__rail-y {
      position: absolute;
      opacity: 0;
      transition: opacity 0.2s linear;
    }

    .table-responsive.ps:hover .ps__rail-x,
    .table-responsive.ps:hover .ps__rail-y {
      opacity: 1;
    }

    .table-responsive.ps .ps__thumb-x,
    .table-responsive.ps .ps__thumb-y {
      position: absolute;
      border-radius: 6px;
      transition: background-color 0.2s;
    }

    .table-responsive.ps .ps__thumb-x {
      height: 6px;
      width: 100%;
      bottom: 0;
      left: 0;
    }

    .table-responsive.ps .ps__thumb-y {
      width: 6px;
      height: 100%;
      top: 0;
      right: 0;
    }
  </style>
</head>

<body>

<?php 
  session_start();
  include "admin-header.php";
  include("connect.php");

  if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete'){
    $cust_id=$_GET['order_id'];
    /*this is delet quer*/
    mysqli_query($db,"delete from user where order_id='$order_id'")or die("query is incorrect...");
  }
    ?>

  <!-- Main Content -->
  <main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
      <h1>Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- Section for Table -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datatables</h5>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Payment Methods</th>
                    <th scope="col">Date & Time</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  // Fetch checkout data from the database
                  $result = mysqli_query($db, "SELECT checkout_id, user.username, payment_cart, total_price, payment_method, date FROM checkout JOIN user ON checkout.user = user.cust_id");

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['total_price']}</td>";
                    echo "<td>{$row['payment_method']}</td>";
                    echo "<td>{$row['date']}</td>";
                    // Add more columns as needed
                    echo "</tr>";
                  }
                ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Section for Table -->
  </main><!-- End Main Content -->

  <!-- Back to Top Button -->
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