<!DOCTYPE html>
<html class="no-js" lang="en">



<?php include "backend/header.php"; ?>
<!--End Header-->
<?php
include 'backend/db_connect.php';
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
    include "backend/db_connect.php";
    $sqly = "SELECT * FROM product_master ";
    $resulty = mysqli_query($conn, $sqly);
    $roww = mysqli_fetch_assoc($resulty);
    $pid = $roww['idProduct_Master'];
    if (isset($pid)) {
        //    echo var_dump($_GET['idProduct']);

        //    $pid = $_GET['idProduct'];
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
        $sql3 = "SELECT * FROM `cart` WHERE cart.Product_Master_idProduct_Master = $pid And cart.Retailer_idRetailer=$id";
        $result3 = mysqli_query($conn, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        $sql4 = "SELECT * FROM `cart` WHERE cart.Retailer_idRetailer=$id";
        $result4 = mysqli_query($conn, $sql4);
        $num4 = mysqli_num_rows($result4);
    }
}

?>

<br><br><br><br>
<!--Body Content-->
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><b>Checkout</b></h1>
            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">


        <div class="p-2 mb-2 border-2">


            <div class="p-2 mb-2 border-5">
                <div class="your-order-payment">
                    <div class="your-order">
                        <h2 class="order-title mb-4"><b>Your Order</b></h2>

                        <div class="table-responsive-sm order-table">
                            <table class="bg-white table table-bordered table-hover text-center">
                                <thead>
                                    <tr><b>
                                            <th class="text-left">Image</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                            <th>Rate</th>
                                            <th>Taxable Amount</th>
                                            <th>GST Rate</th>
                                            <th>GST Amount</th>
                                            <th>Total</th>

                                        </b></tr>
                                </thead>
                                <?php
                                $a = 1;
                                $subtotal1 = 0;
                                $qty1 = 0;
                                $taxable1 = 0;
                                while ($row = mysqli_fetch_array($result)) {
                                    //   $tot = $row["Product_Price"] *  $row["QTY"];
                                    $b = 0;
                                    $b = $row['QTY'];
                                    $c = 0;
                                    $c = $row['Product_Price'];

                                    $taxable = $b * $c;

                                    $gst = 0;
                                    $gst = ($taxable * 12) / 100;
                                    $total = $taxable + $gst;
                                    $subtotal1 = $subtotal1 + $total;
                                    $qty = $row['QTY'];
                                    $qty1 = $qty1 + $qty;
                                    $taxable1 = $taxable1 + $taxable;

                                    echo ' 
                                        <tbody>
                                            <tr>
                                                 <th>  <img src="admin/' . $row['image_url'] . '" height = "50px" width="50px" alt="not found" title="" /></th>
                                                <td class="text-left"><b>' . $row['Product_Name'] . '</td>
                                                 <th><b>' . $row['QTY'] . '</th>
                                                <th><b>₹ ' . $row['Product_Price'] . '</th>
                                                <th ><b>₹' . $taxable . '</th>
                                                <th><b>12%</th>
                                                <th ><b>₹' . $gst . '</th>
                                                 <th ><b>₹' . $total . '</th>
                                            </tr>
                                        </tbody> 
                                       
                                          ';
                                } ?>



                                <td colspan="7" class="text-right"><b>Total :</b></td>
                                <td><b>₹ <?php echo  $subtotal ?></b></td>

                            </table>

                        </div>
                    </div>

                    <hr />

                    <div class="your-payment">

                        <div class="payment-method">

                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "backend/db_connect.php";
        $id = $_COOKIE['idRetailer'];
        $sql = "SELECT * FROM `cart` NATURAL join product_master WHERE cart.Retailer_idRetailer =$id AND product_master.idProduct_Master=cart.Product_Master_idProduct_Master ";
        // echo "rushabh";
        $result = mysqli_query($conn, $sql);
        // echo var_dump($result);
        // $num = mysqli_num_rows($result);
        if (isset($_POST['placeorder'])) {

            $id = $_COOKIE['idRetailer'];
            $gst = 12;
            $taxable = $taxable1;
            $subtotal = $subtotal1;
            $qty = $qty1;
            // echo $id;
            //    echo $qty;
            //    echo $subtotal;
            //    echo $taxable;
            // $add = "SELECT * FROM sales_order";
            // $result = mysqli_query($conn, $add);
            // $row = mysqli_fetch_assoc($result);
            // $id = $row['idSales_Order'];
            $sales1 = "INSERT INTO `sales_order` (`idSales_Order`, `Sales_Order_Date`, `taxable_amount`, `tax_amount`, `Total_Amount`, `Credit_Due_date`, `Net_Qty`, `is_cancel`, `Retailer_idRetailer`) 
            VALUES (NULL, current_timestamp(), $taxable, $gst,$subtotal, current_timestamp(), $qty, NULL,$id)";
            // $sales="INSERT INTO `sales_order`(`taxable_amount`, `tax_amount`, `Total_Amount`,`Net_Qty`,`is_cancel`,`Retailer_idRetailer `) 
            // VALUES ('$taxable','$gst','$subtotal','$qty',NULL,'$id')";
            // echo '<script>window.location="thankyou.php"</script>';
            $result2 = mysqli_query($conn, $sales1);
            if ($result2 > 0) {
                $sql3 = "SELECT * FROM `sales_order` WHERE Retailer_idRetailer  = $id ORDER BY idSales_Order  DESC LIMIT 1";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_assoc($result3);
                $ids = $row3['idSales_Order'];
                $qtyy=0;
                while ($row4 = mysqli_fetch_assoc($result)) {
                    $detail = "INSERT INTO `sales_order_detail`(`Product_qty`,`Product_Price`,`Sales_Order_idSales_Order`, `Product_Master_idProduct_Master`) VALUES ( '$row4[QTY]','$row4[Product_Price]',$ids,'$row4[Product_Master_idProduct_Master]')";
                    $result5 = mysqli_query($conn, $detail);
                    //update qty in product master
                    $sql6 = "SELECT * FROM `product_master` WHERE idProduct_Master = $row4[Product_Master_idProduct_Master]";
                    $result6 = mysqli_query($conn, $sql6);
                    $row6 = mysqli_fetch_assoc($result6);
                    $qtyy = $row6['Product_Qty'] - $row4['QTY'];
                    $sql7 = "UPDATE `product_master` SET `Product_Qty` = $qtyy WHERE idProduct_Master = $row4[Product_Master_idProduct_Master]";
                    $result7 = mysqli_query($conn, $sql7);

                    if ($result5 > 0) {

                        $remove = "DELETE FROM `cart` WHERE Retailer_idRetailer= " . $_COOKIE['idRetailer'] . "";
                        $result6 = mysqli_query($conn, $remove);
                        if ($result6 > 0) {
                            echo '<script>window.location="thankyou.php"</script>';
                        }
                    }
                }
            }
        }
        ?>


        <form method="post">
            <div class="order-button-payment"><a href="thankyou.php">
                    <button class="btn" name="placeorder" type="submit">Place order</button></a>
                <input type="hidden" name="taxable" value='.$taxable1.'>

                <input type="hidden" name="subtotal" value='.$subtotal1.'>
                <input type="hidden" name="qty" value='.$qty1.'>
            </div>
        </form>
    </div>
</div>
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