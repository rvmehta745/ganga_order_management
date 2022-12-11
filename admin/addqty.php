<?php
include 'backend/db_connect.php';
$sql="SELECT * FROM product_master";
$result=mysqli_query($conn,$sql);
$rows=mysqli_fetch_assoc($result);
  $id=$rows['idProduct_Master'];

$productSelectQuery="select idProduct_Master,sum(Product_Qty) total
 from ( 
     select idProduct_Master,Product_Qty 
     from product_master 
     union all 
     select Pro_id,Product_Qty from purchase_order_detail 
     ) t 
group by idProduct_Master ";
$res=mysqli_query($conn,$productSelectQuery);
$row=mysqli_fetch_assoc($res);
 $qty=$row['total'];
if( $res){
   
    echo $row['total'];
     echo $row['idProduct_Master'];
   $sql="UPDATE `product_master`  
  SET `Product_Qty`='$qty' 
  WHERE `idProduct_Master`='$id'";
   $result=mysqli_query($conn,$sql);
    if($result){
         echo "success";
    }
    
}
else{
     echo "fail";
    //   header("Location:purchaseOrder.php");
}

?>
