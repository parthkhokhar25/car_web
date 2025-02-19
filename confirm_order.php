<?php
include_once "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('PHPMailer\PHPMailer.php');
require('PHPMailer\SMTP.php');
require('PHPMailer\Exception.php');
?>
<?php
if (isset($_POST['cnf_btn'])) {
    $id = $_POST['id'];
    $q = "select * from orders where p_id = '$id'";
    $result = mysqli_query($con, $q);
    $row = mysqli_fetch_array($result);
    // $link='http://localhost/CAR%20WEBSITE/cars.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'parthkhokhar61@gmail.com';                     //SMTP username
        $mail->Password   = 'cbmr prbi umyn exss';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('parthkhokhar61@gmail.com', 'CARTECH');
        $mail->addAddress($row['email'], 'Parth Khokhar');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('parthkhokhar61@gmail.com', 'Reply');
        //$mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Confirmed';
        $mail->Body    = 'Your Order is confirmed by CARTECH, Visit Your Naibry Old Car Seller Store For Test Drive.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo '<script>alert("Massage sent successfully!.");</script>';
            $q1 = "update orders set status='completed' where p_id='$id'";
            if (mysqli_query($con, $q1)) {
                echo '<script type="text/javascript">alert("Order confirmed Successfull!")</script>';
                $q2 = "update products set status='sold' where p_id='$id'";
                if (mysqli_query($con, $q2)) {
                    echo '<script type="text/javascript">alert("Updated!")</script>';
                }
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            } else {
                echo '<script type="text/javascript">alert("Error!")</script>';
                echo '<script type="text/javascript">window.location="notification.php"</script>';
            }
        }
    } catch (Exception $e) {
        //	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo '<script>alert("Failed to send massage please try again after sometime.");</script>';
    }
}
?>



<?php
if (isset($_POST['dec_btn'])) {
    $id = $_POST['id'];
    $q = "select * from orders where p_id = '$id'";
    $result = mysqli_query($con, $q);
    $row = mysqli_fetch_array($result);
    // $link='http://localhost/CAR%20WEBSITE/cars.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'parthkhokhar61@gmail.com';                     //SMTP username
        $mail->Password   = 'cbmr prbi umyn exss';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('parthkhokhar61@gmail.com', 'CARTECH');
        $mail->addAddress($row['email'], 'Parth Khokhar');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('parthkhokhar61@gmail.com', 'Reply');
        //$mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Order Decline';
        $mail->Body    = 'Your Order is Decline by CARTECH.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo '<script type="text/javascript">alert("Product Declined Successfull!")</script>';
            $q2 = "update orders set status='cancelled' where p_id='$id'";
            if (mysqli_query($con, $q2)) {
                echo '<script type="text/javascript">alert("Updated!")</script>';
            }
        }
    } catch (Exception $e) {
        //	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo '<script>alert("Failed to send massage please try again after sometime.");</script>';
    }
}
?>