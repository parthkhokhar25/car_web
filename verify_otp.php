<?php
session_start();

include_once("connection.php");
$_SESSION['token'] = $_REQUEST['token'];
$_SESSION['em'] = $_REQUEST['email'];
//echo "KKKKKKK" . $_SESSION['token'];
//echo "LLLLLLLL" . $_SESSION['em'];

if (!isset($_POST['submit'])) {

    date_default_timezone_set("Asia/Kolkata");
    $db_time = date("Y-m-d G:i:s");
    //$db_time = $_SESSION['db_time'];
    //$db_time = date("Y-m-d G:i:s", strtotime("+ 30 min"));
    // echo "LL" . $db_time;
    $q = "DELETE FROM `token1` WHERE `s_time`<'$db_time'";
    mysqli_query($con, $q);
    $token = $_REQUEST['token'];
    $em = $_REQUEST['email'];


    $q = "select * from token1 WHERE Email='$em' and token='$token'";
    // echo $q;
    $t = mysqli_query($con, $q);
    $count = mysqli_num_rows($t);
    if ($count == 0) {
?>
        <script type="text/javascript">
            alert("Password reset token expired.");
            //window.location.href = "login.php";
        </script>
    <?php
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
        <link rel="stylesheet" href="login.css" />
        <!-- Bootstrap CSS -->
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Verify OTP</title>
    </head>

    <body>
        <section class="vh-100" style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bg.jpg');background-position:center;background-size:cover;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="flex-grow-1 col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="3293465.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;height:100%;width:100%;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p- p-lg-5 text-black">

                                        <form action="check_otp.php" method="post">

                                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Verify OTP</h3>

                                            <div class="form-outline mb-4">
                                                <input type="number" id="form2Example17" required name="otp" class="form-control form-control-lg" />
                                                <label class="form-label" for="form2Example17">Enter OTP</label>
                                            </div>

                                            <div class="pt-1 mb-4">
                                                <a href="login.php" class="btn btn-outline-danger btn-lg">Cancle</a>&nbsp;
                                                <input type="submit" value="Submit" class="btn btn-outline-warning btn-lg btn-block" name="submit">
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
    </body>

    </html>
<?php
}

?>