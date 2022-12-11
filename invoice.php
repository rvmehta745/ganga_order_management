<?php
include "backend/db_connect.php";
$id = $_COOKIE["idRetailer"];
$sid = $_GET['orderid'];
$sql = "SELECT * FROM `sales_order` WHERE Retailer_idRetailer=$id AND idSales_Order= $sid ";
$ress = mysqli_query($conn, $sql);
$num4 = mysqli_num_rows($ress);

$sql11 = "SELECT * FROM retailer JOIN sales_order ON retailer.idRetailer = sales_order.Retailer_idRetailer WHERE sales_order.idSales_Order =" . $_GET['orderid'] . " ";
$res11 = mysqli_query($conn, $sql11);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
   <!--  All snippets are MIT license http://bootdey.com/license -->
   <title>invoice</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
   <div class="container">
      <div class="col-md-12">
         <div class="invoice">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">
               <span class="pull-right hidden-print">
                  <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
                  <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
               </span><img src="assets/images/riya-logo.png" height="70px" width="200px" alt="Skumar" title="Skumar" />

            </div>
            <!-- end invoice-company -->
            <!-- begin invoice-header -->
            <div class="invoice-header">
               <div class="invoice-from">
                  <small>from</small>
                  <address class="m-t-5 m-b-5">
                     <strong class="text-inverse">Riya,</strong><br>
                     Shop 51/2, 20, Om Shanti Residency, Nikol gam road, Ahmedabad.-382350<br>
                     Phone : +91-+91 9998966950<br>
                     E-mail : riyaenterprise@gmail.com<br>
                     GST No. : 24CARPP2468N1ZW
                  </address>
               </div><?php
                     while ($row11 = mysqli_fetch_assoc($res11)) {
                        echo '
               <div class="invoice-to">
                  <small>to</small>
                  <address class="m-t-5 m-b-5">
                     <strong class="text-inverse">' . $row11["Company_Name"] . '</strong><br>
                    ' . $row11["Address"] . '<br>
                     Phone : ' . $row11["Phone"] . '<br>
                     E-mail : ' . $row11["E-mail"] . '<br>
                     GST No. : ' . $row11["GST"] . '<br>
                  </address>
               </div>
              ';
                     } ?>
               <?php
               while ($row = mysqli_fetch_assoc($ress)) {
                  $date = date_create($row["Sales_Order_Date"]);
                  date_add($date, date_interval_create_from_date_string("30 days"));

                  echo '  <div class="invoice-date">
                  <small>Invoice - ODR00' . $row['idSales_Order'] . '</small>
                  <div class="date text-inverse m-t-5">Order date : ' . $row["Sales_Order_Date"] . '</div>

                  <div class="invoice-detail"><b>Credit due date :  ' . date_format($date, "Y-m-d") . '</b></div>
               </div>';
               } ?>
            </div>
            <!-- end invoice-header -->
            <!-- begin invoice-content -->
            <div class="invoice-content">
               <!-- begin table-responsive -->
               <div class="table-responsive">
                  <table class="table table-invoice">
                     <thead>
                        <tr>
                           <th>PRODUCT DETAILS</th>
                           <th class="text-center" width="10%">QTY</th>
                           <th class="text-right" width="10%"></th>
                           <th class="text-center" width="10%">PRICE</th>
                           <th class="text-center" width="10%">GST (12%)</th>
                           <th class="text-right" width="20%">TOTAL</th>
                        </tr>
                     </thead>
                     <?php
                     $sql2 = "SELECT * FROM sales_order_detail LEFT OUTER JOIN sales_order ON sales_order_detail.Sales_Order_idSales_Order =idSales_Order LEFT OUTER JOIN product_master on Product_Master_idProduct_Master =product_master.idProduct_Master WHERE sales_order.Retailer_idRetailer =" . $_COOKIE['idRetailer'] . " AND sales_order.idSales_Order =$sid";
                     $result2 = mysqli_query($conn, $sql2);
                     $summ = 0;
                     $total = 0;
                     // $total1 = 0;
                     $subtotal = 0;
                     while ($row2 = mysqli_fetch_assoc($result2)) {

                        $proid = $row2['Product_Master_idProduct_Master'];
                        $qty = $row2['Product_qty'];
                        $taxable = $row2['Product_Price'];
                        $total1 = $qty * $taxable;

                        $summ = ($total1 * 12) / 100;
                        $total2 = $total1 + $summ;
                        $subtotal = $subtotal + $total2;

                        echo '
                     <tbody>
                        <tr>
                           <td>
                              <span class="text-inverse">' . $row2['Product_Name'] . '</span><br>
                              <small>' . $row2['Product_Details'] . '</small>
                           </td>
                           <td class="text-center">' . $row2['Product_qty'] . '</td>
                           <td class="text-center">*</td>
                           <td class="text-center">₹ ' . $row2['Product_Price'] . '</td>
                           <td class="text-center">₹' . $summ . '</td>
                           <td class="text-right">₹ ' . $total2 . '</td>
                        </tr>';
                     } ?>


                     </tbody>
                  </table>
               </div>

               <!-- end table-responsive -->
               <!-- begin invoice-price -->
               <div class="invoice-price">

                  <div class="invoice-price-right">
                     <small>TOTAL</small> <span class="f-w-600">₹ <?php echo $subtotal ?>.00</span>
                  </div>
               </div>
               <!-- end invoice-price -->
            </div>
            <!-- end invoice-content -->

            <!-- begin invoice-footer -->
            <div class="invoice-footer">
               <p class="text-center m-b-5 f-w-600">
                  <b> THANK YOU FOR YOUR BUSINESS HAVE A NICE DAY..!!</b>
               </p>

            </div>
            <!-- end invoice-footer -->
         </div>
      </div>
   </div>

   <style type="text/css">
      body {
         margin-top: 20px;
         background: #eee;
      }

      .invoice {
         background: #fff;
         padding: 20px
      }

      .invoice-company {
         font-size: 20px
      }

      .invoice-header {
         margin: 0 -20px;
         background: #f0f3f4;
         padding: 20px
      }

      .invoice-date,
      .invoice-from,
      .invoice-to {
         display: table-cell;
         width: 1%
      }

      .invoice-from,
      .invoice-to {
         padding-right: 20px
      }

      .invoice-date .date,
      .invoice-from strong,
      .invoice-to strong {
         font-size: 16px;
         font-weight: 600
      }

      .invoice-date {
         text-align: right;
         padding-left: 20px
      }

      .invoice-price {
         background: #f0f3f4;
         display: table;
         width: 100%
      }

      .invoice-price .invoice-price-left,
      .invoice-price .invoice-price-right {
         display: table-cell;
         padding: 20px;
         font-size: 20px;
         font-weight: 600;
         width: 75%;
         position: relative;
         vertical-align: middle
      }

      .invoice-price .invoice-price-left .sub-price {
         display: table-cell;
         vertical-align: middle;
         padding: 0 20px
      }

      .invoice-price small {
         font-size: 12px;
         font-weight: 400;
         display: block
      }

      .invoice-price .invoice-price-row {
         display: table;
         float: left
      }

      .invoice-price .invoice-price-right {
         width: 25%;
         background: #2d353c;
         color: #fff;
         font-size: 28px;
         text-align: right;
         vertical-align: bottom;
         font-weight: 300
      }

      .invoice-price .invoice-price-right small {
         display: block;
         opacity: .6;
         position: absolute;
         top: 10px;
         left: 10px;
         font-size: 12px
      }

      .invoice-footer {
         border-top: 1px solid #ddd;
         padding-top: 10px;
         font-size: 10px
      }

      .invoice-note {
         color: #999;
         margin-top: 80px;
         font-size: 85%
      }

      .invoice>div:not(.invoice-footer) {
         margin-bottom: 20px
      }

      .btn.btn-white,
      .btn.btn-white.disabled,
      .btn.btn-white.disabled:focus,
      .btn.btn-white.disabled:hover,
      .btn.btn-white[disabled],
      .btn.btn-white[disabled]:focus,
      .btn.btn-white[disabled]:hover {
         color: #2d353c;
         background: #fff;
         border-color: #d9dfe3;
      }
   </style>

   <script type="text/javascript">

   </script>
</body>

</html>