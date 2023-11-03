<?php
    include 'header.php';
    include 'connect.php';

    if (isset($_SESSION['cust_id'])) {
        $cust_id = $_SESSION['cust_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            if ($rating < 1 || $rating > 5) {
                echo 'Invalid rating value.';
                exit;
            }
            
            // Prepare and execute an SQL statement to insert the data into the table
            $stmt = $db->prepare("INSERT INTO ratings (rating, review, cust_id) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $rating, $review, $cust_id);

            if ($stmt->execute()) {
                $_SESSION['status'] = "Thank you for your review and rating";

            } else {
                $_SESSION['status'] = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Please log in.</div>';
        exit; // Stop script execution
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- Favicons -->
  <link href="./img/icons.png" rel="icon">
  <title>Monkey Apes | Review Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./style.css">

  <style>
    #full-stars-example-two .rating-group {
      display: inline-flex;
    }

    #full-stars-example-two .rating__icon {
      pointer-events: none;
    }

    #full-stars-example-two .rating__input {
      position: absolute !important;
      left: -9999px !important;
    }

    #full-stars-example-two .rating__input--none {
      display: none;
    }

    #full-stars-example-two .rating__label {
      cursor: pointer;
      padding: 0 0.1em;
      font-size: 2rem;
    }

    #full-stars-example-two .rating__icon--star {
      color: orange;
    }

    #full-stars-example-two .rating__input:checked~.rating__label .rating__icon--star {
      color: #ddd;
    }

    #full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
      color: orange;
    }

    #full-stars-example-two .rating__input:hover~.rating__label .rating__icon--star {
      color: #ddd;
    }

    body {
      padding: 1rem;
      text-align: center;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .star-cb-group {
      /* remove inline-block whitespace */
      font-size: 0;
      /* flip the order so we can use the + and ~ combinators */
      unicode-bidi: bidi-override;
      direction: rtl;
      /* the hidden clearer */
    }

    .star-cb-group * {
      font-size: 1rem;
    }

    .star-cb-group>input {
      display: none;
    }

    .star-cb-group>input+label {
      /* only enough room for the star */
      display: inline-block;
      overflow: hidden;
      text-indent: 9999px;
      width: 1em;
      white-space: nowrap;
      cursor: pointer;
    }

    .star-cb-group>input+label:before {
      display: inline-block;
      text-indent: -9999px;
      content: "☆";
      color: #888;
    }

    .star-cb-group>input:checked~label:before,
    .star-cb-group>input+label:hover~label:before,
    .star-cb-group>input+label:hover:before {
      content: "★";
      color: #e52;
      text-shadow: 0 0 1px #333;
    }

    .star-cb-group>.star-cb-clear+label {
      text-indent: -9999px;
      width: .5em;
      margin-left: -.5em;
    }

    .star-cb-group>.star-cb-clear+label:before {
      width: .5em;
    }

    .star-cb-group:hover>input+label:before {
      content: "☆";
      color: #888;
      text-shadow: none;
    }

    .star-cb-group:hover>input+label:hover~label:before,
    .star-cb-group:hover>input+label:hover:before {
      content: "★";
      color: #e52;
      text-shadow: 0 0 1px #333;
    }


    .rating-box {
        width: 500px; /* Set the desired width */
        margin: 0 auto; /* Center horizontally */
        text-align: center; /* Center the content inside the box */
        padding: 20px; /* Add some padding for spacing */
        border: solid 1px #c1c1c1;
        position: relative;
    }


    fieldset {
      border: none;
      padding: 5px 20px;
    }

    .rating-success {
      display: none;
      text-align: center;
      font-size: 20px;
      padding: 30px 0;
    }

    .rating-success.active {
      display: block
    }

    .rating-form input.text-field {
      display: block;
      width: 100%;
      line-height: 25px;
      font-size: 14px;
      padding: 0 10px;
      border: solid 1px #c1c1c1;
    }

    .rating-form #review {
      width: 100%;
      padding: 0 10px;
      line-height: 25px;
      font-size: 14px;
      height: 100px;
      border: solid 1px #c1c1c1;
    }

    .rating-form #submit {
      width: 100px;
      line-height: 30px;
      font-size: 14px;
      border-radius: 0;
      -webkit-appearance: none;
      background: #467379;
      color: white;
      border: none;
      outline: none;
    }

    .error {
      padding-left: 20px;
      color: red;
      font-size: 12px;
    }
  </style>
</head>

<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Ratings</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Ratings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <br /><br />

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

    <div class='rating-box'>
    <form class='rating-form' action="reviewform.php" method="post">
            <fieldset>
                <div id="full-stars-example-two">
                    <p class="desc" style="font-family: sans-serif; font-size:0.9rem">Give stars</p>
                    <div class="rating-group">
                        <input disabled checked class="rating__input rating__input--none" name="rating" id="rating3-none" value="0"
                        type="radio">
                        <label aria-label="1 star" class="rating__label" for="rating3-1"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-1" value="1" type="radio">
                        <label aria-label="2 stars" class="rating__label" for="rating3-2"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-2" value="2" type="radio">
                        <label aria-label="3 stars" class="rating__label" for="rating3-3"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-3" value="3" type="radio">
                        <label aria-label="4 stars" class="rating__label" for="rating3-4"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-4" value="4" type="radio">
                        <label aria-label="5 stars" class="rating__label" for="rating3-5"><i
                            class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-5" value="5" type="radio">
                    </div>
                </div>
            </fieldset>

            <br />

            <fieldset>
                <textarea name='review' id='review' maxlength='100' placeholder='Write your review here (Required)'
                required></textarea>

                <br /><br />

                <button type="submit" class="site-btn">Submit</button>
                <input type="hidden" name="submitted" value="true">
            </fieldset>

        </form>
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

</body>

</html>