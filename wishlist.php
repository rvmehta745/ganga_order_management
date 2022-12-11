<!DOCTYPE html>
<html class="no-js" lang="en">



<?php include "backend/header.php"; ?>
<?php
include "backend/db_connect.php";
if (isset($_GET['idRetailer'])) {

    // $pid = $_GET['idProduct'];
    $id = $_COOKIE['idRetailer'];
    $sql = "SELECT * FROM wishlist NATURAL join product_master WHERE wishlist.Retailer_idRetailer=$id and wishlist.Product_Master_idProduct_Master=product_master.idProduct_Master";
    $result = mysqli_query($conn, $sql);
    //  $rows=mysqli_num_rows($result);
    // $row = mysqli_fetch_array($result);




}

// echo $name;
?>

<!--Body Content-->
<br><br><br><br><br><br>
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><b>Wish List</b></h1>

            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">

                <form>
                    <div class="wishlist-table table-content table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-name text-center alt-font">Remove</th>
                                    <th class="product-price text-center alt-font">Images</th>
                                    <th class="product-name alt-font">Name</th>
                                    <th class="product-price text-center alt-font">Price</th>
                                    <th class="stock-status text-center alt-font">Stock Status</th>
                                    <!-- <th class="product-subtotal text-center alt-font">Add to Cart</th> -->
                                </tr>
                            </thead>

                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                if ($row['Product_Qty'] > 0) {
                                    $status = "In Stock";
                                } else {
                                    $status = "Out of Stock";
                                }
                                echo '
                                    <tbody> 
                                        
                                        <tr>
                                            <td class="product-remove text-center" valign="middle">
                                            <a href="deleteproduct.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '" >
                                            <button  type="button" name="del"><i class="icon icon anm anm-times-l"></i></button>
                                            </a></td>
                                           
                                            <td class="product-thumbnail text-center">
                                                <a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '"><img src="admin/' . $row['image_url'] . '"  alt="" title="" /></a>
                                                </td>
                                            <td class="product-name">
                                                <h4 class="no-margin"><a href="productlayout.php?idRetailer=' . $rows["idRetailer"] . '' . '&idProduct=' . $row["idProduct_Master"] . '"><b>' . $row['Product_Name'] . '</b></a></h4>
                                                 <span class="">' . $row['Product_Details'] . '</span>
                                            </td>
                                           
                                            <td class="product-price text-center"><span class="amount"><b>₹ ' . $row['Product_Price'] . '<small><b>.00</small></span></td>
                                             <td class="stock text-center"> 
                                             <span class="out-of-stock">' . $status . '</span> 
                                             </td>
                                            
                                        </tr>
                                           
                                       
                                    </tbody> 
                                   ';
                            } ?>
                        </table>
                    </div>
                </form>

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