<!DOCTYPE html>
<html>
<?php include "backend/sidebar.php"; ?>

<head>
  <link href="css/astyle.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script>
    $(document).ready(function() {
      $('#employee_data').DataTable();
    });
  </script>


</head>

<body>


  <div class="content">
    <?php include "backend/header.php"; ?>
    <?php
    include 'backend/db_connect.php';
    // $id=$_GET['idProduct_Master'];
    $selectSalesOrder = "SELECT * FROM sales_order ORDER BY idSales_Order DESC";
    $result = mysqli_query($conn, $selectSalesOrder);

    ?>
    <div class="p-2 mb-2 border-5 me-lg-5">
      <div class="ms-3">
        <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
        <br />

        <div id="" class="">
          <table id="employee_data" class="table table-striped">
            <thead>
              <tr>
                <td>OrderNo. </td>
                <td>Retailer ID </td>
                <td>Price</td>
                <td>Total Qty</td>
                <td>Order Date </td>
                <td>Credit Due Date </td>
                <td>See More Detais </td>
                <td>Accept Order</td>
                <td>Cancel Order</td>


              </tr>
            </thead>
            <?php
            $cnt = 1;
            while ($saleOrderRow = mysqli_fetch_array($result)) {
              $date = date_create($saleOrderRow["Sales_Order_Date"]);
              date_add($date, date_interval_create_from_date_string("30 days"));
              echo '<tr>';
              echo '

                              <th scope="row">' . $saleOrderRow['idSales_Order'] . '</th>
        <th scope="row">' . $saleOrderRow['Retailer_idRetailer'] . '</th>
        <th>' . $saleOrderRow['Total_Amount'] . '</th>
         <th scope="row">' . $saleOrderRow['Net_Qty'] . '</th>
          <th>' . $saleOrderRow["Sales_Order_Date"] . '</th>
           <th scope="row"> ' . date_format($date, "Y-m-d") . '</th>
                  <th scope="row"><a href="showOrderDetail.php?orderid=' . $saleOrderRow['idSales_Order'] . '">See More</th>';
              if ($saleOrderRow['is_cancel'] == null) {
                echo '<th scope="row"><a onClick=\'javascript: return confirm("Are you sure you want to accept this order?");\' href="AcceptCancel.php?salesOrderId=' . $saleOrderRow['idSales_Order'] . '&isCanceled=0" class="btn btn-success" ><b>Accept</b></a></th>
        <th scope="row"><a onClick=\'javascript: return confirm("Are you sure you want to accept this order?");\' href="AcceptCancel.php?salesOrderId=' . $saleOrderRow['idSales_Order'] . '&isCanceled=1" class="btn btn-danger" >Cancel Order</a></th>';
              } elseif ($saleOrderRow['is_cancel'] == 1) {
                echo '
         <th scope="row"></th>
         <th scope="row"><button type="button" class="btn btn-danger" disabled> Order Cancelled</button></th>
         ';
              } elseif ($saleOrderRow['is_cancel'] == 0) {
                echo '
         <th scope="row"><button type="button" class="btn btn-success"  disabled><b>Order Accepted</b></button></th>
         <th scope="row">
         </th>
         </th>
         ';
              }
              echo '</tr>  ';
              $cnt++;
            }
            ?>
          </table>

        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>