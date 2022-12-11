<!DOCTYPE html>
<html class="no-js" lang="en">
<?php include "backend/header.php"; ?>

<body><br><br><br><br>
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><b>Enter your replace reason here..</b></h1>

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
                                    <h1>Enter your reason :</h1>
                                    <input type="text" name="reason" placeholder="Enter here.." id="LastName" required>
                                </div><br><br>
                                <div class="row">
                                    <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                        <input type="submit" class="btn mb-3" value="Replace">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<?php
include "backend/db_connect.php";
$id = $_COOKIE['idRetailer'];
$sid = $_GET['orderid'];
if (isset($_POST['reason'])) {
    $reason = $_POST['reason'];
    $id_replace=1;
    $sql9 = "INSERT INTO sales_replace (Sales_Replace_Reason,is_replace,Sales_Order_idSales_Order ) VALUES ('$reason','$id_replace','$sid')";
    $res9 = mysqli_query($conn, $sql9);
    if ($res9) {
        $sql12 = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE sales_order.Retailer_idRetailer =$id AND sales_order.idSales_Order =$sid";
        $result12 = mysqli_query($conn, $sql12);
        $sql14 = "SELECT * FROM sales_replace WHERE Sales_Order_idSales_Order =$sid";
        $result14 = mysqli_query($conn, $sql14);
        $row14 = mysqli_fetch_assoc($result14);
        $ids = $row14['idSales_Replace'];
        while ($row12 = mysqli_fetch_assoc($result12)) {

            $pid = $row12['Product_Master_idProduct_Master'];
            $qty = $row12['Product_qty'];
            // echo $pid;
            // echo $qty;
            echo $ids;
            $sql13 = "INSERT INTO `sales_replace_detail` (`qty_replace`, `Sales_Replace_idSales_Replace`, `Product_Master_idProduct_Master`) VALUES ('$qty', '$ids', '$pid')";
            $res13 = mysqli_query($conn, $sql13);
            if ($res13) {
                // echo "success";
                echo '<script> 
                    window.location.href="myorder.php"
                    </script>';
            } else {
                // echo "failed";
            }
        }
    }
}

?>
<?php include "backend/footer.php"; ?>