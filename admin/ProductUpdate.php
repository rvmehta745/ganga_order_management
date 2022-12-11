  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->

  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Start -->
    <?php include "backend/header.php"; ?>
    <!-- Navbar End -->


    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product_master` WHERE idProduct_Master =$id";
    $res = mysqli_query($conn, $sql);
    $n = mysqli_num_rows($res);
    if ($n == 1) {
      $productSelectRow = mysqli_fetch_assoc($res);
    ?>
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <h3 class="mb-4"><u>Update Product Details</u></h3>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" enctype="multipart/form-data" method="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Product Name :</label>


                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inpt" name="pname" value="<?php echo $productSelectRow['Product_Name']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Product Details :</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inpt" name="details"><?php echo $productSelectRow['Product_Details']; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Price :</label>


                    <div class="col-sm-10">
                      <input type="tel" class="form-control" id="inpt" name="price" value="<?php echo $productSelectRow['Product_Price']; ?>">
                    </div>
                  </div>


              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Quantity :</label>


                <div class="col-sm-10">
                  <input type="number" class="form-control" id="inpt" name="qty" value="<?php echo $productSelectRow['Product_Qty']; ?>">
                </div>

              </div>







              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Image :</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="img" name="image" value="<?php echo '' . $productSelectRow['image_url'] . ''; ?>" required>
                  <br>
                  <img src="<?php echo '' . $productSelectRow['image_url'] . ''; ?>" alt="image" width="100px" height="100px">
                </div>

              </div>

            </div>



            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button href="productView.php" type="submit" class="btn btn-outline-primary w-20 m-2 border-3" name="updateproduct"><b>Update Product</b></button>
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

      if (isset($_POST['updateproduct'])) {


        $target_dir = "uploads/";
        // $target_dir="../uploads/";  
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        //  $target_file = $target_dir . $_POST['i'];
        //echo $target_file;
        //echo "<br>".$_GET['id'];

        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // echo "<br><br>".$target_file;
        echo "updating...";

        // $img=$_POST['image'];

        //  $id=$_COOKIE["idRegister"];
        //  $subcatid=$_GET["subcategaryid"];
        //  $subcatid=$productSelectRow['subcategory_idsubcategory'];
        if ($target_file == "uploads/") {
          $target_file = $_POST['image'];
        } else {

          if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
          ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }
          if ($uploadOk == 0) {
            echo "file uploading failed...";
          } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
              echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
              echo "Sorry, there was an error uploading your file.";
            }
          }
        }

        //  
        $id = $_GET['id'];
        $pname = $_POST['pname'];
        $details = $_POST['details'];
        $price = $_POST['price'];

        $qty = $_POST['qty'];

        $sql = "UPDATE `product_master`  
  SET `Product_Name`='$pname' ,`Product_Details`='$details' ,`Product_Price`='$price' ,`Product_Qty`='$qty',`image_url`='$target_file' 
  WHERE `idProduct_Master`='$id'";

        // echo "<br>". $sql;
        $result = mysqli_query($conn, $sql);

        //   echo "---------------------------------".$result;
        if ($result > 0) {
          echo '<div class="alert alert-success">
   <strong>Success!</strong> product successfully added!
 </div>';

          echo '<script> 
    window.location.href="productView.php"
 </script>';
          //  header("location:home.php");
          // exit();
        } else {
          echo '<div class="alert alert-danger">
   <strong>Success!</strong> Something went wrong while adding product...!!
 </div>
 ';
        }
      }
    }


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