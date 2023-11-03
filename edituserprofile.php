<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Edit User Profile</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php
        include("connect.php");
        $cust_id = $_REQUEST['cust_id'];

        $result = mysqli_query($db, "select cust_id, username, email, password, gender, dob, address from user where cust_id='$cust_id'") or die("query 1 incorrect.......");

        list($cust_id, $username, $email, $password, $gender, $dob, $address) = mysqli_fetch_array($result);

        if (isset($_POST['update'])) {
            if (
                empty($_POST['username']) ||
                empty($_POST['email']) ||
                empty($_POST['password']) ||
                empty($_POST['gender']) ||
                empty($_POST['dob']) ||
                empty($_POST['address'])
            ) {
                echo "<script>alert('Fill in all the details to continue');window.location='edituserprofile.php';</script>";
            } else {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $new_password = $_POST['password'];
                $gender = $_POST['gender'];
                $dob = $_POST['dob'];
                $address = $_POST['address'];
        
                // Hash the new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
                $update = "UPDATE user SET username='$username', email='$email', password='$hashed_password', gender='$gender', dob='$dob', address='$address' WHERE cust_id ='$cust_id'";
                mysqli_query($db, $update);
        
                if (mysqli_query($db, $update)) {
                    $message[] = 'User Info Updated Successfully';
                    echo "<script>
                                window.location.href='userprofile.php';
                            </script>";
                } else {
                    $message[] = 'Error: ' . mysqli_error($db);
                    echo "<script>
                        window.location.href='404.php';
                    </script>";
                }
            }
        }        
    ?>

    <?php include 'header.php';?>

    <br />
    <div class="content">
            <div class="container-fluid">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Edit User</h5>
                        </div>
                        
                        <?php
                            if(isset($message)){
                                foreach($message as $message){
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> '.$message.'
                                    </div>';
                                }
                            }
                        ?>
                        
                        <div class="card-body">
                            <form action="edituserprofile.php" name="form" method="post" enctype="multipart/form-data">
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
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="inputPassword" name="password"
                                            value="<?php echo $password; ?>">
                                        <span class="input-group-text toggle-password" style="cursor: pointer;"><i class="far fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputGender" class="form-label">Gender</label>
                                    <br />
                                    <select id="inputGender" class="form-select" name="gender">
                                        <option selected><?php echo $gender; ?></option>
                                        <option>male</option>
                                        <option>female</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <br /><br />

                                <div class="mb-3">
                                <label for="inputUserName" class="form-label">Date of Birth</label>
                                    <div class="col-sm-15">
                                        <input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <label for="floatingTextarea">Address</label>
                                        <textarea class="form-control" id="floatingTextarea" name="address" style="height: 100px;"><?php echo $address; ?></textarea> 
                                    </div>
                                </div>

                                <br /><br />
                                
                                <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <br /><br />

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

    <script>
        // Add JavaScript to toggle password visibility
        const passwordInput = document.querySelector('#inputPassword');
        const togglePassword = document.querySelector('.toggle-password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>