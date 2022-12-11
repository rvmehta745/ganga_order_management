  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->

  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Start -->
    <?php include "backend/header.php"; ?>
    <!-- Navbar End -->
    <?php
    if (isset($_POST['addproduct'])) {
      $target_dir = "uploads/";
      //$target_dir="../uploads/";        
      $target_file = $target_dir . basename($_FILES["image"]['name']);

      //echo  "<br>" .$_FILES['image']['name'];
      //echo "<br>--------------".$target_file;
      // $target_file = $target_dir . $_POST['i'];
      //  echo var_dump($target_file);
      //echo "<br>".$_POST['i'];
      // echo "<br><br><br>".$target_file."<br>";
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


      $pname = $_POST['pname'];
      $details = $_POST['details'];
      $price = $_POST['price'];
      // $size = $_POST['size'];
      $qty = $_POST['qty'];
      // $color = $_POST['color'];
      //  $img=$_POST['image'];
      //   	$productimage1=$_FILES["image"]["name"];
      $cat = $_POST["cat"];
      $id = $_COOKIE["id"];

      echo "<br> pname : " . $pname;
      echo "<br> details : " . $details;
      echo "<br> price : " . $price;
      // echo "<br> size : " . $size;
      echo "<br> qty : " . $qty;
      // echo "<br> color : " . $color;
      // echo "<br> img : " .$img;
      echo "<br> cat : " . $cat;
      echo "<br> id : " . $id;

      echo "<br>" . $_FILES['image']['name'];
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
      }





      move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);


      $sql = "INSERT INTO `product_master`(`Product_Name`,`Product_Details`,`Product_Price`,`Product_Qty`,`image_url`,	`Product_Category_idProduct_Category`) 
         VALUES ('$pname','$details','$price','$qty','$target_file','$cat')";
      $result = mysqli_query($conn, $sql);

      if ($result) {

        echo "inserted";
        echo '<script> 
            window.location.href="productView.php"
         </script>';
      } else {

        echo "not inserted";
      }
    }

    ?>

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <h3 class="mb-4"><u>Add Product</u></h3>
        </ul>
        <!-- add category start -->
        <h6 class="admin-heading">Add New Category</h6>
        <form id="createCategory" class="" method="POST">
          <div class="form-group">
            <input type="text" name="cat" placeholder="Enter Category Name" required />
            <button type="submit" name="addsave" cvalue="Submit"><b>Submit</b></button>
          </div>

        </form>

        <?php

        if (isset($_POST['addsave'])) {
          $add_cat = $_POST['cat'];

          $sql = "INSERT INTO `product_category`(`Category_Name`) VALUES ('$add_cat')";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            echo "<script>
       window.location.href='addproduct.php' </script>";
          } else {
            echo '<div class="alert alert-warning"><b>This category is already exists ..!!</b>
		  			 </div>';
          }
        }

        ?>
        <!-- add category end -->
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <div class="tab-pane" id="settings">
              <form class="form-horizontal" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label"><b>Product name :</b></label>


                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inpt" name="pname" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label"><b>Product Details :</b></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inpt" name="details" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label"><b>Price :</b></label>


                  <div class="col-sm-10">
                    <input type="tel" class="form-control" id="inpt" name="price">
                  </div>
                </div>

                

                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label"><b>Quantity :</b></label>


                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inpt" name="qty" value="0">
                  </div>

                </div>


            


                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label"><b>Image :</b></label>


                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image">

                  </div>

                </div>


            </div>

            <div class="content-wrapper">

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label"><b>Select Category :</b></label>


                <div class="col-sm-10">


                  <?php

                  $selectcategory = "SELECT * FROM product_category";

                  if ($res = mysqli_query($conn, $selectcategory)) {
                    if (mysqli_num_rows($res) > 0) {
                      while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['idProduct_Category'];
                        $name = $row['Category_Name'];
                        echo "<input type='radio' name='cat' value='$id'> $name ";
                      }
                    }
                  }

                  ?>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-outline-primary w-20 m-2 border-3" name="addproduct"><b>Add Product</b></button>
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