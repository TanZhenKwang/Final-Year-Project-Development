<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Monkey Apes | Product List</title>
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

  <style>
  .description-column {
    max-width: 200px; /* Adjust the maximum width as per your design */
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
</style>

</head>

<body>

  <?php
  session_start();
  include "admin-header.php";
  include("connect.php");

  if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete'){
    $product_id=$_GET['product_id'];
    /*this is delet query*/
    mysqli_query($db,"delete from products where product_id='$product_id'")or die("query is incorrect...");
  }
  ?>

  <main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
      <h1>Product List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card ">
            <div class="card-header card-header-primary">
              <h4 class="card-title"> Products List</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive ps">
                <table class="table tablesorter" id="page1">
                  <thead class="text-primary">
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Material Used</th>
                      <th>Price</th>
                      <th><a class="btn btn-primary" href="addproducts.php">Add New</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $result = mysqli_query($db, "SELECT product_id, product_image, product_title, product_desc, product_materialused, product_price FROM products") or die("Query is incorrect.....");

                      while ($row = mysqli_fetch_assoc($result)) {
                          $product_id = $row['product_id'];
                          $image = $row['product_image'];
                          $product_name = $row['product_title'];
                          $price = $row['product_price'];
                          $desc = $row['product_desc'];
                          $product_materialused = $row['product_materialused'];

                          $imagePath = '../admin/products_images/' . $row["product_image"];

                          // Display the product information within table rows
                          echo "<tr>";
                          echo "<td><img src='" . $imagePath . "' width='50px' height='50px'></td>";
                          echo "<td>$product_name</td>";
                          echo "<td class='description-column'>$desc</td>";
                          echo "<td class='description-column'>$product_materialused</td>";
                          echo "<td>$price</td>";
                          echo "<td>
                          <a href='editproduct.php?product_id=$product_id' type='button' rel='tooltip' title='' class='btn btn-info btn-link btn-sm' data-original-title='Edit User'>
                            <i class='bi bi-pencil'></i>
                            <div class='ripple-container'></div></a>
                          <a href='productlist.php?product_id=$product_id&action=delete' type='button' rel='tooltip' title='' class='btn btn-danger btn-link btn-sm' data-original-title='Delete User'>
                            <i class='bi bi-trash2'></i>
                            <div class='ripple-container'></div></a>
                          </td></tr>";
                      }
                    ?>
                  </tbody>
                </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                  <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                  <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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

</body>
</html>