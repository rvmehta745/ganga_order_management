<?php
include 'backend/db_connect.php';
// $id=$_GET['idProduct_Master'];
$sql = "SELECT * FROM product_master ORDER by idProduct_Master DESC ";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
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
     <br /><br />
     <div class="content">
          <div class="p-2 mb-2 border-5'">
               <div class="ms-3">
                    <!-- <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>   -->
                    <br />

                    <div id="" class="">
                         <table id="employee_data" class="table table-striped">
                              <thead>
                                   <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Details</td>
                                        <td>Price</td>
                                        <td>Size</td>
                                        <td>Qty</td>
                                        <td>color</td>
                                        <td>Image</td>
                                        <td>Update</td>
                                        <td>Purchase</td>

                                   </tr>
                              </thead>
                              <?php
                              $cnt = 1;
                              while ($row = mysqli_fetch_array($result)) {
                                   echo '  
                              <tr>
                               <td>' . $row["idProduct_Master"] . '</td>  
                                   
                                    <td>' . $row["Product_Name"] . '</td>  
                                    <td>' . $row["Product_Details"] . '</td>  
                                    <td>' . $row["Product_Price"] . '</td> 
                                    <td>' . $row["Product_Size"] . '</td>
                                    <td>' . $row["Product_Qty"] . '</td>
                                    <td>' . $row["Product_colors"] . '</td>
                                    <td><img src="' . $row["image_url"] . '" height="100" width="100">' . '</td>
                                        <td></td>
                                        <td></td>
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
</body>

</html>