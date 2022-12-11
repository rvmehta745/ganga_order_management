<?php


include 'backend/db_connect.php';
//echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $company_name = $_POST['company_name'];
    $bank_name = $_POST['bank_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gst_no = $_POST['gst_no'];
    $phone_no = $_POST['phone_no'];
    $bank_ifsc = $_POST['bank_ifsc'];
    $bank_acc = $_POST['bank_acc'];

    $sql = "INSERT INTO `retailer`(`first_name`, `last_name`, `Company_Name`, `Bank_Name`, `Address`, `E-mail`, `Password`, `GST`, `Phone`, `Bank_IFSC`, `Bank_acc`)
   VALUES ('$first_name','$last_name','$company_name','$bank_name','$address','$email','$password','$gst_no','$phone_no','$bank_ifsc','$bank_acc')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        //echo "inserted";
        header("location:login.php");
    } else {
        echo '<div class="alert alert-warning">
			<b>Please check the details..</b>
					 </div>';
    }
}

?>
<!DOCTYPE html>

<html class="no-js" lang="en">



<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Create an Account &ndash; Skumar</title>
    <meta name="description" content="description">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/riya-logo.png" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/plugins.css">
    <!-- Bootstap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body class="page-template belle">
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


                        <p class="phone-no"><i class="anm anm-phone-s"></i> +91 9016485585</p>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">

                    </div>
                    <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                        <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                        <ul class="customer-links list-inline">
                            <li><a href="login.php">Login</a></li>


                        </ul>
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
                        <div class="logo">
                            <a href="index.php">
                                <img src="assets/images/riya-logo.png" alt="Skumar" title="Skumar" />
                            </a>
                        </div>
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
                        <h1 class="page-width"><b>Create an Account</b></h1>
                    </div>
                </div>
            </div>
            <!--End Page Title-->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                        <div class="mb-4">
                            <form method="post" action="#" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="FirstName">First Name</label>
                                            <input type="text" name="first_name" placeholder="" id="FirstName" autofocus="" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Last Name</label>
                                            <input type="text" name="last_name" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Company Name</label>
                                            <input type="text" name="company_name" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Bank Name</label>
                                            <input type="text" name="bank_name" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Address</label>
                                            <input type="text" name="address" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerEmail">Email</label>
                                            <input type="email" name="email" placeholder="" id="CustomerEmail" class="" autocorrect="off" autocapitalize="off" autofocus="" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerPassword">Password</label>
                                            <input type="password" value="" name="password" placeholder="" id="CustomerPassword" class="" required>

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

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">GST No.</label>
                                            <input type="text" name="gst_no" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Phone No.</label>

                                            <input type="tel" name="phone_no" pattern="[0-9]{10}" placeholder="" id="LastName" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Bank IFSC</label>
                                            <input type="text" name="bank_ifsc" pattern="^[A-Z]{4}[0-9]{7}$" placeholder="" id="LastName" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="LastName">Bank Account Number</label>
                                            <input type="text" name="bank_acc" pattern="^[0-9]{8}[0-9]{4}$" placeholder="" id="LastName" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                        <input type="submit" class="btn mb-3" value="Create">
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
        <?php
        include "backend/footer.php";
        ?>
</body>



</html>