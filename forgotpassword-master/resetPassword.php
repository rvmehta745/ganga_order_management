<?php
include("config.php");

if (!isset($_GET["code"])) {
    exit("Can't find page");
}
$code = $_GET["code"];
$getEmailQuery = mysqli_query($conn, "SELECT email FROM resetpassword WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery) == 0) {
    exit("can't find page");
}
if (isset($_POST["password"])) {
    $pw = $_POST["password"];
    //$pw = md5($pw);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];
    $query = mysqli_query($conn, "UPDATE retailer SET Password='$pw' WHERE E-mail='$email'");
    if ($query) {
        $query = mysqli_query($conn, "DELETE FROM resetpassword where code='$code'");
        exit("password updated");
    } else {
        exit("something went wrong");
    }
}
?>
<form method="POST">
    <input type="password" name="password" placeholder="New Password">
    <br>
    <input type="submit" name="submit" value="Update password">
</form>