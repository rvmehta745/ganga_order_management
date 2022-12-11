  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
      <!-- Navbar Start -->
      <?php include "backend/header.php"; ?>

      <!-- Navbar End -->
      <!-- Navbar End -->


      </head>


      </script>
      <!-- add product -->
      <!-- Content Header (Page header) -->
      <div id="" class="">
          <table id="employee_data" class="table table-striped">
              <thead>
                  <tr>
                      <th class='p-2 mb-2 bg-dark text-white'>No.</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Name</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Details</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Price</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Category</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Size</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Qty</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Color</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Image</th>
                      <th class='p-2 mb-2 bg-dark text-white'>Update</th>
                  </tr>
              </thead>



              <?php
                //  if(isset($_GET['idProduct_Master'])) {
                //  $id = $_GET['idProduct_Master'];
                $sql = "SELECT * FROM product_master ORDER by idProduct_Master DESC ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);


                if ($row > 0) {
                    $str = "";
                    $cnt = 1;
                    while ($productRow = mysqli_fetch_assoc($result)) {
                        $sql0 = "SELECT * FROM product_master NATURAL JOIN product_category WHERE product_master.Product_Category_idProduct_Category=product_category.idProduct_Category AND product_master.idProduct_Master='" . $productRow['idProduct_Master'] . "'";
                        $res0 = mysqli_query($conn, $sql0);
                        $productRow0 = mysqli_fetch_assoc($res0);
                        $str .= "<tbody><tr class='p-2 mb-2 border-2'><td>"

                            . $productRow['idProduct_Master'] . "</td><td>"
                            . $productRow["Product_Name"] . "</td><td>"
                            . $productRow["Product_Details"] . "</td><td>"
                            . $productRow["Product_Price"] . "</td><td>"
                            . $productRow0["Category_Name"] . "</td><td>"
                            . $productRow["Product_Size"] . "</td><td>"
                            . $productRow["Product_Qty"] . "</td><td>"
                            . $productRow["Product_colors"] . "</td><td>
   
	<img src='" . $productRow["image_url"] . "' height='100' width='100'>" . "</td><td>
    <a href='purchaseUpdate.php?idProduct="
                            . $productRow["idProduct_Master"] . "' class='btn btn-outline-primary w-10 m-2 border-2'><i class='ace-icon fa fa-edit bigger-120'></i></a>" . "</td><td>" . " </td>

      </tr>
    ";
                        $cnt++;
                    }
                    $str .= "</tbody></table>";
                    echo $str;
                } else {
                    echo '<br><label class="form-control border-2" >No records found.!!</label>';
                }
                //  }


                ?>
          </table>

      </div>




      <!-- Content End -->
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


  <!--   
  <a href='addPurchase.php?idProduct="
    .$productRow["idProduct_Master"]."&qty="
    .$productRow["Product_Qty"]."' class='btn btn-outline-primary w-2 m-2 border-3'><i class='ace-icon fa fa-edit bigger-120'></i></a> -->

  </html>