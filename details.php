<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "user") {
    // echo '<script type="text/javascript">alert("Welcome")</script>';

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <title>Details</title>

        <style>
            .error {
                color: red;
                font-size: 0.875em;
                margin-top: 5px;
            }
        </style>
    </head>

    <body>
        <?php
        $q = "select * from user where email='" . $_SESSION['em'] . "'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_array($result);
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <h3 class="text-warning">CARTECH</h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mob-navbar" aria-label="Toggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mob-navbar">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="user_view.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="color:#ffcb3d;" href="uvcar.php">Buy Car</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" href="sell.php">Sell Car</a>
                    </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="uvabout.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="uvcontact.php">Contact Us</a>
                        </li>
                        <div class="btn-group">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-fluid rounded-circle" src="profile_pictures/<?php echo $row['profile']; ?> " alt="Avatar Logo" style="width:40px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <p class="text-center mx-2"><?php echo $row['name'];
                                                            echo "<br>";
                                                            echo $row['email']; ?>
                                    <hr>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_profile" data-bs-whatever="@mdo">Edit Profile</button>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_profile_pic" data-bs-whatever="@mdo">Edit Profile
                                        Picture</button>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_pwd" data-bs-whatever="@mdo">Change Password</button>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- NAV ENDING -->
        <!-- ------------------------------------------------------------------- -->

        <!-- edit profile -->
        <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="edit_profileLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_profileLabel">Edit Your Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" name="nm" class="form-control" value="<?php echo $row['name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Email</label>
                                <input type="email" readonly name="em" class="form-control" value="<?php echo $row['email']; ?>">
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                            <input type="submit" class="btn btn-secondary" name="btnep" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit profile picture-->
        <div class="modal fade" id="edit_profile_pic" tabindex="-1" aria-labelledby="edit_profile_picLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_profile_picLabel">Edit Your Profile Picture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Select New Profile Picture</label>
                                <input type="file" name="new_ppic" class="form-control">
                            </div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                            <input type="submit" class="btn btn-secondary" name="btnepp" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- change password -->
        <div class="modal fade" id="change_pwd" tabindex="-1" aria-labelledby="change_pwdLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="change_pwdLabel">Change Your Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_profile.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Old Password</label>
                                <input type="password" required name="opwd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">New Password</label>
                                <input type="password" required name="npwd" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Confirm New Password</label>
                                <input type="password" required name="cnpwd" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                        <input type="submit" name="btncp" class="btn btn-secondary" value="Save Changes">
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- -------------------------------------------------------------------------------- -->
        <?php
        if (isset($_GET['view_btn']) && isset($_GET['pid'])) {

            $pid = $_GET['pid'];

            $q = "SELECT * FROM products WHERE p_id='$pid'";
            $result = mysqli_query($con, $q);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
        ?>
                    <!-- <div class="container" style="padding-top:2%;padding-left:3%;padding-bottom:2%;"> -->
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Product_images/<?php echo $row['img1'] ?>" alt="..." class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img2'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img3'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img4'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img5'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img6'] ?>" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- </div> -->
                    <div class="container my-5">
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col-md-10 col-sm-12">
                                    <h2 class="text-warning"><?php echo $row['car_compney'], " ", $row['car_name'], " | ", $row['type']; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-secondary"><?php echo $row['price'], " ₹"; ?></h3>
                            </div>
                            <hr>
                            <h2 class="text-warning mb-4">CAR DETAILS</h2>
                            <div class="card" style="border:none;overflow-x:auto;">
                                <table class="table table-hover" style="cursor:pointer;">
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/c244f7e76abe7b4d9e3800a16ab79ce2.svg"></td> -->
                                        <td><label>History</label></td>
                                        <td><label><?php echo $row['car_hestory']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/31aad21a7cefa87a350b7f33f1728075.svg"></td> -->
                                        <td><label>Owner</label></td>
                                        <td><label><?php echo $row['owner']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/e3a50ff3d7dabe4486ebe3abd088fd57.svg"></td> -->
                                        <td><label>Kilometers Driven</label></td>
                                        <td><label><?php echo $row['kms_driven']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/cbbaf45f2d2f91ddf9f1b5d98eb8303e.svg"></td> -->
                                        <td><label>Fuel Type</label></td>
                                        <td><label><?php echo $row['fual_type']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/9e1dd1e3c17bcc3f7e05a7e8b572b3fc.svg"></td> -->
                                        <td><label>Last Service</label></td>
                                        <td><label><?php echo $row['last_service']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/79ad45566630b92b7d80c9a388f70aef.svg"></td> -->
                                        <td><label>Transmission</label></td>
                                        <td><label><?php echo $row['type']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/7a9e42d67e964d25b648dcb59297975c.svg"></td> -->
                                        <td><label>Registration</label></td>
                                        <td><label><?php echo $row['reg_no']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/a0a1560d73c5174bceb87f81debca7c0.svg"></td> -->
                                        <td><label>Insurance</label></td>
                                        <td><label><?php echo $row['insurance']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/f8a3bec1d206e4a415212e6512d3cdfc.svg"></td> -->
                                        <td><label>Year of Purchase</label></td>
                                        <td><label><?php echo $row['car_purch_year']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                echo "<p>No car details found for the selected car.</p>";
            }
        } elseif (isset($_POST['book_btn']) && isset($_POST['p_id'])) {
            $pid = $_POST['p_id'];
            header("Location: details.php?p_id=$pid");
            exit();
        }

        // details.php

        if (isset($_GET['p_id'])) {
            $pid = $_GET['p_id'];
            $q = "SELECT * FROM products WHERE p_id='$pid'";
            $result = mysqli_query($con, $q);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <!-- <div class="container" style="padding-top:2%;padding-left:3%;padding-bottom:2%;"> -->
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Product_images/<?php echo $row['img1'] ?>" alt="..." class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img2'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img3'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img4'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img5'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="Product_images/<?php echo $row['img6'] ?>" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- </div> -->
                    <div class="container my-5">
                        <div class="container">
                            <div class="row mb-1">
                                <div class="col-md-10 col-sm-12">
                                    <h2 class="text-warning"><?php echo $row['car_compney'], " ", $row['car_name'], " | ", $row['type']; ?>
                                    </h2>
                                </div>

                                <div class="col-md-2 col-sm-12">

                                    <button class="btn btn-outline-warning btn-md" data-bs-toggle="modal" data-bs-target="#book" data-bs-whatever="@mdo">BOOK HERE</button>
                                    <!-- book car -->
                                    <div class="modal fade" id="book" tabindex="-1" aria-labelledby="bookLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-warning" id="bookLabel">BOOK YOUR CAR</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                           
                                                     <?php
                                                     $query = "select * from user where email='" . $_SESSION['em'] . "'";
                                                     $res = mysqli_query($con, $query);
                                                     $r = mysqli_fetch_array($result);
                                                     ?>
                                            
                                                <div class="modal-body">
                                                    <form action="book.php" method="GET" id="bookingForm">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="fname">
                                                        <div id="fname-error" class="error"></div>

                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="lname">
                                                        <div id="lname-error" class="error"></div>

                                                        <label>Email</label>
                                                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['em']; ?>" readonly>
                                                        <div id="email-error" class="error"></div>

                                                        <label>Mobile No</label>
                                                        <input type="text" class="form-control" name="mno">
                                                        <div id="mno-error" class="error"></div>

                                                        <label>Address</label>
                                                        <textarea name="addres" class="form-control" style="resize:none;"></textarea>
                                                        <div id="address-error" class="error"></div>

                                                        <input type="hidden" class="form-control" name="pid" value="<?php echo $row['p_id'] ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                    <input type="submit" name="btn_cof" class="btn btn-secondary" value="Confirm">
                                                    
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h3 class="text-secondary"><?php echo $row['price'], " ₹"; ?></h3>
                            </div>
                            <hr>
                            <h2 class="text-warning mb-4">CAR DETAILS</h2>
                            <div class="card" style="border:none;overflow-x:auto;">
                                <table class="table table-hover" style="cursor:pointer;">
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/c244f7e76abe7b4d9e3800a16ab79ce2.svg"></td> -->
                                        <td><label>History</label></td>
                                        <td><label><?php echo $row['car_hestory']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/31aad21a7cefa87a350b7f33f1728075.svg"></td> -->
                                        <td><label>Owner</label></td>
                                        <td><label><?php echo $row['owner']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/e3a50ff3d7dabe4486ebe3abd088fd57.svg"></td> -->
                                        <td><label>Kilometers Driven</label></td>
                                        <td><label><?php echo $row['kms_driven']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/cbbaf45f2d2f91ddf9f1b5d98eb8303e.svg"></td> -->
                                        <td><label>Fuel Type</label></td>
                                        <td><label><?php echo $row['fual_type']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/9e1dd1e3c17bcc3f7e05a7e8b572b3fc.svg"></td> -->
                                        <td><label>Last Service</label></td>
                                        <td><label><?php echo $row['last_service']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/79ad45566630b92b7d80c9a388f70aef.svg"></td> -->
                                        <td><label>Transmission</label></td>
                                        <td><label><?php echo $row['type']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/7a9e42d67e964d25b648dcb59297975c.svg"></td> -->
                                        <td><label>Registration</label></td>
                                        <td><label><?php echo $row['reg_no']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td><img src="https://www.cars24.com/js/a0a1560d73c5174bceb87f81debca7c0.svg"></td> -->
                                        <td><label>Insurance</label></td>
                                        <td><label><?php echo $row['insurance']; ?></label></td>
                                    </tr>
                                    <tr>
                                        <!-- <td><img src="https://www.cars24.com/js/f8a3bec1d206e4a415212e6512d3cdfc.svg"></td> -->
                                        <td><label>Year of Purchase</label></td>
                                        <td><label><?php echo $row['car_purch_year']; ?></label></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
        <?php
                }
            } else {
                echo "<p>No car details found for the selected car.</p>";
            }
        }
        ?>

        <!-- jQuery Validation Script -->
        <script>
            $(document).ready(function() {
                $("#bookingForm").submit(function(e) {
                    let valid = true;

                    // Validate First Name
                    const fname = $("input[name='fname']").val();
                    if (fname.trim() === "") {
                        $("#fname-error").text("First Name is required.");
                        valid = false;
                    } else {
                        $("#fname-error").text("");
                    }

                    // Validate Last Name
                    const lname = $("input[name='lname']").val();
                    if (lname.trim() === "") {
                        $("#lname-error").text("Last Name is required.");
                        valid = false;
                    } else {
                        $("#lname-error").text("");
                    }

                    // Validate Email
                    const email = $("input[name='email']").val();
                    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    if (email.trim() === "") {
                        $("#email-error").text("Email is required.");
                        valid = false;
                    } else if (!emailPattern.test(email)) {
                        $("#email-error").text("Invalid email format.");
                        valid = false;
                    } else {
                        $("#email-error").text("");
                    }

                    // Validate Mobile Number
                    const mno = $("input[name='mno']").val();
                    const mnoPattern = /^[0-9]{10}$/;
                    if (mno.trim() === "") {
                        $("#mno-error").text("Mobile Number is required.");
                        valid = false;
                    } else if (!mnoPattern.test(mno)) {
                        $("#mno-error").text("Mobile Number must be 10 digits.");
                        valid = false;
                    } else {
                        $("#mno-error").text("");
                    }

                    // Validate Address
                    const address = $("textarea[name='addres']").val();
                    if (address.trim() === "") {
                        $("#address-error").text("Address is required.");
                        valid = false;
                    } else {
                        $("#address-error").text("");
                    }

                    // Prevent form submission if validation fails
                    if (!valid) {
                        e.preventDefault();
                    }
                });
            });
        </script>


        <?php
        include_once "footer.php";
        ?>



    </body>

    </html>
<?php
} else {
    header("location:login.php");
    exit();
}
?>