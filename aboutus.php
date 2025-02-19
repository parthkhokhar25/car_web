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
    <link rel="stylesheet" href="aboutus.css" />
    <title>ABOUT US PAGE</title>
    <style>
          .text-orange {
            color: orange;
        }
        .img-custom {
            max-width: 100%;
            height: auto;
        }
    </style>
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
                        <a class="nav-link active" aria-current="page" href="aboutus.php" style="color:#ffcb3d;">About Us</a>
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


    <div class="container-fuild" style="padding-top:1.5%;">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                            class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="slider_images/PngItem_1520449.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="slider_images/PngItem_3198897.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="slider_images/sliderbanner-used.jpg" class="d-block w-100" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="slider_images/img-article-steps-banner.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <h1 class="text-orange mb-4">ABOUT CARTECH</h1>
        <div class="row">
            <div class="col-lg-6 col-md-12 mb-4">
                <p class="text-justify">CARTECH is a next-generation ecommerce platform for pre-owned cars. We provide the best-in-class experience for car buyers by offering a wide assortment of certified cars that are home-delivered with a click of a button, while sellers get the best price for their vehicles in less than 1 hour.</p>
                <p class="text-justify">Buying a second car is not always easy; it requires hours of browsing, multiple test drives, and weeks before finding the right one. But with us, it is as simple as browsing through thousands of certified cars and reserving your favorite one by paying a refundable deposit. We’ll deliver the car to your home, or you can collect it from a CARTECH hub near you. If you don’t like your car, return it and get a complete refund within seven days.</p>
                <p class="text-justify">Over the years we’ve simplified car selling! One can sell their car from their home or our branch in less than 1 hour and get the best price instantly. We also take care of ownership (RC) transfer for free.</p>
            </div>
            <div class="col-lg-6 col-md-12">
                <img class="img-fluid img-custom" src="https://www.impactplus.com/hs-fs/hubfs/blog-image-uploads/best-about-us-pages.jpg?length=1200&name=best-about-us-pages.jpg" alt="About">
            </div>
        </div>
    </div>
    <div class="container" style="padding-left:3%;padding-right:3%;padding-bottom:3%;">
        <h1 style="color:orange;text-align:left;">Selling with CARTECH</h1><br>
        <p><b>Sell from anywhere:</b>Book an appointment for an inspection at your home or at any of our 200+ branches.
        </p>
        <p><b>Sell car at the best price:</b>With our live auction, get the best offers from thousands of buyers from
            across the country. </p>
        <p><b>Sell car in 1 hour:</b>Our entire car selling process takes less than 1 hour.</p>
        <p><b>Get instant payment:</b>The moment we buy your car, the payment is transferred to your bank account.</p>
        <p><b>Free RC transfer:</b>CARSTECH takes care of the ownership transfer / RC Transfer on behalf of you.</p>
    </div>
    <div class="container" style="padding-left:3%;padding-right:3%;padding-bottom:3%;">
        <h1 style="color:orange;text-align:left;">OUR STAFF</h1><br>
        <div class='container mx-auto mt-5 col-md-10 mt-100'>
            <div class="card-group" style="justify-content:center;text-align:center;">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img
                                    src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583336/AAA/4.jpg">
                            </div>
                            <div class="card-title"> <b> Angelina Frederic</b><br /> <small>CEO of K mart</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of
                                        Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img
                                    src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583319/AAA/3.jpg">
                            </div>
                            <div class="card-title"> <b>Jackson Totham</b><br /> <small>CEO of Redbull</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of
                                        Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Sundar_Pichai_%28cropped1%29.jpg/220px-Sundar_Pichai_%28cropped1%29.jpg">
                            </div>
                            <div class="card-title"><b>Sundar Pichai</b><br /> <small>CEO of Google</small> </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of
                                        Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body p-0">
                            <div class="profile"> <img
                                    src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg">
                            </div>
                            <div class="card-title">
                                <b>David Gregory</b><br /> <small>Resident Dj at ibdc</small>
                            </div>
                            <div class="card-subtitle">
                                <p> <small class="text-muted"> I really enjoyed working with them, they are Group of
                                        Professionals and they know what they're Doing </small> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "footer.php";
    ?>
</body>

</html>