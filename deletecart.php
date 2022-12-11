<!-- product remove from cart -->
<?php
 include "backend/db_connect.php";
if(isset($_GET['idRetailer'])){
    $pid = $_GET['idProduct'];
    $id = $_COOKIE['idRetailer'];
    $sql2 = "DELETE FROM cart WHERE cart.Retailer_idRetailer=$id and cart.Product_Master_idProduct_Master=$pid";
    $result1 = mysqli_query($conn, $sql2);

    // echo $pid;
    if($result1){
        // echo '<script>alert("Product removed from cart")</script>';
        echo '<script>window.location="index.php?idRetailer='.$_COOKIE['idRetailer'].''.'&idProduct='. $_GET['idProduct'].'"</script>';
    }else{
        // echo 'fail';
    }
    

}
?>
<!-- end product from cart -->
