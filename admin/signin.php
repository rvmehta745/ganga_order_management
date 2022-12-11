    <?php


    include 'backend/db_connect.php';
    //echo $_SERVER['REQUEST_METHOD'];
    // echo "------------------------------------------------------------";
    // header("location:home.php");
    $login = false;
    $showError = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //  echo "--------------------------------hii";
        include 'backend/db_connect.php';
        $email = $_POST['email'];
        $password = $_POST['password'];

        // echo $email;
        //  echo $password;

        $sql = "Select * from `admin` where `email` ='$email' AND `password`='$password'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        // setcookie("idRetailer","1",time() + 86400,"/");
        // echo $row;

        if ($num == 1) {
            // echo "hii";
            $row = mysqli_fetch_assoc($result);
            setcookie("id", $row['id'], time() + 86400, "/");
            // echo $row['idRegister'];
            $login = true;


            header("location:index.php");
        } else {
            // $showError = "Invalid Credentials";
            header("location:404.php");
        }
    }

    ?>
    <!DOCTYPE html>

    <html class="no-js" lang="en">


    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Admin &ndash; RIYA</title>
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

            <!--Header-->
            <div class="header-wrap animated d-flex">
                <div class="container-fluid">
                    <div class="row align-items-center">
                       
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
                            <h1 class="page-width"><b> Admin Login</b> </h1>
                        </div>
                    </div>
                </div>
                <!--End Page Title-->

                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                            <div class="mb-4">
                                <form method="post" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerEmail">Email</label>
                                                <input type="email" name="email" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group">
                                                <label for="CustomerPassword">Password</label>
                                                <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="">
                                            </div>
                                            <input type="checkbox" onclick="myFunction()">
                                            <label for="CustomerPassword">Show Password</label>



                                            <script>
                                                function myFunction() {
                                                    var x = document.getElementById("CustomerPassword");
                                                    if (x.type === "password") {
                                                        x.type = "text";
                                                    } else {
                                                        x.type = "password";
                                                    }
                                                }
                                            </script>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                            <input type="submit" class="btn mb-3" value="Sign In">



                                            <p class="mb-4">
                                                <!-- <a href="#" id="RecoverPassword">Forgot your password?</a> &nbsp; -->
                                                <!-- <a href="register.php" id="customer_register_link">Create account</a> -->
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--End Body Content-->



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
            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/chart/chart.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="lib/tempusdominus/js/moment.min.js"></script>
            <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

            <!-- Template Javascript -->
            <script src="js/main.js"></script>
        </div>
    </body>



    </html>