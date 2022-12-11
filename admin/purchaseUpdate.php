  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->

  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Start -->
    <?php include "backend/header.php"; ?>
    <!-- Navbar End -->


    <?php
    $id = $_GET['idProduct'];
    $sql = "SELECT * FROM purchase_order_details WHERE Product_Master_idProduct_Master 	='$id'";
    $ress = mysqli_query($conn, $sql);
    // $n=mysqli_num_rows($ress);

    ?>
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <h3 class="mb-4"><u>Update Purchase Product Details</u></h3>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <div class="tab-pane" id="settings">
              <form class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label for="inputName" class="col-sm-3 control-label">
                    <h5>Product ID : <?php echo $_GET["idProduct"]; ?></h5>
                  </label>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Quantity :</label>


                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inpt" name="qty" value="" required>
                    </div>


                  </div>


                </div>

            </div>


            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button href="purchaseOrder.php" type="submit" class="btn btn-outline-primary w-20 m-2 border-3" name="insert"><b>Update Details</b></button>
                <!-- <button href="purchaseOrder.php"  type="submit" class="btn btn-outline-primary w-20 m-2 border-3" name="addqty"><b>Insert</b></button> -->
              </div>
            </div>



            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  $qty = $_GET['qty'];
  $id = $_GET['idProduct'];
  $sql = "INSERT INTO `purchase_order_detail` (`idPurchase_Order`,`pro_id`, `Product_Qty`, `Product_Master_idProduct_Master`) VALUES (NULL,'$id', '$qty', '$id');";
  $res = mysqli_query($conn, $sql);
  if (isset($_POST['insert'])) {

    $id = $_GET['idProduct'];
    // $pid=$_POST['proid'];
    $qty = $_POST['qty'];
    $insert = "INSERT INTO `purchase_details`(`pro_id`,`qty`) VALUES('$id','$qty')";
    $res = mysqli_query($conn, $insert);
    // $insert="INSERT INTO `purchase_details`(`pro_id`,`qty`) VALUES ('$id','$qty')";
    //  $res=mysqli_query($conn,$insert);

    if ($res > 0) {

      echo '<div class="alert alert-success">
   <strong>Success!</strong> product successfully added!
 </div>';
      $sql = "UPDATE `purchase_order_detail`  
  SET `pro_id`='$id',`Product_Qty`='$qty' 
  WHERE `Product_Master_idProduct_Master`='$id'";
      $result = mysqli_query($conn, $sql);
      if ($result > 0) {
        //  --------------------------------------------------------
        $add = "select b.idProduct_Master, sum(t.Product_Qty+ b.Product_Qty) as total 
 from product_master b
 left join purchase_order_detail t
    on b.idProduct_Master = t.pro_id
    where b.idProduct_Master = '$id'";
        $resu = mysqli_query($conn, $add);
        $row = mysqli_fetch_assoc($resu);
        $qty = $row['total'];

        if ($resu) {

          $sql = "UPDATE `product_master`  
          SET `Product_Qty`='$qty' 
          WHERE `idProduct_Master`='$id'";
          $result = mysqli_query($conn, $sql);

          // -----------------------------------------------------
          echo '<div class ="alert alert-danger">
   <strong>success!</strong> updated...!!
 </div>
 ';
          echo '<script> 
    window.location.href="purchaseOrderdetails.php"
 </script>';

          // exit();
        }
      } else {
        echo '<div class ="alert alert-danger">
   <strong>fail!</strong> Something went wrong while updating product...!!
 </div>
 ';
      }
    }
  }
  // }

  ?>





  </div>
  <!-- Content End -->


  <!-- Back to Top -->
  </div>

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