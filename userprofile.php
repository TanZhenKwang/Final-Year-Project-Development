<?php 
    include 'header.php';
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | User Profile</title>

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

    <style>
        body {
            background-color: #f9f9fa
        }

        .padding {
            padding: 3rem !important;
            
            display: flex;
            align-items: center;
            justify-content: center;
        
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            box-shadow: 0 1px 20px 0 rgba(69,90,100,0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: linear-gradient(to right, #ee5a6f, #f29263);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }
        
        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px){
        p {
            font-size: 14px;
        }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
        
    </style>

</head>

<body>
    <!-- Page Preloder -->

    <?php

    if(isset($_SESSION['cust_id'])){
        $query = "SELECT * FROM user WHERE cust_id = {$_SESSION['cust_id']}";
        
        if ($r = mysqli_query($db,$query)) { 
          $row = mysqli_fetch_array($r);
          
          $id = $row['cust_id'];
          $username = $row['username'];
          $email = $row['email'];
          $password = $row['password'];
          $gender = $row['gender'];
          $dob = $row['dob'];
          $address = $row['address'];
          $registration_date = $row['registration_date'];
        }
    } else {
        echo '
            <script>
                alert("Please login to your account before editing profile.");
                window.location.href = "loginregister.php";
            </script>';
    }

    if(isset($_POST['delete'])){
        $cust_id = $_POST['cust_id'];
        // Delete related cart records
        mysqli_query($db, "DELETE FROM cart WHERE cust_id='$cust_id'") or die("Error deleting cart records: " . mysqli_error($db));
        // Now, you can safely delete the user
        mysqli_query($db, "DELETE FROM user WHERE cust_id='$cust_id'") or die("Error deleting user: " . mysqli_error($db));
        echo "
            <script>alert('User account has been deleted!');
            window.location.href = 'loginregister.php';</script>
        ";
    }
    ?>

    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-10 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                    </div>

                                    <h6 class="f-w-600"><?php echo $username ?></h6>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400"><?php echo $email ?></h6>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Password</p>
                                            <h6 class="text-muted f-w-400"><?php echo $password ?></h6>
                                        </div>
                                    </div>
                                                                    
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Details</h6>              
                                    <div class="row">             
                                        <div class="col-sm-6">                                                                        
                                            <p class="m-b-10 f-w-600">Gender</p>                                                                        
                                            <h6 class="text-muted f-w-400"><?php echo $gender ?></h6>                                                          
                                        </div>

                                        <div class="col-sm-6">                                                                        
                                            <p class="m-b-10 f-w-600">Address</p>                                                                        
                                            <h6 class="text-muted f-w-400"><?php echo $address ?></h6>                                                          
                                        </div>
                                    </div>

                                    <br />

                                    <div class="row">
                                        <div class="col-sm-6">                      
                                            <p class="m-b-10 f-w-600">Date of Birth</p>                                                  
                                            <h6 class="text-muted f-w-400"><?php echo $dob ?></h6>             
                                        </div>             

                                        <div class="col-sm-6">                      
                                            <p class="m-b-10 f-w-600">Date of Register</p>                                                  
                                            <h6 class="text-muted f-w-400"><?php echo $registration_date ?></h6>             
                                        </div>       
                                </div>               
                            </div>           
                        </div>        
                    </div>        
                </div>
                
                <div class="text-center">
                    <div class="btn-group">
                        <a href="edituserprofile.php?cust_id=<?php echo $cust_id; ?>" type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit User">Edit Profile</a>
                        <form method="POST" action="" style="margin-left: 25px; margin-right: 25px;"> <!-- Adjust the margin as needed -->
                            <input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
                            <button type="submit" class="btn btn-danger" name="delete" onclick="return confirm('Are you sure you want to delete this user account?');">Delete Account</button>
                        </form>
                        <a href="editcreditcard.php?cust_id=<?php echo $cust_id; ?>" type="button" rel="tooltip" title="" class="btn btn-info" data-original-title="Edit User">Edit Credit Card</a>

                    </div>
                </div>
            </div>     
        </div>   
    </div>

    <br /><br /><br /><br />

    <?php include 'footer.php';?>

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

    <!-- Js Plugins -->
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
</body>

</html>