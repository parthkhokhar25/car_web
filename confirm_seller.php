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
    $price = $_POST['price'];
    $id = $_POST['id'];
    $q = "select * from seller where seller_id = '$id'";
    $result = mysqli_query($con, $q);
    $row = mysqli_fetch_array($result);
    $link = 'http://localhost/CAR%20WEBSITE/cars.php';
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
        $mail->addAddress($row['email'], 'Raj Ramani');     //Add a recipient
        //$mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('parthkhokhar61@gmail.com', 'Reply');
        //$mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Product Confirmed';
        $mail->Body    = 'Your Product is confirmed by CARTECH and price is ' . @$price . "₹. You can watch your product here=> " . @$link . "<br>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo '<script>alert("Massage sent successfully!.");</script>';
            $q1 = "INSERT INTO `products`(`p_id`, `car_compney`, `car_purch_year`, `car_name`, `car_model`, `car_hestory`, `kms_driven`, `last_service`, `reg_no`, `owner`, `fual_type`, `type`, `insurance`, `price`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `status`) VALUES ('','" . $row['car_compney'] . "','" . $row['car_purch_year'] . "','" . $row['car_name'] . "','" . $row['car_model'] . "','Non-Accidental','" . $row['kms_driven'] . "','" . $row['kms_driven'] . "(28 Feb 2022)','" . $row['reg_no'] . "','" . $row['owner'] . "','" . $row['fual_type'] . "','" . $row['type'] . "','" . $row['insurance'] . "','$price','" . $row['img1'] . "','" . $row['img2'] . "','" . $row['img3'] . "','" . $row['img4'] . "','" . $row['img5'] . "','" . $row['img6'] . "','onsell')";
            if (mysqli_query($con, $q1)) {
                echo '<script type="text/javascript">alert("Product confirmed Successfull!")</script>';
                $q2 = "update seller set status='completed' where seller_id='$id'";
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
    $price = $_POST['price'];
    $id = $_POST['id'];
    $q = "select * from seller where seller_id = '$id'";
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
        $mail->Subject = 'Product Decline';
        $mail->Body    = 'Your Product is Decline by Old Car Seller.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if ($mail->send()) {
            echo '<script type="text/javascript">alert("Product Declined Successfull!")</script>';
            $q2 = "update seller set status='cancelled' where seller_id='$id'";
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