<?php
session_start();
include_once "connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/Exception.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Forgot Password</title>
</head>

<body>
    <section class="vh-100" style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bg.jpg');background-position:center;background-size:cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="3293465.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height:100%;width:100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-lg-5 text-black">
                                    <form action="forget_pwd_form.php" method="post">
                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Forgot Password</h3>
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" name="em" class="form-control form-control-lg" required />
                                            <label class="form-label" for="form2Example17">Email address</label>
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <a href="login.php" class="btn btn-outline-danger btn-lg">Cancel</a>&nbsp;
                                            <input type="submit" value="Send" class="btn btn-outline-warning btn-lg btn-block" name="sub">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['sub'])) {
        $em = mysqli_real_escape_string($con, $_POST['em']);

        // Check if email exists
        $q = "SELECT * FROM user WHERE email='$em'";
        $result = mysqli_query($con, $q);

        if (mysqli_num_rows($result) == 1) {
            // Check if a token already exists
            $q1 = "SELECT * FROM token1 WHERE Email='$em'";
            $countem = mysqli_num_rows(mysqli_query($con, $q1));

            if ($countem == 1) {
                echo "<script>alert('A Password reset link is already sent to your mail. Please check. New link will be generated after old link expires.');</script>";
            } else {
                date_default_timezone_set("Asia/Kolkata");
                $s_time = date("Y-m-d G:i:s", strtotime("+30 minutes"));
                $token = hash('sha512', $s_time);
                $otp = mt_rand(100000, 999999);

                // Insert token into database

                $ins_token = "INSERT INTO `token1`(`token_id`, `email`, `s_time`, `token`, `otp`) VALUES ('', '$em', '$s_time', '$token', $otp)";
                if (mysqli_query($con, $ins_token)) {
                    // Generate the password reset link
                    $base_url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                    $link = $base_url . "/verify_otp.php?email=" . urlencode($em) . "&token=" . urlencode($token);

                    // Configure PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'parthkhokhar61@gmail.com';
                        $mail->Password = 'cbmr prbi umyn exss'; // Ensure your app password is correct and secure
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 465;

                        // Email settings
                        $mail->setFrom('parthkhokhar61@gmail.com', 'Old Car Seller Website');
                        $mail->addAddress($em);
                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Link for Old Car Seller Website';
                        $mail->Body = "Your OTP for password reset is <strong>$otp</strong>. <br/>Click the link below to reset your password:<br/><a href='$link'>$link</a><br/><small>This link is valid for 24 hours.</small>";

                        if ($mail->send()) {
                            echo "<script>alert('Password reset link has been sent to your registered email. Please check your inbox and spam folder.');</script>";
                        }
                    } catch (Exception $e) {
                        echo "<script>alert('Failed to send the password reset email. Please try again later.');</script>";
                    }
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        } else {
            echo "<script>alert('No such Email address is registered'); window.location='forget_pwd_form.php';</script>";
        }
    }
    ?>
</body>

</html>
