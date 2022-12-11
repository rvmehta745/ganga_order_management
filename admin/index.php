<!DOCTYPE html>
<html lang="en">
<?php include "backend/db_connect.php"; ?>

<body>



    <!-- Sidebar Start -->
    <?php include "backend/sidebar.php"; ?>
    <!-- Sidebar End -->


    <!-- Content Start -->

    <!-- Navbar End -->
    <div class="content">
        <!-- Navbar Start -->
        <?php include "backend/header.php"; ?>

        <!-- Sale & Revenue Start -->
        <div class="row g-4  me-lg-3">
            <div class="col-sm-6 col-xl-3"><a href="retailer.php">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x text-primary"></i>

                        <div class="ms-3">
                            <p class="mb-2"><b>Retailer :</b></p>
                            <h6 class="mb-0"><?php
                                                $sql = "SELECT * FROM `retailer`";
                                                $result = mysqli_query($conn, $sql);
                                                $num = mysqli_num_rows($result);
                                                echo $num;
                                                ?></h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-xl-3"><a href="productView.php">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2"><b>Product :</b></p>
                            <h6 class="mb-0"><?php
                                                $sql = "SELECT * FROM `product_master`";
                                                $result = mysqli_query($conn, $sql);
                                                $num = mysqli_num_rows($result);
                                                echo $num;
                                                ?></h6>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-xl-3"><a href="salesOrders.php">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2"><b>All Order :</b></p>
                            <h6 class="mb-0"><?php
                                                $sql = "SELECT * FROM `sales_order`";
                                                $result = mysqli_query($conn, $sql);
                                                $num = mysqli_num_rows($result);
                                                echo $num;
                                                ?></h6>
                        </div>
                    </div>
                </a>

            </div>
            <div class="col-sm-6 col-xl-3"><a href="purchaseOrder.php">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 ">
                        <i class="fa fa-chart-bar fa-3x text-primary"></i>
                        <div class="ms-3">
                            <p class="mb-2"><b>Category :</b></p>
                            <h6 class="mb-0"><?php
                                                $sql = "SELECT * FROM `product_category`";
                                                $result = mysqli_query($conn, $sql);
                                                $num = mysqli_num_rows($result);
                                                echo $num;
                                                ?> </h6>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <!-- Sale & Revenue End -->
        <?php
        $selectSalesOrder = "SELECT * FROM `retailer` NATURAL JOIN sales_order WHERE retailer.idRetailer=sales_order.Retailer_idRetailer  AND sales_order.is_cancel=0  ORDER BY sales_order.Sales_Order_Date DESC";
        $res = mysqli_query($conn, $selectSalesOrder);
        // echo $id;
        // $find = "SELECT * FROM retailer WHERE idRetailer='" . $_COOKIE['idRetailer'] . "'";
        // $resultfind = mysqli_query($conn, $find);   

        ?>
        <!-- Recent Sales Start -->

        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Recent Salse</h6>
                <!-- <a href="">Show All</a> -->
            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Customer</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Invoice</th>

                            <th scope="col">Amount</th>
                            <th scope="col">Credit Due Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>




                    <?php
                    while ($saleOrderRow = mysqli_fetch_assoc($res)) {
                        $date = date_create($saleOrderRow["Sales_Order_Date"]);
                        date_add($date, date_interval_create_from_date_string("30 days"));
                        echo ' <tbody>
                                <tr>
                                    <td>' . $saleOrderRow["first_name"] . ' ' . $saleOrderRow["last_name"] . '</td> 
                            
                                    <td>' . $saleOrderRow["Sales_Order_Date"] . '</td>
                                   <td> <a href="../invoice.php?orderid=' . $saleOrderRow['idSales_Order'] . '">ODR00 ' . $saleOrderRow['idSales_Order'] . '</a></td>
                                   
                                    <td>₹ ' . $saleOrderRow['Total_Amount'] . '</td>
                                    <td> ' . date_format($date, "Y-m-d") . '</td>
                                    <td><a class="btn btn-sm btn-primary" href="salesOrders.php">Detail</a></td>
                                </tr>
                                
                               
                                
                            </tbody>
                           ';
                    }
                    ?>
                </table>
            </div>
        </div>

        <!-- Recent Sales End -->






        <!-- Content End -->


        <!-- Back to Top -->


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
    </div>
</body>

</html>