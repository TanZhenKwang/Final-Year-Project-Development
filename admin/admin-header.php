<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Monkey Apes | Admin Header</title>
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
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="./img/logo.png" alt="">
        <span class="d-none d-lg-block">Monkey Apes Admin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="productlist.php">
          <i class="bi bi-bag-fill"></i>
          <span>Product List</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse">
          <i class="bi bi-journal-text"></i><span>Add</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="addproducts.php">
              <i class="bi bi-bag-plus"></i><span>Add Product</span>
            </a>
          </li>
          <li>
            <a href="addproductinfo.php">
              <i class="bi bi-moisture"></i><span>Add Product Info</span>
            </a>
          </li>
          <li>
            <a href="addcategory.php">
              <i class="bi bi-circle"></i><span>Add Category</span>
            </a>
          </li>
          <li>
            <a href="addbrand.php">
              <i class="bi bi-circle"></i><span>Add Brands</span>
            </a>
          </li>
          <li>
            <a href="addsize.php">
              <i class="bi bi-fullscreen"></i><span>Add Size</span>
            </a>
          </li>
          <li>
            <a href="addcolor.php">
              <i class="bi bi-moisture"></i><span>Add Color</span>
            </a>
          </li>
          <li>
            <a href="addfittingroom_height.php">
              <i class="bi bi-bag-plus"></i><span>Add Fitting Room Height</span>
            </a>
          </li>
          <li>
            <a href="addfittingroom_weight.php">
              <i class="bi bi-moisture"></i><span>Add Fitting Room Weight</span>
            </a>
          </li>
          <li>
            <a href="addfittingroom.php">
              <i class="bi bi-circle"></i><span>Add Fitting Room</span>
            </a>
          </li>
        </ul>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="manageuser.php">
          <i class="bi bi-file-person"></i>
          <span>Manager User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="orders.php">
          <i class="bi bi-basket-fill"></i>
          <span>Order</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="./chat/login.php">
          <i class="ri-user-voice-line"></i>
          <span>Customer Services</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-logout.php">
          <i class="bi bi-box-arrow-in-left"></i>
          <span>Logout</span>
        </a>
      </li>

    </ul>

  </aside>

</body>

</html>