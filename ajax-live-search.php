<?php

require 'backend/db_connect.php';

if (isset($_POST['query'])) {
    $queryy = $_POST['query'];
    $query = "SELECT * FROM `product_master` WHERE  `Product_colors` LIKE '%$queryy%' OR `Product_Name` LIKE '%$queryy%' LIMIT 10";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
            echo '  
                              <tr>
                       
                          <th><img src="admin/' . $res["image_url"] . '" height="100" width="100">' . '</td>
                                   </a> </th>
                                     <th><a href="productlayout.php?idRetailer=' . $_COOKIE["idRetailer"] . '' . '&idProduct=' . $res["idProduct_Master"] . '"><h2>' . $res["Product_Name"] . '</h2></a></th>  
                                   
                              </tr>  
                               ';
        }
    } else {
        echo "
      <div class='alert alert-danger mt-3 text-center' role='alert'>
          product not found
      </div>
      ";
    }
}
