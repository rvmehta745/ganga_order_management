<?php
include 'backend/db_connect.php';
if ($_COOKIE['id'] == "") {
    header("location:signin.php");
} else {
    $sql = "Select * from `admin` where `id` = '" . $_COOKIE['id'] . "'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
}
if ($num == 1) {
    // echo "hii";
    $row = mysqli_fetch_assoc($result);

?>

    <head>
        <meta charset="utf-8">
        <title>Riya Enterprise-Dashboard</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <header>
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0  me-lg-3">
            <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"> <img src="assets/images/riya-logo.png" alt="Skumar" title="Skumar" /></h2>

            </a>
            <!-- <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a> -->
            <!-- <form class="d-none d-md-flex ms-4">
                <input class="form-control border-2" type="search" placeholder="Search">
            </form> -->
            <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">


                </div>
                <div class="nav-item dropdown">


                </div>
                <!-- <div class="nav-item dropdown ">
                    <a href="#" class="nav-link dropdown-toggle me-lg-5" data-bs-toggle="dropdown">
                        <img class="rounded-circle me-lg-4" src="img/user.jpeg" alt="" style="width: 40px; height: 40px;">
                        <span class="d-none d-lg-inline-flex me-lg-0 "><?php echo $row['company_name']; ?></span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-1 rounded-0 rounded-bottom m-0 me-lg-6">
                        <a href="profile.php" class="dropdown-item">My Profile</a>
                        <a href="logout.php" class="dropdown-item">Log Out</a>
                    </div>
                </div> -->
            </div>
        </nav>
    </header>


<?php
}
?>