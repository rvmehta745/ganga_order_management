<?php include "backend/db_connect.php";?>

<script>
    if(confirm("Are you sure You Want to delete this product?")){
        console.log("if...");
<?php 

$id=$_GET['id'];
echo $id;
$DELETESQL="DELETE FROM `product_master` WHERE idProduct_Master=$id";

$res=mysqli_query($conn,$DELETESQL);
    if($res){
     
         header("location:productView.php");
    }
    else{
        echo "not deleted";
    }
?>
}
</script>

