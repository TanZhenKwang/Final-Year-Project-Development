<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicons -->
    <link href="./img/icons.png" rel="icon">
    <title>Monkey Apes | Blog</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type text/css>
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

    <?php include 'header.php';?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Blog</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.php">Home</a>
                            <span>Blog</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <?php
                $base_url = 'https://gnews.io/api/v4/search';

                // Define your query parameters
                $query = urlencode('fashion cloth');
                $language = 'en';       // Change this to your desired language code
                $max_results = 10;      // Change this to the number of results you want

                // Build the API request URL
                $url = "{$base_url}?q={$query}&lang={$language}&max={$max_results}&token=c512c036d0d5bdd7ba985b554082c02f";

                // Make the HTTP request to the GNews API
                $response = file_get_contents($url);

                if ($response === false) {
                    die('Failed to fetch data from GNews API');
                }

                // Decode the JSON response
                $data = json_decode($response, true);

                if ($data === null) {
                    die('Failed to parse JSON response from GNews API');
                }

                // Process the news articles
                if (isset($data['articles']) && is_array($data['articles'])) {
                    foreach ($data['articles'] as $article) {
                        echo '<div class="col-lg-4 col-md-6 col-sm-6">';
                        echo '<div class="blog__item">';
                        echo '<div class="blog__item__pic set-bg" data-setbg="' . $article['image'] . '"></div>';
                        echo '<div class="blog__item__text">';
                        echo '<span><img src="img/icon/calendar.png" alt=""> ' . $article['publishedAt'] . '</span>';
                        echo '<h5>' . $article['title'] . '</h5>';
                        echo '<p>' . $article['description'] . '</p>';
                        echo '<a href="' . $article['url'] . '">Read More</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo 'No articles found.';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
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