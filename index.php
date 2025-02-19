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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="main.css" />
    <title>HOME PAGE</title>
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
                        <a class="nav-link active" aria-current="page" href="index.php" style="color:#ffcb3d;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cars.php">Cars</a>
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

    <div class="container" style="padding-top:5%;padding-left:10%;padding-right:10%;padding-bottom:3%;">
        <div class="card bg-dark">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Company:</option>
                             <option>Vokswagen</option>
                            <option>Maruti</option>
                            <option>Hyundai</option>
                            <option>Ford</option>
                            <option>Honda</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Year:</option>
                            <option>2014</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control">
                            <option class="selected">Select Category:</option>
                            <option>Petrol</option>
                            <option>Disel</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 text-center">
                        <a href="cars.php"><button class="btn btn-primary btn-lg btn-block" type="button">Search</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <div class="mt-5 container" style="padding-bottom:10%;">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card bg-dark">
                    <a href="cars.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FTigor%2F2024%2F04%2F01%2F71bea915-ddf4-46b1-95c6-cd2615b3960a-Tata_Tigor_Magnetic-Red.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">SADAN</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="cars.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FCar-Image%2F2024%2F04%2F16%2F1336a4f6-da41-4b8b-b59f-785338c925d3-Maruti-Suzuki_Alto-Tour_Car-Image.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">COUPE</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="cars.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FNexon%2F2024%2F04%2F09%2F7f825519-2f2b-437e-8069-6133d825af28-Tata_Nexon_Fearless-Purple-Dual-Tone.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">NEXON</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="cars.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FPunch%2F2024%2F04%2F01%2F97d3654c-05da-45ab-9b42-1b5f17ce3b4f-Tata_Punch_Tornado-Blue-with-White-Roof.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">PUNCH</p>
                    </div>
                </div>
            </div>
        </div>

       <div class="text-center" style="margin-top: 10%;">
  <button type="button" class="btn btn-primary"><a href="cars.php"  class="text-decoration-none" style="color:aliceblue;">Explore Our Inventory</a></button>
</div>
</div>
    </div>
    <?php
    include_once "footer.php";
    ?>
</body>

</html>