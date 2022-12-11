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
       <div class="sidebar pe-4 pb-3">
           <nav class="navbar bg-light navbar-light">
               <div class="navbar-brand mx-4 mb-3">
                   <a href="index.php">
                       <img src="../assets/images/riya-logo.png" height="30px" width="100px" alt="RIYA" title="RIYA" />
                   </a>
               </div>
               <div class="nav-item dropdown ">
                   <a href="index.php" class="nav-link dropdown-toggle me-lg-5" data-bs-toggle="dropdown">
                       <img class="rounded-circle me-lg-4" src="img/user.jpeg" alt="" style="width: 40px; height: 40px;">
                       <span class="d-none d-lg-inline-flex me-lg-0 "><?php echo $row['company_name']; ?></span>

                   </a>
                   <div class="dropdown-menu dropdown-menu-end bg-light border-1 rounded-0 rounded-bottom m-0 me-lg-6">
                       <a href="profile.php" class="dropdown-item">My Profile</a>
                       <a href="logout.php" class="dropdown-item">Log Out</a>
                   </div>
               </div>

               <div class="navbar-nav w-100">
                   <a href="index.php" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                   <div class="nav-item dropdown">

                       <a href="salesOrders.php" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>Orders</a>
                       <!-- <div class="dropdown-menu bg-transparent border-1"> -->
                       <!-- <a href="salesOrders.php" class="dropdown-item">All Orders</a> -->
                       <a href="acceptorder.php" class="dropdown-item">Accept Orders</a>
                       <a href="cancelorder.php" class="dropdown-item ">Cancel Orders</a>

                       <!-- </div> -->


                   </div>
                   <a href="retailer.php" class="nav-item nav-link"><i class="fa fa-table me-2 "></i>Retailer Details</a>
                   <a href="productView.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>View Products</a>
                   <a href="purchaseOrderdetails.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Purchase Orders</a>
                   <a href="salesReplace.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Replace Orders</a>
                   <a href="../admin/report/index.php" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Sales Report</a>

               </div>

           </nav>
       </div>

   <?php
    }
    ?>