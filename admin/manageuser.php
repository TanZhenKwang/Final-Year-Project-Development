<?php include "admin-header.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Monkey Apes | Manage User</title>
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

      if(isset($_GET['action']) && $_GET['action']!="" && $_GET['action']=='delete'){
        $cust_id=$_GET['cust_id'];
        // Delete related cart records
        mysqli_query($db, "DELETE FROM cart WHERE cust_id='$cust_id'") or die("Error deleting cart records: " . mysqli_error($db));
        // Now, you can safely delete the user
        mysqli_query($db, "DELETE FROM user WHERE cust_id='$cust_id'") or die("Error deleting user: " . mysqli_error($db));
      }
    ?>
  <!-- Main Content -->
  <main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
      <h1>Manage User</h1>
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
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Manage User</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table tablesorter table-hover">
                  <thead class="text-primary">
                    <tr>
                      <th>Username</th>
                      <th>Password</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $result=mysqli_query($db,"select cust_id, email, password from user")or die ("query 2 incorrect.......");

                        while(list($cust_id,$username,$password) = mysqli_fetch_array($result)){
                          echo "<tr><td>$username</td><td>$password</td>";

                          echo"<td>
                          <a href='edituser.php?cust_id=$cust_id' type='button' rel='tooltip' title='' class='btn btn-info btn-link btn-sm' data-original-title='Edit User'>
                            <i class='bi bi-pencil'></i>
                            <div class='ripple-container'></div></a>
                          <a href='manageuser.php?cust_id=$cust_id&action=delete' type='button' rel='tooltip' title='' class='btn btn-danger btn-link btn-sm' data-original-title='Delete User'>
                            <i class='bi bi-trash2'></i>
                            <div class='ripple-container'></div></a>
                          </td></tr>";
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
    </div>
  </main>

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