<!DOCTYPE html>
<html class="no-js" lang="en">



<?php include "backend/header.php"; ?>
<?php
include "backend/db_connect.php";
$id = $_COOKIE['idRetailer'];
//how to fetch order details from database
// $sql = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE sales_order.Retailer_idRetailer =" . $_COOKIE['idRetailer'] . "";
$sql = "SELECT * FROM `sales_order` WHERE Retailer_idRetailer=$id ORDER by idSales_Order DESC";
$ress = mysqli_query($conn, $sql);
$num4 = mysqli_num_rows($ress);

?>

<!--Body Content-->
<br><br><br><br><br><br>
<div id="page-content">
    <!--Page Title-->
    <div class="page section-header text-center">
        <div class="page-title">
            <div class="wrapper">
                <h1 class="page-width"><b>Your Order</b></h1>

            </div>
        </div>
    </div>
    <!--End Page Title-->

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">

                <div class="wishlist-table table-content table-responsive">
                    <?php
                    if ($num4 > 0) {
                        while ($row = mysqli_fetch_assoc($ress)) {
                            $sql14 = "SELECT * FROM sales_replace WHERE Sales_Order_idSales_Order =$row[idSales_Order]";
                            $result14 = mysqli_query($conn, $sql14);
                            $row14 = mysqli_fetch_assoc($result14);

                            $date = date_create($row["Sales_Order_Date"]);
                            date_add($date, date_interval_create_from_date_string("30 days"));
                            $a = $row['idSales_Order'];
                            if ($row['is_cancel'] == null) {
                                $status = "Pending";
                            } else if ($row['is_cancel'] == 1) {
                                $status = 'Cancelled <br>Cancel Reason : ' . $row['cancel_reason'] . '<br>Cancel Date : ' . $row['cancel_date'] . '</b><th></th>';
                            } else if ($row['is_cancel'] == 0) {
                                // if ($row14['is_replace'] == 1) {
                                //     $status = "Accepted" . "<br><b>Oreder Replace on :" . $row14['Sales_Replace_Date'] . " </b>
                                // &nbsp  &nbsp <a href='invoice.php?orderid=" . $row['idSales_Order'] . "'><button type='submit'><b>Download Invoice</b></button></a>";
                                // } else {
                                $status = "Accepted" . "<br><b>Credit due date : ( " . date_format($date, "Y-m-d") . " )</b>
                                &nbsp  &nbsp <a href='invoice.php?orderid=" . $row['idSales_Order'] . "'><button type='submit'><b>Download Invoice</b></button></a>";
                                // }
                            }
                            echo '

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="active">
                                        <th><h4><b>ORDER No. : ODR00' . $row['idSales_Order'] . '</b></h4>
                                        <b>Order Placed On: ( ' . $row['Sales_Order_Date'] . ' )</b>
                                        
                                        </th>
                                        <th><b>Order Status : ' . $status . '</b></th>';
                            if ($row['is_cancel'] == null) {
                                echo '
                                <th><a href="salesCancel.php?orderid=' . $row['idSales_Order'] . '" ><button type="button" class="btn btn-primary" >
                                                          Cancel</button></a><br> 
                                                           </th>  ';
                            } else if ($row['is_cancel'] == 1) {
                            } else if ($row['is_cancel'] == 0) {
                                // if ($row14['is_replace'] == null) {
                                echo '<th><a href="salesReplace.php?orderid=' . $row['idSales_Order'] . '" >
                                    <button type="button" class="btn btn-primary">Replace</button></a><br> </th> ';
                                // } else {
                                //     $isrep = 1;
                                //     echo '<th>Your order is replaced</th>';
                                // }
                            }
                            // include "track.php";
                            echo '</th>
                                    </th>
                                    </tr>';
                            $sql2 = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE sales_order.Retailer_idRetailer =" . $_COOKIE['idRetailer'] . " AND sales_order.idSales_Order =" . $a . "";
                            $result2 = mysqli_query($conn, $sql2);
                            $summ = 0;
                            $total = 0;
                            while ($row2 = mysqli_fetch_assoc($result2)) {

                                $proid = $row2['Product_Master_idProduct_Master'];
                                $qty = $row2['Product_qty'];
                                $taxable = $row2['Product_Price'];
                                $total1 = $qty * $taxable;
                                $total = $total + $total1;
                                $summ = ($total * 12) / 100;

                                echo '
                                    <tr>
                                        <td>
                                            <img src="admin/' . $row2['image_url'] . '" alt="" width="100px" height="100px"/>
                                        </td>
                                        <td>
                                            <span><b>Product Name : </b><a href="productlayout.php?idRetailer=' . $_COOKIE['idRetailer'] . '' . '&idProduct=' . $row2["idProduct_Master"] . '">' . $row2['Product_Name'] . '</a></span><br/>
                                              
                                            </td>
                                        <td>
                                        <span><b>Quantity : </b>' . $row2['Product_qty'] . '</span><br/>
                                        <span><b>Product Price : </b>₹ ' . $row2['Product_Price'] . '</span>    
                                       
                                        </td>
                                       
                                    </tr>';
                            }

                            echo '
                                <tr>
                                <td colspan="2" align="right"><b>Taxable Amount :</b></td>
                                <td><b>₹ ' . $row['taxable_amount'] . '</b><small><b>.00</b></small></td>
                            </tr>
                            <tr>
                                        <td colspan="2" align="right"><b>Gst Amount :</b></td>
                                        <td><b>₹ ' . $summ . ' </b><small><b>.00</b></small></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right"><b>Total Amount :</b></td>
                                        <td><b>₹ ' . $row['Total_Amount'] . '<small><b>.00</b></small></b></td>
                                    </tr>
                                </tbody>
                            </table>';
                        }
                    } else {
                        echo '
                                <div class="empty-result">
                        No Orders Found.
                    </div>';
                    }
                    ?>
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