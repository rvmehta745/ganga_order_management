<?php
include 'backend/db_connect.php';

if ($_COOKIE['idRetailer'] == "") {
    header("location:login.php");
} else {
    $sql = "Select * from `retailer` where `idRetailer` = '" . $_COOKIE['idRetailer'] . "'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
}
if ($num > 0) {
    //  echo "hii";
    //  echo $_COOKIE['idRetailer'];
    $ra = mysqli_fetch_assoc($result);

?>


    <!DOCTYPE html>

    <html class="no-js" lang="en">




    <!--Top Header-->

    <?php
    include "backend/header.php";
    ?>
    <!--End Header-->
    <br><br><br><br><br><br>
    <!--Body Content-->
    <div id="page-content">
        <!--Page Title-->
        <div class="page section-header text-center">
            <div class="page-title">
                <div class="wrapper">
                    <h1 class="page-width">Your Profile</h1>
                </div>
            </div>
        </div>
        <!--End Page Title-->



        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 main-col offset-md-3">
                    <div class="mb-4">


                        <form method="post" action="#" id="CustomerLoginForm" accept-charset="UTF-8" class="contact-form">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" name="first_name" placeholder="" id="inpt" autofocus="" value="<?php echo $ra['first_name'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Last Name</label>
                                        <input type="text" name="last_name" placeholder="" id="inpt" value="<?php echo $ra['last_name'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Company Name</label>
                                        <input type="text" name="company_name" placeholder="" id="inpt" value="<?php echo $ra['Company_Name'];  ?>">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Bank Name</label>
                                        <input type="text" name="bank_name" placeholder="" id="inpt" value="<?php echo $ra['Bank_Name'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Address</label>
                                        <input type="text" name="address" placeholder="" id="inpt" value="<?php echo $ra['Address'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerEmail">Email</label>
                                        <input type="email" name="email" placeholder="" id="inpt" class="" autocorrect="off" autocapitalize="off" autofocus="" value="<?php echo $ra['E-mail'];  ?> " required>
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="CustomerPassword">Password</label>
                                        <input type="password" value="" placeholder="" id="CustomerPassword" value="<?php echo $ra['Password'];  ?>" name="password" required>

                                        <input type="checkbox" onclick="myFunction()">
                                        <label for="CustomerPassword">Show Password</label>



                                        <script>
                                            function myFunction() {
                                                var x = document.getElementById("CustomerPassword");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                } else {
                                                    x.type = "password";
                                                }
                                            }
                                        </script>
                                    </div>
                                </div> -->

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">GST No.</label>
                                        <input type="text" name="gst_no" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" placeholder="" id="inpt" value="<?php echo $ra['GST'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Phone No.</label>

                                        <input type="tel" name="phone_no" pattern="[0-9]{10}" placeholder="" id="LastName" value=<?php echo $ra['Phone'];  ?> required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Bank IFSC</label>
                                        <input type="text" name="bank_ifsc" pattern="^[A-Z]{4}[0-9]{7}$" placeholder="" id="inpt" value=<?php echo $ra['Bank_IFSC'];  ?> required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="LastName">Bank Account Number</label>
                                        <input type="text" name="bank_acc" pattern="^[0-9]{8}[0-9]{4}$" placeholder="" id="inpt" value=<?php echo $ra['Bank_acc'];  ?> required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="text-center col-12 col-sm-12 col-md-12 col-lg-12">
                                    <button href="index.php" type="submit" class="btn btn-success" name="update">Update Profile</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--End Body Content-->

    <!--Footer-->
    <?php
    include "backend/footer.php";
    ?>
    <!--End Footer-->



    <?php

    if (isset($_POST['update'])) {

        //  $target_file = $target_dir . $_POST['i'];
        //echo $target_file;
        //echo "<br>".$_GET['id'];


        //    echo "updating...";

        // $id=$_GET['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $company_name = $_POST['company_name'];
        $bank_name = $_POST['bank_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $gst_no = $_POST['gst_no'];
        $phone_no = $_POST['phone_no'];
        $bank_ifsc = $_POST['bank_ifsc'];
        $bank_acc = $_POST['bank_acc'];
        $id = $_COOKIE["idRetailer"];

        $sql = "UPDATE `retailer` SET `first_name`='$first_name',`last_name`='$last_name',
    `Company_Name`='$company_name',`Bank_Name`='$bank_name',`Address`='$address',
    `E-mail`='$email',`GST`='$gst_no',`Phone`='$phone_no',
    `Bank_IFSC`='$bank_ifsc',`Bank_acc`='$bank_acc' 
    WHERE idRetailer='$id'";


        // echo "<br>". $sql;
        $result = mysqli_query($conn, $sql);

        //   echo "---------------------------------".$result;
        if ($result > 0) {
            echo '<div class="alert alert-success">
   <strong>Success!</strong> product successfully added!
 </div>';

            echo '<script> 
    window.location.href="index.php"
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


    ?>


    </body>



    </html>
<?php
}
?>