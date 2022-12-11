<!DOCTYPE html>
<html class="no-js" lang="en">
<?php include "backend/header.php"; ?>

<body><br><br><br><br>
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><b>Enter your cancellation reason here..</b></h1>

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
                                        <input type="submit" class="btn mb-3" value="Submit">
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
    $sql = "UPDATE `sales_order` SET `is_cancel`=1,`cancel_reason`='$reason' WHERE idSales_Order=$sid";
    $ress = mysqli_query($conn, $sql);
    if ($ress) {
        $sql1 = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE sales_order.Retailer_idRetailer =$id AND sales_order.idSales_Order =$sid";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $pid = $row1['Product_Master_idProduct_Master'];
        $sql2 = "SELECT * FROM product_master WHERE idProduct_Master =$pid";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $qty = $row2['Product_Qty'];
        $qty1 = $row1['Product_qty'] + $qty;
        $sql3 = "UPDATE `product_master` SET `Product_Qty`=$qty1 WHERE idProduct_Master=$pid";
        $result3 = mysqli_query($conn, $sql3);
        // echo "<script>alert('Order has been cancelled');</script>";
        echo "<script>window.location.href='myorder.php'</script>";
    }
}

?>
<?php include "backend/footer.php"; ?>