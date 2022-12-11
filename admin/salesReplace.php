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
    $sql3 = "SELECT * FROM sales_order LEFT OUTER JOIN sales_replace ON sales_replace.Sales_Order_idSales_Order = sales_order.idSales_Order WHERE sales_replace.idSales_Replace ORDER by idSales_Order DESC ";
    $res3 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($res3) > 0) {

      echo '<table class="table table-striped">
    <thead>
    <th scope="col">Order No.</th>
    <th scope="col">Retailer ID :</th>                                
    <th scope="col">Reason :</th> 
    <th scope="col">Replace Date :</th>
    <th scope="col">See More :</th>
   ';
      while ($row3 = mysqli_fetch_assoc($res3)) {
        echo '<tbody>
        <th scope="row">' . $row3['Sales_Order_idSales_Order'] . '</th>
        <th scope="row">' . $row3['Retailer_idRetailer'] . '</th>
        <th>' . $row3['Sales_Replace_Reason'] . '</th>
        <th>' . $row3["Sales_Replace_Date"] . '</th>
       
        <th scope="row"><a href="showOrderDetail.php?orderid=' . $row3['Sales_Order_idSales_Order'] . '">See More</th>
        ';
       
      }
       echo " </thead></tbody></table>";
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