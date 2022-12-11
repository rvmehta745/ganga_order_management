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
        <div class="col-sm-offset-2 col-sm-10">&nbsp;
            <a href="purchaseOrder.php" class="btn btn-outline-primary w-20 m-2 border-3"><b>+ Add Purchase</b></a>
        </div>
        <?php
        include 'backend/db_connect.php';
        // $id=$_GET['idProduct_Master'];
        $sql = "SELECT * FROM product_master JOIN purchase_details on product_master.idProduct_Master=purchase_details.pro_id";
        $result = mysqli_query($conn, $sql);

        ?>
        <div class="p-2 mb-2 border-5 me-lg-5">
            <div class="ms-3">
                <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
                <br />

                <div id="" class="">
                    <table id="employee_data" class="table table-striped">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Pro ID</td>
                                <td>Name</td>
                                <td>Details</td>
                                <td>Price</td>
                                <td>Category</td>
                             
                                <td>Qty</td>
                               
                                <td>Image</td>
                                <td>Purchase Date</td>


                            </tr>
                        </thead>
                        <?php
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $sql0 = "SELECT * FROM product_master NATURAL JOIN product_category WHERE product_master.Product_Category_idProduct_Category=product_category.idProduct_Category AND product_master.idProduct_Master='" . $row['idProduct_Master'] . "'";
                            $res0 = mysqli_query($conn, $sql0);
                            $productRow0 = mysqli_fetch_assoc($res0);
                            echo '  
                              <tr>
                               <td>' . $row["id"] . '</td>  
                                  <td>' . $row["idProduct_Master"] . '</td>  
                                   
                                    <td>' . $row["Product_Name"] . '</td>  
                                    <td>' . $row["Product_Details"] . '</td>  
                                    <td>' . $row["Product_Price"] . '</td> 
                                    <td>' . $productRow0["Category_Name"] . '</td>
                                 
                                    <td>' . $row["qty"] . '</td>
                                   
                                    <td><img src="' . $row["image_url"] . '" height="100" width="100">' . '</td>
                                    <td>' . $row["date"] . '</td>
                                       
                                       
                              </tr>  
                               ';
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