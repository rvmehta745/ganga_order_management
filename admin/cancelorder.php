  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Start -->
    <?php include "backend/header.php"; ?>
    <!-- Navbar End -->

    <!-- add product -->

    <?php


    include "backend/db_connect.php";

    // $id = $_COOKIE["idRetailer"];
    // $selectSalesOrder="SELECT * FROM sales_order_detail 
    // LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order 
    // LEFT OUTER JOIN product_master on Product_Master_idProduct_Master  =product_master.idProduct_Master 
    // WHERE sales_order.Retailer_idRetailer =$id";
    $selectSalesOrder = "SELECT * FROM sales_order WHERE is_cancel=1 ORDER by idSales_Order DESC ";
    $res = mysqli_query($conn, $selectSalesOrder);
    // echo $id;

    if (mysqli_num_rows($res) > 0) {

      // $cnt = 1;
      $str = '<table class="table table-striped">
    <thead>
    <tr>
    <th scope="col">Order No.</th>
    <th scope="col">Retailer ID :</th>
    <th scope="col">Price :</th>
    <th scope="col">Total Qty :</th>
    <th scope="col">Order Date :</th>
    <th scope="col">Cancel Date :</th>
    <th scope="col">See More Details :</th>
    <th scope="col">AcceptOrder :</th>
    <th scope="col">CancelOrder :</th>
     </tr>
    </thead>
    ';
      while ($saleOrderRow = mysqli_fetch_assoc($res)) {
        $str .= '<tbody>
        <th scope="row">' . $saleOrderRow['idSales_Order'] . '</th>
        <th scope="row">' . $saleOrderRow['Retailer_idRetailer'] . '</th>
        <th>' . $saleOrderRow['Total_Amount'] . '</th>
         <th scope="row">' . $saleOrderRow['Net_Qty'] . '</th>
        <th>' . $saleOrderRow["Sales_Order_Date"] . '</th>
         <th scope="row"> '.$saleOrderRow['cancel_date'].'</th>
        <th scope="row"><a href="showOrderDetail.php?orderid=' . $saleOrderRow['idSales_Order'] . '">See More</th>
        ';
        //    echo $saleOrderRow['Is_canceled'];
        if ($saleOrderRow['is_cancel'] == NULL) {
          $str .= '<th scope="row"><a href="AcceptCancel.php?salesOrderId=' . $saleOrderRow['idSales_Order'] . '&isCanceled=0" class="btn btn-success" ><b>Accept</b></a></th>
        <th scope="row"><a href="AcceptCancel.php?salesOrderId=' . $saleOrderRow['idSales_Order'] . '&isCanceled=1" class="btn btn-danger" >Cancel Order</a></th>';
        } elseif ($saleOrderRow['is_cancel'] == 1) {
          $str .= '
         <th scope="row"></th>
         <th scope="row"><button type="button" class="btn btn-danger" disabled> Order Cancelled</button></th>  
         ';
        } elseif ($saleOrderRow['is_cancel'] == 0) {
          $str .= '
         <th scope="row"><button type="button" class="btn btn-success"  disabled><b>Order Accepted</b></button></th>
         <th scope="row">
         </th>
         </th>
         ';
        }

        // $str.= '<th scope="row"><a href="#">See More</th>';
        // $sql11="SELECT * FROM sales_order_detail JOIN product_master ON sales_order_detail.Product_Master_idProduct_Master = product_master.idProduct_Master WHERE sales_order_detail.Sales_Order_idSales_Order =$saleOrderRow[idSales_Order]";
        // $res11 = mysqli_query($conn, $sql11);
        // $row11 = mysqli_fetch_assoc($res11);
        // echo $saleOrderRow['is_cancel'];

        // echo $row11['Product_Name'] . "<br>";
        // echo $row11['Product_qty'] . "<br>";
        // echo "<br>".$row11['Product_Price'] . "<br>";
        // echo "<br>".$saleOrderRow['Total_Amount'] . "<br>";

      }
      $str .= "</tbody></table>";
      echo $str;
    }



    ?>

    <!-- Content End -->









  </div>
  <!-- add product end -->


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="lib/chart/chart.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/tempusdominus/js/moment.min.js"></script>
  <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
  </body>

  </html>