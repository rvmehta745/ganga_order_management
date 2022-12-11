  <?php include "backend/sidebar.php"; ?>
  <!-- Sidebar End -->


  <!-- Content Start -->
  <div class="content">
      <!-- Navbar Start -->
      <?php include "backend/header.php"; ?>
      <!-- Navbar End -->


      <!-- Table Start -->



      <h3 class="mb-4"><u>Retailer Details</u></h3>
      <table class="table table-hover">
          <thead>
              <tr>
                  <th class="p-2 mb-2 bg-dark text-white " scope="col">ID</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">First Name</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Last Name</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Company Name</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Bank Name</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Address</th>

                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Email</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Password</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">GST No.</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Mobile No.</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Bank IFSC</th>
                  <th class="p-2 mb-2 bg-dark text-white" scope="col">Bank Account No.</th>


              </tr>
          </thead>
          <tbody>
              <?php
                $sql = "SELECT * FROM `retailer`";
                $result = mysqli_query($conn, $sql);

                while ($rows = mysqli_fetch_assoc($result)) {
                    echo " <tr class='p-2 mb-2 border-5'>
                        <td >" . $rows['idRetailer'] . "</td>
                        <td>" . $rows['first_name'] . "</td>
                        <td>" . $rows['last_name'] . "</td>
                        <td>" . $rows['Company_Name'] . "</td>
                        <td>" . $rows['Bank_Name'] . "</td>
                        <td>" . $rows['Address'] . "</td>
                        <td>" . $rows['E-mail'] . "</td>
                        <td>" . $rows['Password'] . "</td>
                        <td>" . $rows['GST'] . "</td>
                        <td>" . $rows['Phone'] . " </td>
                         <td>" . $rows['Bank_IFSC'] . " </td>
                          <td>" . $rows['Bank_acc'] . " </td>
                        <td>"; ?>
              <?php echo "</td>
                    </tr>";
                }
                ?>
          </tbody>
      </table>
  </div>




  </div>
  </div>
  <!-- Table End -->



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