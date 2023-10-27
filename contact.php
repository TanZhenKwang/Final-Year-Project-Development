<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monkey Apes | Contact</title>

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
<?php 
  use PHPMailer\PHPMailer\PHPMailer;

	require_once 'phpmailer/Exception.php';
	require_once 'phpmailer/PHPMailer.php';
	require_once 'phpmailer/SMTP.php';

	$mail = new PHPMailer(true);
	$alert ='';

    if (isset($_POST['submitted'])) {
        $name = ($_POST['name']);
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $okay = true;

      if (empty($name) && empty($email) && empty($subject) && empty($message)) {
			echo "Please fill out all the field.<br/><br/>";
			$okay = false;
		  }

      else {
        if (empty($name)) {
          echo "First Name is required.<br/><br/>";
          $okay = false;
        }

        else if (ctype_alpha(str_replace(' ', '', $name)) == false) {
          echo "Only letters and spaces are allowed in Name field.<br/><br/>";
          $okay = false;
        }

        if (empty($email)) {
          echo "Email is required.<br/><br/>";	
          $okay = false;		
        }
              
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "Invalid E-mail address.<br/><br/>";
          $okay = false;
        }

        if (empty($subject)) {
          echo "Subject is required.";
          $okay = false;
        }

        if (empty($message)) {
          echo "Message is required.";
          $okay = false;
        }
      }

      if ($okay) {
        echo "Your message has been sent successfully.";

        try{
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'drbread2002@gmail.com'; // Gmail address which you want to use as SMTP server
          $mail->Password = 'ivpmwzocsndtpfmu'; // Gmail address Password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = '587';

          $mail->setFrom('drbread2002@gmail.com'); // Gmail address which you used as SMTP server
          $mail->addAddress('drbread2002@gmail.com', 'Monkey Apes'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body = 'Dear <b>Monkey Apes</b>, <br /><br />' .$message. '<br /><br />Sincerely, <br />' .$name.'';

          $mail->send();
          $alert = '<div class="alert-success">
                <span>Message Sent! Thank you for contacting us.</span>
              </div>';
        }

        catch (Exception $e){
          $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
        }
      }
    }
?>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include 'header.php';?>

    <!-- Map Begin -->
    <div class="map">
      <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Komtar+(Monkey%20Apes)&amp;t=k&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Population Estimator map</a></iframe>
    </div>
    <!-- Map End -->

    <br /><br /><br />

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>For questions regarding our products and services you can also <br />
                                contact us by filling out the form below.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>France</h4>
                                <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="col-lg-6">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-12">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>                   
                                </div>
                                <div class="col-lg-12">
                                  <button type="submit" class="site-btn">Send Message</button>
                                  <input type="hidden" name="submitted" value="true">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

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