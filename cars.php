<?php
    include_once "connection.php";
    ob_start();
    session_start();
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="cars.css" />
    <title>CARS PAGE</title>
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
                        <a class="nav-link active" aria-current="page" href="cars.php" style="color:#ffcb3d;">Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
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
    <?php 
        $q="select * from products";
        $result=mysqli_query($con,$q);
    ?>
    <div class="container pt-3">
        <div class="row">
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
            ?>
            <div class="col-md-3 col-sm-12 pb-3">
                <div class="card">
                    <img src="Product_images/<?php echo $row['img1'];?>" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['car_purch_year'];echo ' ';echo $row['car_name'];?></h5>
                        <b><?php echo $row['car_model'];echo ' ';echo $row['type'];?></b>
                        <p><?php echo $row['kms_driven'];echo '-';echo $row['owner'];?></p>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="price pt-2"><?php echo $row['price'];echo "₹";?></h5>
                            </div>
                            <div class="col">
                                <a href="login.php" class="btn btn-outline-warning">Buy now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
                else
                {
                    echo "No Products Uploaded Yet.";
                }
            ?>
        </div>
    </div>
    <?php
        include_once "footer.php";
    ?>
</body>

</html>