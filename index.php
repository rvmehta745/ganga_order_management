<!DOCTYPE html>
<html class="no-js" lang="en">
<?php
include "backend/header.php";
?>
<!-- add to wishlist -->
<?php

include 'backend/db_connect.php';
if (isset($_GET['idRetailers'])) {
    $idRetailer = $_GET['idRetailers'];
    // echo $idRetailer;
    $idProduct =  $_GET['idProducts'];
    //  echo $idProduct;
    $sql1 = "SELECT * FROM `wishlist` WHERE wishlist.Retailer_idRetailer = $idRetailer AND wishlist.Product_Master_idProduct_Master = $idProduct";
    $result1 = mysqli_query($conn, $sql1);
    $num1 = mysqli_num_rows($result1);


    if ($num1 > 0) {

        echo '<script>alert("Product already added into wishlist please check in wishlist.!!");</script>';
        //   header('location:index.php');
    } else {
        $add = "INSERT INTO  `wishlist` VALUES ( '$idRetailer', '$idProduct')";
        $add_query = mysqli_query($conn, $add);
        // echo $num1;
        //echo '<script>alert("Product not added to wishlist '.$num1.'");</script>';
        //  header('location:index.php');

    }
}
?>
<!-- end add to wishlist -->
<?php
$sql = "SELECT * FROM `product_master` order by idProduct_Master DESC ";
$result = mysqli_query($conn, $sql);

//  $num = mysqli_num_rows($result);
?>
<!--Body Content-->
<div id="page-content">
    <!--Home slider-->
    <div class="slideshow slideshow-wrapper pb-section sliderFull">
        <div class="home-slideshow">
            <div class="slide">
                <div class="blur-up lazyload bg-size">
                    <img class="blur-up lazyload bg-img" data-src="assets/images/slideshow-banners/banner.jpeg" src="assets/images/slideshow-banners/banner.jpeg" alt="Shop Our New Collection" title="Shop Our New Collection" />
                    <div class="slideshow__text-wrap slideshow__overlay classic bottom">
                        <div class="slideshow__text-content bottom">
                            <div class="wrap-caption center">
                                <!-- <h2 class="h1 mega-title slideshow__title">Shop Our New Collection</h2> -->
                                <!-- <span class="mega-subtitle slideshow__subtitle">From Hight to low, classic or modern. We have you covered</span> -->
                                <!-- <span class="btn">Shop now</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Home slider-->
    <!--Collection Tab slider-->

    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="section-header text-center">
                        <h2 class="h2" id="main"><b>New Arrivals</b></h2>
                        <p><b>Browse the huge variety of our products</b></p>
                    </div>
                    <div class="tabs-listing">


                        <div class="tab_container">
                            <div id="tab1" class="tab_content grid-products">

                                <div class="productSlider">

                                    <!-- start product image -->
                                    <?php

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $sql0 = "SELECT * FROM product_master NATURAL JOIN product_category WHERE product_master.Product_Category_idProduct_Category=product_category.idProduct_Category AND product_master.idProduct_Master='" . $row['idProduct_Master'] . "'";
                                        $res0 = mysqli_query($conn, $sql0);
                                        $productRow0 = mysqli_fetch_assoc($res0);
                                        echo '
                           
							<div class="col-12 item">
								<div class="product-image">
                              
                                          
                                               <form method ="post">
                                         
									<div class="product-image" >
                                 
										<a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '" name="idProduct"><img src="admin/' . $row['image_url'] . '" alt="image not found" width="300px" height="300px">
								
                                      </a> </div>
                                      <div class="product-form__item--submit">
                                           <a  href="index.php?idRetailers=' . $rows["idRetailer"] . '' . '&idProducts=' . $row["idProduct_Master"] . '">
                                             <button  type="button" name="idRetailer"> Add To Wishlist</button>
                                             </a>
                                            </div> 
                                      <div class="product-body"  >
										 
										<h2 class="product-name"><b> ' . $row['Product_Name'] . '</b></a></h2>
										
                                        <h3 class="price">Category :- ' . $productRow0['Category_Name'] . '</h3>
									
                                        <h3 class="price"><b>Price :- ₹ ' . $row['Product_Price'] . '<small>.00</small></b></h3>
										
									</div>
                                   
                                          </form>           
								</div>
							</div>
							 ';
                                    }


                                    ?>







                                    <!-- end product image -->


                                </div>
                                <!-- end product image -->


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Collection Tab slider-->


    <br><br>

    <!-- Store Feature -->
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="section-header text-center">
                        <h2 class="h2" id="main"><b>Featured Products</b></h2>
                        <p><b>Browse the huge variety of our products</b></p>
                    </div>

                    <div class="tabs-listing">


                        <div class="tab_container">
                            <!-- <div id="tab1" class="tab_content grid-products"> -->

                            <div class="productSlider">

                                <!-- start product image -->
                                <?php

                                $sql21 = "SELECT * FROM `product_master`";
                                $result21 = mysqli_query($conn, $sql21);

                                while ($row21 = mysqli_fetch_assoc($result21)) {
                                    $sql0 = "SELECT * FROM product_master NATURAL JOIN product_category WHERE product_master.Product_Category_idProduct_Category=product_category.idProduct_Category AND product_master.idProduct_Master='" . $row21['idProduct_Master'] . "'";
                                    $res0 = mysqli_query($conn, $sql0);
                                    $productRow21 = mysqli_fetch_assoc($res0);
                                    echo '
                           
							<div class="col-12 item">
								<div class="product-image">
                              
                                          <center>
                                               <form method ="post">
                                         
									<div class="product-image" >
                                 
										<a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row21["idProduct_Master"] . '" name="idProduct">
                                        <img src="admin/' . $row21['image_url'] . '" alt="image not found" width="300px" height="300px">
								
                                      </a> </div>
                                      <div class="product-form__item--submit">
                                           <a  href="index.php?idRetailers=' . $rows["idRetailer"] . '' . '&idProducts=' . $row21["idProduct_Master"] . '">
                                             <button  type="button" name="idRetailer"> Add To Wishlist</button>
                                             </a>
                                            </div> 
                                      <div class="product-body"  >
										 
										<h2 class="product-name"><b> ' . $row21['Product_Name'] . '</b></a></h2>
										
                                        <h3 class="price">Category :- ' . $productRow21['Category_Name'] . '</h3>
										
                                        <h3 class="price"><b>Price :- ₹ ' . $row21['Product_Price'] . '<small>.00</small></b></h3>
										
									</div>
                                   
                                          </form>  </center>         
								</div>
							</div>
							 ';
                                }



                                ?>







                                <!-- end product image -->


                            </div>
                            <!-- end product image -->


                            <!-- </div> -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Store Feature-->
</div>
</body>
<!--End Body Content-->
<?php
include "backend/footer.php";
?>



</html>