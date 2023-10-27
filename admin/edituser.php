<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Monkey Apes | Edit User</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        session_start();
        include("connect.php");
        $cust_id = $_REQUEST['cust_id'];

        $result = mysqli_query($db, "select cust_id, username, email, password from user where cust_id='$cust_id'") or die("query 1 incorrect.......");

        list($cust_id, $username, $email, $password) = mysqli_fetch_array($result);

        if (isset($_POST['update'])) {
            if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                echo "<script>alert('Fill in all the details to continue');window.location='edituser.php';</script>";
            } else {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $new_password = $_POST['password']; // Get the new password
                
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
                $update = "UPDATE user SET username='$username', email='$email', password='$hashed_password' WHERE cust_id ='$cust_id'";
                mysqli_query($db, $update);
        
                if (mysqli_query($db, $update)) {
                    $message[] = 'User Info Updated Successfully';
                    echo '<meta http-equiv="refresh" content="2">';
                } else {
                    $message[] = 'Error: ' . mysqli_error($db);
                }
            }
        }
    ?>

    <?php include "admin-header.php";?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Users</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Forms</li>
                <li class="breadcrumb-item active">Layouts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check"></i> '.$message.
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        ?>
       
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Edit User</h5>
                        </div>
                        <div class="card-body">
                            <form action="edituser.php" name="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="cust_id" id="cust_id" value="<?php echo $cust_id;?>" />
                                <div class="mb-3">
                                    <label for="inputUserName" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="inputUserName" name="username"
                                        value="<?php echo $username; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="inputEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="inputEmail" name="email"
                                        value="<?php echo $email; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="inputPassword" name="password"
                                        value="<?php echo $password; ?>">
                                </div>
                                <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>
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