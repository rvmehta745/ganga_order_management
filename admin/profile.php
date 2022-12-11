<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //  echo "--------------------------------hii";
  include 'backend/db_connect.php';
  if (isset($_POST['update'])) {
    //  echo "updating...";

    $cname = $_POST['cname'];
    $address = $_POST['address'];
    $gst = $_POST['gst'];
    $phone = $_POST['phone'];
    // $email = $_POST['email'];
    $password = $_POST['password'];
    $id = $_COOKIE["id"];

    $sql = "UPDATE `admin` SET `company_name`='$cname',`company_address`='$address',`gst`='$gst',`phone`='$phone',`password`='$password'  where `id`= $id";
    $result = mysqli_query($conn, $sql);

    if ($result > 0) {

      echo '<script> 
            window.location.href="index.php"
          </script>';

      // header("location:home.php");
    } else {
      echo '<div class="alert alert-danger">
            <strong>Success!</strong> Something went wrong while updating...!!
          </div>';
    }
  }
}
?>
<?php
include 'backend/db_connect.php';
if ($_COOKIE['id'] == "") {
  header("location:signin.php");
} else {
  $sql = "Select * from `admin` where `id` = '" . $_COOKIE['id'] . "'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
}
if ($num == 1) {
  // echo "hii";
  $row = mysqli_fetch_assoc($result);


?>

  <!DOCTYPE html>
  <html lang="en">

  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
    <!-- Navbar Start -->
    <?php include "backend/header.php"; ?>
    <!-- Navbar End -->


    <!-- Form Start -->





    <script>
      function enabledisable() {
        document.getElementById("inpt").disabled = true;
      }
    </script>

    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <h6 class="mb-4">Update Your Profile Details</h6>
        <div class="tab-content">
          <div class="active tab-pane" id="activity">

            <div class="tab-pane" id="settings">
              <form class="form-horizontal" method="post">
                <div class="form-group">


                  <?php
                  function endsbl()
                  {
                  }
                  ?>
                  <div class="form-group">
                    <label for="inputCompanyName" class="col-sm-2 control-label">Company Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputText" value="<?php echo $row['company_name'];  ?>" name="cname">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputText" value="<?php echo $row['company_address'];  ?> " name="address" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCompanyName" class="col-sm-2 control-label">GST No.</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputText" value="<?php echo $row['gst'];  ?>" name="gst">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCompanyName" class="col-sm-2 control-label">Phone No.</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputText" value=<?php echo $row['phone'];  ?> name="phone">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">E-mail :</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" value="<?php echo $row['email'];  ?>" name="email" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputpass" class="col-sm-2 control-label">Password</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPass" value=<?php echo $row['password'];  ?> name="password">
                    </div>
                  </div>

                  <input type="checkbox" onclick="myFunction()">
                  <label for="CustomerPassword">Show Password</label>



                  <script>
                    function myFunction() {
                      var x = document.getElementById("inputPass");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                  </script>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-outline-primary w-20 m-2 border-3" name="update">Update</button>
                    </div>
                  </div>
              </form>
              <!-- Form End -->
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>

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
<?php
}
?>