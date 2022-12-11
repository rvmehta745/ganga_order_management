<!DOCTYPE html>
<html>
<?php include "backend/sidebar.php"; ?>

<head>
     <link href="css/astyle.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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

        <?php
        include 'backend/db_connect.php';
        // $id=$_GET['idProduct_Master'];
        $sql = "SELECT * FROM `retailer`";
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
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Company Name</td>
                                <td>Bank Name</td>
                                <td>Address</td>
                                <td>Email</td>
                                <td>Password</td>
                                <td>GST No.</td>
                                <td>Phone No.</td>
                                <td>Bank IFSC</td>
                                <td>Bank A/C No.</td>

                            </tr>
                        </thead>
                        <?php
                        $cnt = 1;
                        while ($row = mysqli_fetch_array($result)) {

                            echo '  
                              <tr>
                               <td>' . $row["idRetailer"] . '</td>  
                                   
                                    <td>' . $row["first_name"] . '</td>  
                                    <td>' . $row["last_name"] . '</td>  
                                    <td>' . $row["Company_Name"] . '</td> 
                                    <td>' . $row["Bank_Name"] . '</td>
                                    <td>' . $row["Address"] . '</td>
                                    <td>' . $row["E-mail"] . '</td>
                                    <td>' . $row["Password"] . '</td>
                                    <td>' . $row["GST"] . '</td>
                                    <td>' . $row["Phone"] . '</td>
                                    <td>' . $row["Bank_IFSC"] . '</td>
                                    <td>' . $row["Bank_acc"] . '</td>
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