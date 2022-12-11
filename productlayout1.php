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
$catid = $_GET['idCategory'];
$sql = "SELECT * FROM `product_master` WHERE Product_Category_idProduct_Category= $catid ";
$result = mysqli_query($conn, $sql);

//  $num = mysqli_num_rows($result);
?>
<!--Body Content-->
<div id="page-content">

    <!--Collection Tab slider-->
    <br><br><br><br><br>
    <div class="tab-slider-product section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="section-header text-center">
                        <h2 class="h2" id="main"><b><?php echo $_GET['catName'] ?></b></h2>
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
                                 
										<a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '" name="idProduct"><img src="admin/' . $row['image_url'] . '" alt="image not found" width="100px" height="400px">
								
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


</div>
</body>
<!--End Body Content-->
<?php
include "backend/footer.php";
?>



</html>