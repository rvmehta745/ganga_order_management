

<!-- product remove from wishlist -->
<?php
 include "backend/db_connect.php";
if(isset($_GET['idRetailer'])){
    $pid = $_GET['idProduct'];
    $id = $_COOKIE['idRetailer'];
    $sql1 = "DELETE FROM wishlist WHERE wishlist.Retailer_idRetailer=$id and wishlist.Product_Master_idProduct_Master=$pid";
    $result = mysqli_query($conn, $sql1);

    // echo $pid;
    if($result){
        // echo '<script>alert("Product removed from wishlist")</script>';
        echo '<script>window.location="wishlist.php?idRetailer='.$_COOKIE['idRetailer'].''.'&idProduct='. $_GET['idProduct'].'"</script>';
    }else{
        // echo 'fail';
    }
 exit();

}
?>

<!-- end product remove from wishlist -->



 