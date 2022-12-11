<!DOCTYPE html>
<html>
<?php include "backend/sidebar.php"; ?>
<div class="content">
    <?php include "backend/header.php"; ?>
    <?php
    include "backend/db_connect.php";
    // $id = $_COOKIE["idRetailer"];
    $orderid = $_GET['orderid'];
    $sql = "SELECT * FROM `sales_order` NATURAL JOIN retailer WHERE sales_order.Retailer_idRetailer=retailer.idRetailer";
    $ress = mysqli_query($conn, $sql);
    $num4 = mysqli_num_rows($ress);

    // $sql11="SELECT * FROM sales_order_detail JOIN product_master ON sales_order_detail.Product_Master_idProduct_Master = product_master.idProduct_Master WHERE sales_order_detail.Sales_Order_idSales_Order =$orderid";
    $sql11 = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE  sales_order.idSales_Order = $orderid";
    $res11 = mysqli_query($conn, $sql11);
    $row111 = mysqli_fetch_assoc($ress);
    echo '

                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="active">
                                        <th><h4><b>ORDER No. : ODR00' . $orderid . '</b></h4>
                                      </th>
                                       ';
    // include "track.php";


    $summ = 0;
    $total = 0;
    while ($row11 = mysqli_fetch_assoc($res11)) {
        // echo $row11['Product_Name'] . "<br>";
        // echo $row11['Product_qty'] . "<br>";
        // echo "<br>".$row11['Product_Price'] . "<br>";
        // echo "<br>".$row11['Total_Amount'] . "<br>";
        $proid = $row11['Product_Master_idProduct_Master'];
        $qty = $row11['Product_qty'];
        $taxable = $row11['Product_Price'];
        $total1 = $qty * $taxable;
        $total = $total + $total1;
        $summ = ($total * 12) / 100;
        $final = $total + $summ;
        echo '
                                    <tr>
                                        <td>
                                            <img src="' . $row11['image_url'] . '" alt="" width="100px" height="100px"/>
                                        </td>
                                        <td>
                                            <span><b>Product Name : </b>' . $row11['Product_Name'] . '</span><br/>
                                             <span><b>Details :</b>' . $row11['Product_Details'] . '</span><br/>
                                            </td>
                                        <td>
                                        <span><b>Quantity : </b>' . $row11['Product_qty'] . '</span><br/>
                                        <span><b>Product Price : </b>₹ ' . $row11['Product_Price'] . '</span><br/>
                                       
                                        </td>
                                       
                                    </tr>';
    }


    echo '
                                <tr>
                                <td colspan="2" align="right"><b>Taxable Amount :</b></td>
                                <td><b>₹ ' . $total . '</b><small><b>.00</b></small></td>
                            </tr>
                            <tr>
                                        <td colspan="2" align="right"><b>GST Amount :</b></td>
                                        <td><b>₹ ' . $summ . ' </b><small><b>.00</b></small></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right"><b>Total Amount :</b></td>
                                        <td><b>₹ ' . $final . '</b><small><b>.00</b></small></td>
                                    </tr>
                                </tbody>
                            </table>';
    ?>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>

</html>