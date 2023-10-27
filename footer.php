<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monkey Apes | Footer</title>

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
</head>

<body>
    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="./index.php"><img src="img/logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="./shopping-cart.php"><img src="img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="./shop.php">Clothing Store</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="./contact.php">Contact Us</a></li>
                            <li><a href="./shopping-cart.php">Payment Methods</a></li>
                            <li><a href="./cookienotice.php">Cookie Notice</a></li>
                            <li><a href="./shipping & returns.php">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>

                <?php
                    use PHPMailer\PHPMailer\PHPMailer;

                    require_once 'phpmailer/Exception.php';
                    require_once 'phpmailer/PHPMailer.php';
                    require_once 'phpmailer/SMTP.php';

                    $mail = new PHPMailer(true);
                    $alert = '';

                    if (isset($_POST['email'])) {
                        $email = $_POST['email'];
                        $subscribeCategory = isset($_POST['category']) ? $_POST['category'] : 'general';
                        $apiKey = "327164d6d50346548172a489b3b10f81"; // Replace with your News API key
                        $okay = true;

                        if (empty($email)) {
                            echo "Email is required.<br/><br/>";
                            $okay = false;
                        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "Invalid E-mail address.<br/><br/>";
                            $okay = false;
                        }

                        if ($okay) {
                            $subscribeCategory = urlencode($subscribeCategory);
                            $newsApiUrl = "https://newsapi.org/v2/top-headlines?country=us&category=$subscribeCategory&apiKey=$apiKey";

                            // Initialize cURL session
                            // Initialize cURL session
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $newsApiUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                            // Add a User-Agent header
                            $userAgent = 'YourAppName/1.0'; // Replace 'YourAppName' with the name of your application
                            curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

                            $newsApiResponse = curl_exec($ch);

                            // Check for cURL errors or HTTP status code
                            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                            if ($httpStatus === 200) {
                                $newsData = json_decode($newsApiResponse, true);

                                if ($newsData['status'] === 'ok') {
                                    $articles = $newsData['articles'];
                                
                                    // Initialize PHPMailer
                                    $mail = new PHPMailer(true);
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'drbread2002@gmail.com'; // Gmail address for SMTP
                                    $mail->Password = 'ivpmwzocsndtpfmu'; // Replace with your Gmail password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port = 587;
                                
                                    $mail->setFrom('drbread2002@gmail.com', 'Monkey Apes');
                                    $mail->addAddress($email);
                                
                                    $mail->isHTML(true);
                                    $mail->Subject = "News Subscription";
                                    $mail->Body = '<p>Here are the latest news articles:</p>';
                                
                                    foreach ($articles as $article) {
                                        $newsTitle = $article['title'];
                                        $newsDescription = $article['description'];
                                        $newsUrl = $article['url'];
                                
                                        $mail->Body .= "<h2><a href='$newsUrl'>$newsTitle</a></h2>";
                                        $mail->Body .= "<p>$newsDescription</p><br /><br />";
                                    }
                                
                                    try {
                                        $mail->send();
                                        $alert = '<div class="alert-success">
                                            <span>News articles sent to your email. Thank you for subscribing!</span>
                                        </div>';
                                    } catch (Exception $e) {
                                        $alert = '<div class="alert-error">
                                            <span>' . $e->getMessage() . '</span>
                                        </div>';
                                    }
                                } else {
                                    echo 'News API Error: ' . $newsData['message'];
                                }
                            } else {
                                echo 'HTTP request failed with status code ' . $httpStatus;
                            }

                            // Close the cURL session
                            curl_close($ch);
                        }
                    }
                ?>

                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="index.php" method="post">
                                <input type="text" name="email" placeholder="Your email">
                                <input type="hidden" name="general" value="fashion">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

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