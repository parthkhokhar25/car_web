<?php
session_start();
include_once("connection.php");

date_default_timezone_set("Asia/Kolkata");
$db_time = date("Y-m-d G:i:s");
//echo $db_time;
$q = "DELETE FROM `token1` WHERE `s_time`<'$db_time'";
mysqli_query($con, $q);

$token = $_SESSION['token'];
$em = $_SESSION['em'];
//echo $token;
//echo $em;

$q = "select * from token1 WHERE Email='$em' and token='$token'";
//echo $q;
$t = mysqli_query($con, $q);
$count = mysqli_num_rows($t);
if ($count == 0) {
?>
    <script type="text/javascript">
        alert("Password reset token expired.");
        window.location.href = "login.php";
    </script>
    <?php
}
// echo "$db_time";
if (isset($_POST['submit'])) {

    $login_id = $_SESSION['em'];
    $token = $_SESSION['token'];
    $passwd = $_POST['npwd'];
    //$passwd = hash('sha512',$passwd);

    $q = "select * from token1 WHERE Email='$login_id' and token='$token'";
    $t = mysqli_query($con, $q);
    $count = mysqli_num_rows($t);
    $temp = mysqli_fetch_assoc($t);
    if ($count > 0) {
        // if ($login_id==$temp['Email'] && $token==$temp['token']) 
        // {
        $q = "UPDATE `user` SET `password`='$passwd' WHERE email='$login_id'";
        if (mysqli_query($con, $q)) {

            $q = "DELETE FROM `token1` WHERE Email='$login_id'";
            if (mysqli_query($con, $q)) {
    ?>
                <script type="text/javascript">
                    alert("Password reset Successfull.");
                    window.location.href = "login.php";
                </script>
            <?php
            } else {
            ?>
                <script type="text/javascript">
                    alert("Error in deleting Token");
                    window.location.href = "login.php";
                </script>
            <?php
            }
        } else {
            ?>
            <script type="text/javascript">
                alert("Error in resetting password.");
                window.location.href = "login.php";
            </script>
        <?php
        }
        ?>
    <?php
    } else {

    ?>
        <script type="text/javascript">
            alert("Password reset token123 expired.");
            window.location.href = "login.php";
        </script>
<?php
    }
}

?>

<script type="text/javascript">
    function validate123() {
        //alert("welcome to js");

        var pwd = document.getElementById('pass').value;
        var pwd1 = document.getElementById('password1').value;
        //alert("welcome to js");

        if (pwd == "") {
            document.getElementById('passw').innerHTML = "Password field cannot be empty";
            document.getElementById('passw').style.color = "red";
            document.getElementById('pass').style.borderColor = "red";
            var vpwd = "false";
        } else {
            re = /[0-9]/;
            re1 = /[a-z]/;
            re2 = /[A-Z]/;
            var a1 = pwd.length < 6;
            var a2 = pwd.length > 15;
            var a3 = re.test(pwd);
            var a4 = re1.test(pwd);
            var a5 = re2.test(pwd);
            if (a1 == true || (a2 == true) || (a3 == false) || (a4 == false) || (a5 == false)) {
                document.getElementById('pass').focus();
                var msgpwd =
                    "Password length must be 6 to 15 charachters and must contain one small and capital letter a digit and special character";
                document.getElementById('passw').innerHTML = msgpwd;
                document.getElementById('passw').style.color = "red";
                document.getElementById('pass').style.borderColor = "red";
                var vpwd = "false";
                //alert(vpwd);
            } else {
                var msgpwd = "";
                document.getElementById('passw').innerHTML = msgpwd;
                document.getElementById('pass').style.borderColor = "green";
                vpwd = "true";
            }
        }
        if (pwd1 == "") {
            document.getElementById('passw1').innerHTML = "Confirm Password field cannot be empty";
            document.getElementById('passw1').style.color = "red";
            document.getElementById('password1').style.borderColor = "red";
            var vpwd1 = "false";
        } else {
            if (pwd1 != pwd) {
                document.getElementById('password1').focus();
                document.getElementById('passw1').innerHTML = "Password and Confirm Password must be same";
                document.getElementById('passw1').style.color = "red";
                document.getElementById('password1').style.borderColor = "red";
                vpwd1 = "false";
            } else {
                document.getElementById('passw1').innerHTML = "";
                document.getElementById('password1').style.borderColor = "green";
                vpwd1 = "true";
            }
        }

        if (vpwd == "true" && vpwd1 == "true") {
            return true;
        } else {
            return false;
        }
    }
</script>

<html>

<head>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="login.css" />
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

                                    <form action="change_password_form.php" method="post">

                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Change Password
                                        </h3>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example17" required name="npwd" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">New Password</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" required name="rnpwd" class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Confirm New Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <a href="login.php" class="btn btn-outline-danger btn-lg">Cancle</a>&nbsp;
                                            <input type="submit" value="Change Password" class="btn btn-outline-warning btn-lg btn-block" name="submit">
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