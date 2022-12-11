  <?php
    include 'db_connect.php';
    if ($_COOKIE['idRetailer'] == "") {
        header("location:login.php");
    } else {
        $sql = "Select * from `retailer` where `idRetailer` = '" . $_COOKIE['idRetailer'] . "'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
    }
    if ($num == 1) {
        // echo "hii";
        $rows = mysqli_fetch_assoc($result);

    ?>
  <?php
        include "db_connect.php";
        $sqly = "SELECT * FROM product_master ";
        $resulty = mysqli_query($conn, $sqly);
        $roww = mysqli_fetch_assoc($resulty);
        $pid = $roww['idProduct_Master'];


        //  if(isset($_COOKIE['idProduct'])){
        //    echo var_dump($_GET['idProduct']);

        // $pid = $_GET['idProduct']  ;
        $id = $_COOKIE['idRetailer'];
        if ($_COOKIE['idRetailer'] == "") {
            header("location:login.php");
        }

        $sql = "SELECT * FROM cart NATURAL join product_master WHERE cart.Retailer_idRetailer=$id and cart.Product_Master_idProduct_Master=product_master.idProduct_Master";
        // echo "rushabh";
        $result = mysqli_query($conn, $sql);
        // echo var_dump($result);
        $num = mysqli_num_rows($result);
    }
    ?>
  <?php
    if (isset($_GET['idProduct'])) {
        $pid = $_GET['idProduct'];
        $sql3 = "SELECT * FROM `cart` WHERE cart.Product_Master_idProduct_Master = $pid And cart.Retailer_idRetailer=$id";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $sql4 = "SELECT * FROM `cart` WHERE cart.Retailer_idRetailer=$id";
        $result4 = mysqli_query($conn, $sql4);
        $num4 = mysqli_num_rows($result4);
    }
    if (isset($_POST['addtocart'])) {
        $qty = $_POST['qty'];
        if ($row3 > 0) {
            echo '
			<div class="alert alert-warning">
			 		<b>Product added in your cart..!</b>
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    </div>';
            //echo '<script> alert("Product is already added into the cart Continue Shopping..!") </script>';
        } else {
            $InsertCart = "INSERT INTO `cart`(`QTY`, `Retailer_idRetailer`, `Product_Master_idProduct_Master`) VALUES ($qty,$id,$pid)";
            $res = mysqli_query($conn, $InsertCart);
            if ($res > 0) {
                echo '<div class="alert alert-warning">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<b>Product is already added into the cart Continue Shopping..!</b>
					 </div>';
            } else {
                echo "something wrong";
            }
        }
    }
    // }
    ?>

  <!-- <script type='text/javascript'>
      (function() {
          if (window.localStorage) {
              if (!localStorage.getItem('firstLoad')) {
                  localStorage['firstLoad'] = true;
                  window.location.reload();
              } else
                  localStorage.removeItem('firstLoad');
          }
      })();
  </script> -->


  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Riya Enterprise</title>
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
      <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
      <!-- <link rel="stylesheet" href="assets/css/search.css"> -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
      <script src="http://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
  </head>

  <header>

      <body class="template-index belle template-index-belle">

          <div class="pageWrapper">
              <!--Search Form Drawer-->
              <div class="search">
                  <div class="search__form">


                      <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off" placeholder="Search ...">

                      <button type="button" class="search-trigger close-btn"><i class="anm anm-times-l"></i></button>
                      <div id="search_result"></div>
                  </div>
              </div>
              <!--End Search Form Drawer-->
              <!--Top Header-->
              <div class="top-header">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-10 col-sm-8 col-md-5 col-lg-4">
                              <p class="phone-no"><i class="anm anm-phone-s"></i>+91 9998966950</p>
                          </div>

                          <div class="col-sm-4 col-md-4 col-lg-4 d-none d-lg-none d-md-block d-lg-block">
                          </div>
                          <div class="col-2 col-sm-4 col-md-3 col-lg-4 text-right">
                              <span class="user-menu d-block d-lg-none"><i class="anm anm-user-al" aria-hidden="true"></i></span>
                              <ul class="customer-links list-inline">
                                  <li><a href="profile.php"><?php echo $rows['first_name']; ?></a></li>

                                  <!-- C:\xampp\phpMyAdmin\htdocs\project\login.php -->
                                  <li><a href="logout.php">Logout</a></li>
                                  <!-- <li><a href="register.php">Create Account</a></li> -->
                                  <li><a href="wishlist.php?idRetailer='.$rows['idRetailer'].'">Wishlist</a></li>


                                  <li><a href="myorder.php">My Orders</a></li>

                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
              <!--End Top Header-->
              <!--Header-->
              <div class="header-wrap classicHeader animated d-flex">
                  <div class="container-fluid">
                      <div class="row align-items-center">
                          <!--Desktop Logo-->
                          <div class="logo col-md-2 col-lg-2 d-none d-lg-block">
                              <a href="index.php">
                                  <img src="assets/images/riya-logo.png" alt="Riya Enterprise" title="Riya Enterprise" width="60%" />
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
                              <nav class="grid__item" id="AccessibleNav">
                                  <!-- for mobile -->
                                  <ul id="siteNav" class="site-nav medium center hidearrow">
                                      <li class="lvl1 parent megamenu"><a href="index.php">Home <i class="anm anm-angle-down-l"></i></a>
                                          <!-- <div class="megamenu style1"> -->
                                          <ul class="grid mmWrapper">
                                              <li class="grid__item large-up--one-whole">
                                                  <ul class="grid">
                                                      <!-- <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#" class="site-nav lvl-1">Home Group 1</a>
                                                            <ul class="subLinks">
                                                                <li class="lvl-2"><a href="index.php" class="site-nav lvl-2">Home 1 - Classic</a></li>
                                                            </ul>
                                                        </li> -->



                                                  </ul>
                                              </li>
                                          </ul>
                                          <!-- </div> -->
                                      </li>
                                      <li class="lvl1 parent megamenu"><a href="#">Category <i class="anm anm-angle-down-l"></i></a>
                                          <div class="megamenu style2">
                                              <ul class="grid mmWrapper">
                                                  <li class="grid__item one-whole">
                                                      <ul class="grid">
                                                          <?php
                                                            $cat = "SELECT * FROM product_category";
                                                            $resultcat = mysqli_query($conn, $cat);

                                                            while ($rowcat = mysqli_fetch_assoc($resultcat)) {
                                                                echo '<form method="post">
                                                          <li class="grid__item lvl-1 col-md-1 col-lg-3"><a href="productlayout1.php?idCategory=' . $rowcat['idProduct_Category'] . '&catName=' . $rowcat['Category_Name'] . '" class="site-nav lvl-1">' . $rowcat['Category_Name'] . '</a>
                                                          </li></form>
                                                           ';
                                                            } ?>
                                                          <!-- <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#" class="site-nav lvl-1">Product Features</a>
                                                              <ul class="subLinks">
                                                                  <li class="lvl-2"><a href="product-layout.php" class="site-nav lvl-2">Short Description</a></li>
                                                              </ul>
                                                          </li> -->
                                                          <!-- <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#" class="site-nav lvl-1">Product Features</a>
                                                              <ul class="subLinks">
                                                                  <li class="lvl-2"><a href="product-layout-1.php" class="site-nav lvl-2">Product with Variant Image</a></li>
                                                              </ul>
                                                          </li> -->
                                                          <!-- <li class="grid__item lvl-1 col-md-3 col-lg-3"><a href="#" class="site-nav lvl-1">Product Features</a>
                                                              <ul class="subLinks">
                                                                  <li class="lvl-2"><a href="product-layout-1.php" class="site-nav lvl-2">Product Accordion</a></li>
                                                              </ul>
                                                          </li> -->
                                                      </ul>
                                                  </li>
                                                  <!-- <li class="grid__item large-up--one-whole imageCol">
                                                      <a href="#"><img src="assets/images/megamenu-bg2.jpg" alt=""></a>
                                                  </li> -->
                                              </ul>
                                          </div>
                                      </li>
                                      <li class="lvl1"><a href="index.php?#main"><b>Explore!</b> <i class="anm anm-angle-down-l"></i></a></li>
                                  </ul>
                              </nav>
                              <!--End Desktop Menu-->
                          </div>
                          <!--Mobile Logo-->
                          <div class="col-6 col-sm-6 col-md-6 col-lg-2 d-block d-lg-none mobile-logo">
                              <div class="logo">
                                  <a href="index.php">
                                      <img src="assets/images/riya-logo.png" alt="Riya Enterprise" title="Riya Enterprise" />
                                  </a>
                              </div>
                          </div>
                          <!--Mobile Logo-->
                          <div class="col-4 col-sm-3 col-md-3 col-lg-2">
                              <div class="site-cart">
                                  <a href="#" class="site-header__cart" title="Cart">
                                      <i class="icon anm anm-bag-l"></i>
                                      <span id="CartCount" class="site-header__cart-count" data-cart-render="item_count"><?php echo $num ?></span>
                                  </a>
                                  <!--Minicart Popup-->
                                  <div id="header-cart" class="block block-cart">
                                      <ul class="mini-products-list">
                                          <?php
                                            $a = 1;
                                            $subtotal = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $b = 0;
                                                $b = $row['QTY'];
                                                $c = 0;
                                                $c = $row['Product_Price'];
                                                $taxable = 0;
                                                $taxable = $b * $c;

                                                $gst = 0;
                                                $gst = ($taxable * 12) / 100;
                                                $total = $taxable + $gst;
                                                $subtotal = $subtotal + $total;


                                                echo '
                                        
                                    <li class="item">
                                        <a class="product-image" href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">
                                            <img src="admin/' . $row['image_url'] . '" alt="not found" title="" />
                                        </a>
                                        <div class="product-details">
                                            <a href="deletecart.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '" class="remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                                          
                                            <a class="pName" href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '">' . $row['Product_Name'] . '</a>
                                          
                                            
                                            <div class="wrapQtyBtn">
                                                <div class="qtyField">
                                                <div class="variant-cart"><b>Qty : ' . $row['QTY'] . '</b></div>
                                                </div>
                                            </div>
                                            <div class="priceRow">
                                                <div class="product-price">
                                                    <span class="money">₹ ' . $row['Product_Price'] . '<small>.00</small></span>
                                                </div>
                                            </div>
                                               
                                        </div>
                                    </li>
                                    ';
                                            }  ?>
                                      </ul>




                                      <div class="total">
                                          <div class="total-in">
                                              <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money">₹<?php echo  $subtotal ?></span></span>
                                          </div>



                                          <div class="buttonSet text-center">
                                              <?php
                                                if ($subtotal == 0) {
                                                    echo '<lable><b> Your Cart is Empty  <a href="index.php?#main"><button > <u>click here</u></button></a> to buy.. <b/></lable>';
                                                } else {
                                                    echo '<a href="checkout.php" class="btn btn-secondary btn--small">Checkout</a>';
                                                } ?>
                                          </div>
                                      </div>


                                  </div>
                                  <!--EndMinicart Popup-->
                              </div>


                              <div class="site-header__search">

                                  <button type="button" class="search-trigger"><i class="icon anm anm-search-l"></i></button>
                                  <!-- <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off" placeholder="Search ..."> -->

                              </div>

                              <script type="text/javascript">
                                  $(document).ready(function() {
                                      $("#live_search").keyup(function() {
                                          var query = $(this).val();
                                          if (query != "") {
                                              $.ajax({
                                                  url: 'ajax-live-search.php',
                                                  method: 'POST',
                                                  data: {
                                                      query: query
                                                  },
                                                  success: function(data) {
                                                      $('#search_result').html(data);
                                                      $('#search_result').css('display', 'block');
                                                      $("#live_search").focusout(function() {
                                                          $('#search_result').css('display', 'none');
                                                      });
                                                      $("#live_search").focusin(function() {
                                                          $('#search_result').css('display', 'block');
                                                      });
                                                  }
                                              });
                                          } else {
                                              $('#search_result').css('display', 'none');
                                          }
                                      });
                                  });
                              </script>

                          </div>

                      </div>


                  </div>
              </div>
          </div>
          <!--End Header-->

  </header>