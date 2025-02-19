<?php
    include_once "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css"
        integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="contact.css" />
    <script type="text/javascript" src="contact.js"></script>
    <title>CONTACT US PAGE</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <h3 class="text-warning">CARTECH</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar"
                aria-label="Toggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mob-navbar">
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cars.php">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#ffcb3d;" href="contactus.php">Contact Us</a>
                    </li>
                </ul>
                <button class="btn btn-primary" style="margin-right:1%;"><a href="login.php"
                        class="text-decoration-none" style="color:aliceblue;">Login</a></button>
                <button class="btn btn-success"><a href="register.php" class="text-decoration-none"
                        style="color:aliceblue;">Register Here</a></button>
            </div>
        </div>
    </nav>
    <!-- NAV ENDING -->
    <section class="contect">
        <div class="contact" style="padding-top:2%;">
            <h2>Contact Us</h2>
        </div>
        <div class="container" style="padding-top:2%;padding-bottom:2%;">
            <div class="conatactInfo">
                <div class="box">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Bedipara sharmjivi socity street no.3,opp rajmoti oil mill,Bhavnagar road,Rajkot-360003</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>+91 9624631559</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>parthkhokhar61@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="contactForm" style="border-radius:12px;">
                <form onsubmit="return(btnc_click());" method="post">
                    <h2 class="mb-3">Send Massage</h2>
                    <div class="mb-4">
                        <lable>Name</lable>
                        <input type="text" id="t1" name="nm" class="form-control mt-1" />
                        <p id="p1"></p>
                    </div>
                    <div class="mb-4">
                        <lable>Email</lable>
                        <input type="text" id="t2" name="em" class="form-control mt-1" />
                        <p id="p2"></p>
                    </div>
                    <div class="mb-4">
                        <lable>Type your massage</lable>
                        <textarea name="msg" id="t3" class="form-control mt-1"
                            style="height:5rem;resize:none;"></textarea>
                        <p id="p3"></p>
                    </div>
                    <input type="submit" name="btnc" class="btn btn-outline-warning btn-lg" />
                </form>
            </div>
        </div>
    </section>
    <?php
        include_once "footer.php";
    ?>
    <?php
        if(isset($_POST['btnc']))
        {
            $name=$_POST['nm'];
            $email=$_POST['em'];
            $massage=$_POST['msg'];
            $q="insert into contact values('$name','$email','$massage')";
            if(mysqli_query($con,$q))
            {
                echo "<script type='text/javascript'> alert('Massage Sent Successfully!')</script>";
            }
            else
            {
                echo "<script type='text/javascript'> alert('Error!!')</script>";
            }
        }
    ?>
</body>

</html>