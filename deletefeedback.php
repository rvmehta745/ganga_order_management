<!-- delete review start -->
<?php
include "backend/db_connect.php";
if (isset($_GET['idProduct'])) {
    $pid = $_GET['idProduct'];

    $sql3 = "DELETE FROM feedback WHERE  feedback.Product_Master_idProduct_Master= $pid and feedback.Retailer_idRetailer=" . $_COOKIE['idRetailer'] . " and feedback.idFeedback=" . $_GET['idFeedback'] . "";
    $result2 = mysqli_query($conn, $sql3);

    // echo $pid;
    if ($result2) {
        // echo '<script>alert("Product removed from cart")</script>';
        echo '<script>window.location="productlayout.php?idRetailer=' . $_COOKIE['idRetailer'] . '' . '&idProduct=' . $_GET['idProduct'] . '"</script>';
    } else {
        echo 'fail';
    }
}
?>
<!-- delete review end -->