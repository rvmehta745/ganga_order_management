<!-- forgot password -->
<?php
include 'backend/db_connect.php';
if (isset($_POST['forgot'])) {
    $email = $_POST['emailid'];
    $sql11 = "SELECT  `Password` FROM retailer WHERE `E-mail`='$email'";
    $result11 = mysqli_query($conn, $sql11);
    $row11 = mysqli_fetch_assoc($result11);

    $pass = $row11['Password'];
    if ($row11 > 0) {
        $password = $row11["Password"];
        $email = $email;
        echo $password;
        echo $email;

        $mail = new PHPMailer();

        //Enable SMTP debugging.
        $mail->SMTPDebug = 1;
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = TRUE;
        //Provide username and password
        $mail->Username = "skumar2911@gmail.com";
        $mail->Password = "skumar";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "false";
        $mail->Port = 587;
        //Set TCP port to connect to

        $mail->From = "skumar2911@gmail.com";
        $mail->FromName = "skumar";

        $mail->addAddress($email);

        $mail->isHTML(true);

        $mail->Subject = "test mail";
        $mail->Body = "<i>this is your password:</i>" . $password;
        $mail->AltBody = "This is the plain text version of the email content";
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        echo 'not found fail';
    }
}

?>
<!-- end forgot password -->
<!DOCTYPE html>

<html class="no-js" lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Account &ndash; Skumar</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body class="page-template ">
    <div class="pageWrapper">
        <!--Search Form Drawer-->
        <div class="search">
            <div class="search__form">
                <form class="search-bar__form" action="#">
                    <button class="go-btn search__button" type="submit"><i class="icon anm anm-search-l"></i></button>
                    <input class="search__input" type="search" name="q" value="" placeholder="Search entire store..." aria-label="Search" autocomplete="off">
                </form>
                <button type="button" class="search-trigger close-btn"><i class="icon anm anm-times-l"></i></button>
            </div>
        </div>
        <!--End Search Form Drawer-->
        <!--Top Header-->
        <div class="top-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                        <p class="phone-no"><i class="anm anm-phone-s"></i>+91 9016485585</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                        <div class="text-center">

                        </div>
                    </div>
                    <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>

                    </div>
                </div>
            </div>
        </div>
        <!--End Top Header-->
        <!--Header-->
        <div class="header-wrap animated d-flex">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!--Desktop Logo-->
                    <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                        <a href="index.php">
                            <img src="assets/images/riya-logo.png" alt="Skumar" title="Skumar" />
                        </a>
                    </div>
                    <!--End Desktop Logo-->
                    <div class="col-2 col-sm-3 col-md-3 col-lg-8">
                        <div class="d-block d-lg-none">
                            <button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
                                <i class="icon anm anm-times-l"></i>
                                <i class="anm anm-bars-r"></i>
                            </button>
                        </div>
                        <!--Desktop Menu-->

                        <!--End Desktop Menu-->
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                    </div>
                    <div class="col-4 col-sm-3 col-md-3 col-lg-2">


                    </div>
                </div>
            </div>
        </div>
        <!--End Header-->

        <!--Body Content-->
        <div id="page-content">
            <!--Page Title-->

            <div class="page section-header text-center">
                <div class="page-title">
                    <div class="wrapper">
                        <h1 class="page-width"><b>Forgot Password</b> </h1>
                    </div>
                </div>
            </div><br><br>
            <!--End Page Title-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                        <div class="mb-4">
                            <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerEmail"><b>Enter Your Registered E-mail ID :</b></label>
                                            <input type="email" name="emailid" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="" required>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                        <button type="forgot" class="btn" name="forgot">Forgot</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--End Body Content-->

        <!--Footer-->
        <footer id="footer">

            <div class="site-footer">
                <div class="container">
                    <!--Footer Links-->
                    <div class="footer-top">
                        <div class="row">


                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                                <h4 class="h4">Informations</h4>
                                <ul>
                                    <li><a href="about-us.php">About us</a></li>

                                    <li><a href="#">Terms &amp; condition</a></li>

                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 footer-links">
                            </div>
                            <div class="col-12 col-sm-12 col-md-3 col-lg-3 contact-box">
                                <h4 class="h4">Contact Us</h4>
                                <ul class="addressFooter">
                                    <li><i class="icon anm anm-map-marker-al"></i>
                                        <p>Shop 51/2, Ramnagar Soc.<br>Nikol Road Ahmedabad-382350</p>
                                    </li>
                                    <li class="phone"><i class="icon anm anm-phone-s"></i>
                                        <p>+91 9016485585</p>
                                    </li>
                                    <li class="email"><i class="icon anm anm-envelope-l"></i>
                                        <p>skumar2911@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--End Footer Links-->


                </div>
            </div>
        </footer>
        <!--End Footer-->
        <!--Scoll Top-->
        <span id="site-scroll"><i class="icon anm anm-angle-up-r"></i></span>
        <!--End Scoll Top-->

        <!-- Including Jquery -->
        <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
        <script src="assets/js/vendor/jquery.cookie.js"></script>
        <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
        <script src="assets/js/vendor/wow.min.js"></script>
        <!-- Including Javascript -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/lazysizes.js"></script>
        <script src="assets/js/main.js"></script>
    </div>
</body>



</html>