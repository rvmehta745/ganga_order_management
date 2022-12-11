<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';
if(isset($_POST["email"]))
{
    $emailTo = $_POST["email"];
    $code = uniqid(true);
    $query = mysqli_query($conn,"INSERT INTO resertpassword(code,email) VALUES('$code','$emailTo')");
    if (!$query) {
        exit("error");
    }
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'tirthsheth108@gmail.com';                     //SMTP username
    $mail->Password   = 'Sheth@7226';
    // $mail->Username   = 'info.growmoreb2b@gmail.com';                     //SMTP username
    // $mail->Password   = 'Growmore112';                               //SMTP password
    $mail->SMTPSecure = 'tls';/*PHPMailer::ENCRYPTION_SMTPS;*/            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('tirthsheth108@gmail.com', 'Growmore');
    // $mail->setFrom('info.growmoreb2b@gamil.com', 'Growmore');
    $mail->addAddress($emailTo/*, 'Joe User'*/);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/resetPassword.php?code=$code";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Resert password';    //Here is the subject
    $mail->Body    = "<h1>You requested a password reset</h1>
                        click <a href='$url'>this link</a> to do so";
    $mail->AltBody = "This is the computer genreted email so don't reply.";

    $mail->send();
    echo 'Reset passwork link has been sent to your email';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error:",$mail->ErrorInfo;
}
exit();
}
?>
<form method="post">
    <input type="text" name="email" placeholder="email" autocomplete="off">
    <br>
    <input type="submit" name="submit" value="Reset Password">
</form>