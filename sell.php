<?php
    include_once "connection.php";
    ob_start();
    session_start();
    if(isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role']=="seller")
    {
       // echo '<script type="text/javascript">alert("Welcome")</script>';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <!-- <link rel="stylesheet" href="main.css" /> -->
    <title>Seller View</title>
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
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="seller_view.php"
                            >Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link active" href="sell.php" style="color:#ffcb3d;">Add Product</a>
                    </li>
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="img-fluid rounded-circle" src="profile_pictures/66bb318c978d4Screenshot_2023-01-11-19-30-47-99-min.jpg"
                                alt="Avatar Logo" style="width:40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <p class="text-center mx-2">temp <br> temp112@gmail.com
                                <hr>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#edit_profile" data-bs-whatever="@mdo">Edit Profile</button>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#edit_profile_pic" data-bs-whatever="@mdo">Edit Profile
                                    Picture</button>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#change_pwd" data-bs-whatever="@mdo">Change Password</button>
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
                            <input type="text" name="nm" class="form-control" value="temp">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email</label>
                            <input type="email" readonly name="em" class="form-control"
                                value="temp112@gmail.com">
                        </div>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancle</button>
                        <input type="submit" class="btn btn-secondary" name="btnep" value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- edit profile picture-->
    <div class="modal fade" id="edit_profile_pic" tabindex="-1" aria-labelledby="edit_profile_picLabel"
        aria-hidden="true">
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
    <section class="h-100 h-custom"
        style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bag.jpg');min-height:100vh;width:100%;background-position:center;background-size:cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="rlable.jpg" class="w-100"
                            style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">

                        <form class="px-md-2" action="sell.php" method="post" enctype="multipart/form-data" id="carSellForm">

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="firstName">Company</label>
            <input type="text" id="firstName" class="form-control form-control-md" pattern="[A-Za-z]+" title="Letters only" name="compony" />
            <small class="text-danger" id="companyError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="lastName">Car Name</label>
            <input type="text" id="lastName" class="form-control form-control-md" name="name" />
            <small class="text-danger" id="carNameError"></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="model">Car Model</label>
            <input type="text" id="model" class="form-control form-control-md" name="model" />
            <small class="text-danger" id="modelError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="fuelType">Fuel type</label>
            <select class="select form-control form-control-md" name="ftype" id="fuelType">
                <option value="">Select</option>
                <option>Petrol</option>
                <option>Diesel</option>
                <option>CNG</option>
            </select>
            <small class="text-danger" id="fuelTypeError"></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="kmsDriven">KMs Driven</label>
            <input type="text" id="kmsDriven" class="form-control form-control-md" name="kms" />
            <small class="text-danger" id="kmsError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="owner">Owner</label>
            <select class="select form-control form-control-md" name="owner" id="owner">
                <option value="">Select</option>
                <option>1st Owner</option>
                <option>2nd Owner</option>
                <option>3rd Owner</option>
                <option>4th Owner</option>
            </select>
            <small class="text-danger" id="ownerError"></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="regNo">Registration No.</label>
            <input type="text" id="regNo" class="form-control form-control-md" name="regno" />
            <small class="text-danger" id="regNoError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="type">Type</label>
            <select class="select form-control form-control-md" name="type" id="type">
                <option value="">Select</option>
                <option>Manual</option>
                <option>Auto</option>
            </select>
            <small class="text-danger" id="typeError"></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="year">Year</label>
            <select class="select form-control form-control-md" name="year" id="year">
                <option value="">Select</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
            </select>
            <small class="text-danger" id="yearError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="insurance">Insurance</label>
            <input type="text" id="insurance" class="form-control form-control-md" name="insurence" />
            <small class="text-danger" id="insuranceError"></small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="phoneNo">Phone No</label>
            <input type="text" id="phoneNo" pattern="^\d{10}$" class="form-control form-control-md" title="Please enter a valid mobile number" name="mno" />
            <small class="text-danger" id="phoneError"></small>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="form-outline">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" class="form-control form-control-md" name="email" />
            <small class="text-danger" id="emailError"></small>
        </div>
    </div>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="document">Upload your car RC-Book image</label>
    <input type="file" id="document" class="form-control form-control-mg" name="document" />
    <small class="text-danger" id="documentError"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img1">Upload your car image</label>
    <input type="file" id="img1" class="form-control form-control-mg" name="img1" />
    <small class="text-danger" id="img1Error"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img2">Upload your car image angle-1</label>
    <input type="file" id="img2" class="form-control form-control-mg" name="img2" />
    <small class="text-danger" id="img2Error"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img3">Upload your car image angle-2</label>
    <input type="file" id="img3" class="form-control form-control-mg" name="img3" />
    <small class="text-danger" id="img3Error"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img4">Upload your car image angle-3</label>
    <input type="file" id="img4" class="form-control form-control-mg" name="img4" />
    <small class="text-danger" id="img4Error"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img5">Upload your car interior image</label>
    <input type="file" id="img5" class="form-control form-control-mg" name="img5" />
    <small class="text-danger" id="img5Error"></small>
</div>

<div class="form-outline mb-4">
    <label class="form-label" for="img6">Upload your car speedometer image</label>
    <input type="file" id="img6" class="form-control form-control-mg" name="img6" />
    <small class="text-danger" id="img6Error"></small>
</div>

<input type="submit" class="btn btn-outline-warning btn-lg mb-1" value="Submit" name="btnsell">

</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include_once "footer.php";
    ?>
    <?php
        if (isset($_POST['btnsell']))
        {
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $compony=$_POST['compony'];
            $name=$_POST['name'];
            $model=$_POST['model'];
            $ftype=$_POST['ftype'];
            $kms=$_POST['kms'];
            $owner=$_POST['owner'];
            $regno=$_POST['regno'];
            $type=$_POST['type'];
            $year=$_POST['year'];
            $insurence=$_POST['insurence'];
            $mno=$_POST['mno'];
            $email=$_POST['email'];
            if ($_FILES['document']['name'] == "" && $_FILES['img1']['name'] == "" && $_FILES['img2']['name'] == "" && $_FILES['img3']['name'] == "" && $_FILES['img4']['name'] == "" && $_FILES['img5']['name'] == "" && $_FILES['img6']['name'] == "") {
                echo "<script type='text/javascript'> alert('please select a file');";
                echo "window.location='sell.php';</script>";
            } else {
                if ($_FILES['document']['size'] >= 204000 && $_FILES['img1']['size'] >= 204000 && $_FILES['img2']['size'] >= 204000 && $_FILES['img3']['size'] >= 204000 && $_FILES['img4']['size'] >= 204000 && $_FILES['img5']['size'] >= 204000 && $_FILES['img6']['size'] >= 204000) {
                    echo "<script type='text/javascript'> alert('please select a file with size less than 200KB');";
                    echo "window.location='sell.php';</script>";
                } else {
                        $document = uniqid() . $_FILES['document']['name'];
                        move_uploaded_file($_FILES['document']['tmp_name'], "Product_images/" . $document);
                        $img1 = uniqid() . $_FILES['img1']['name'];
                        move_uploaded_file($_FILES['img1']['tmp_name'], "Product_images/" . $img1);
                        $img2 = uniqid() . $_FILES['img2']['name'];
                        move_uploaded_file($_FILES['img2']['tmp_name'], "Product_images/" . $img2);
                        $img3 = uniqid() . $_FILES['img3']['name'];
                        move_uploaded_file($_FILES['img3']['tmp_name'], "Product_images/" . $img3);
                        $img4 = uniqid() . $_FILES['img4']['name'];
                        move_uploaded_file($_FILES['img4']['tmp_name'], "Product_images/" . $img4);
                        $img5 = uniqid() . $_FILES['img5']['name'];
                        move_uploaded_file($_FILES['img5']['tmp_name'], "Product_images/" . $img5);
                        $img6 = uniqid() . $_FILES['img6']['name'];
                        move_uploaded_file($_FILES['img6']['tmp_name'], "Product_images/" . $img6);
                        $q = "INSERT INTO seller(seller_id, fname, lname, car_compney, car_name, car_model, fual_type, kms_driven, owner, reg_no, type, car_purch_year, insurance, mobile_no, email, document, img1, img2, img3, img4, img5, img6,status) VALUES ('','$fname','$lname','$compony','$name','$model','$ftype','$kms','$owner','$regno','$type','$year','$insurence','$mno','$email','$document','$img1','$img2','$img3','$img4','$img5','$img6','pending')";
                        if (mysqli_query($con, $q)) {
                            echo "<script type='text/javascript'> alert('Data Submited Successfully!Our Team will be Contact You In 24 Hour!');";
                            echo "window.location='sell.php';</script>";
                        } else {
                            echo $q;
                            echo "<script type='text/javascript'> alert('Errror!');";
                            echo "window.location='sell.php';</script>";
                        }
                }
            }
        }
    ?>

    <script>
        $(document).ready(function () {
            $("#carSellForm").on("submit", function (e) {
                let isValid = true;

                // Clear previous errors
                $("small.text-danger").text("");

                // Validate Company
                if ($("#firstName").val().trim() === "") {
                    $("#companyError").text("Company name is required.");
                    isValid = false;
                }

                // Validate Car Name
                if ($("#lastName").val().trim() === "") {
                    $("#carNameError").text("Car name is required.");
                    isValid = false;
                }

                // Validate Car Model
                if ($("#model").val().trim() === "") {
                    $("#modelError").text("Car model is required.");
                    isValid = false;
                }

                // Validate Fuel Type
                if ($("#fuelType").val() === "") {
                    $("#fuelTypeError").text("Fuel type is required.");
                    isValid = false;
                }

                // Validate KMs Driven
                if ($("#kmsDriven").val().trim() === "") {
                    $("#kmsError").text("KMs driven is required.");
                    isValid = false;
                }

                // Validate Owner
                if ($("#owner").val() === "") {
                    $("#ownerError").text("Owner selection is required.");
                    isValid = false;
                }

                // Validate Registration No.
                if ($("#regNo").val().trim() === "") {
                    $("#regNoError").text("Registration number is required.");
                    isValid = false;
                }

                // Validate Type
                if ($("#type").val() === "") {
                    $("#typeError").text("Type selection is required.");
                    isValid = false;
                }

                // Validate Year
                if ($("#year").val() === "") {
                    $("#yearError").text("Year selection is required.");
                    isValid = false;
                }

                // Validate Insurance
                if ($("#insurance").val().trim() === "") {
                    $("#insuranceError").text("Insurance is required.");
                    isValid = false;
                }

                // Validate Phone Number
                if (!$("#phoneNo").val().match(/^\d{10}$/)) {
                    $("#phoneError").text("Please enter a valid 10-digit mobile number.");
                    isValid = false;
                }

                // Validate Email
                if ($("#email").val().trim() === "") {
                    $("#emailError").text("Email is required.");
                    isValid = false;
                }

                // Validate File Uploads
                if ($("#document").val().trim() === "") {
                    $("#documentError").text("RC-Book image is required.");
                    isValid = false;
                }
                if ($("#img1").val().trim() === "") {
                    $("#img1Error").text("Car image is required.");
                    isValid = false;
                }
                if ($("#img2").val().trim() === "") {
                    $("#img2Error").text("Car image angle-1 is required.");
                    isValid = false;
                }
                if ($("#img3").val().trim() === "") {
                    $("#img3Error").text("Car image angle-2 is required.");
                    isValid = false;
                }
                if ($("#img4").val().trim() === "") {
                    $("#img4Error").text("Car image angle-3 is required.");
                    isValid = false;
                }
                if ($("#img5").val().trim() === "") {
                    $("#img5Error").text("Car interior image is required.");
                    isValid = false;
                }
                if ($("#img6").val().trim() === "") {
                    $("#img6Error").text("Speedometer image is required.");
                    isValid = false;
                }

                // If the form is not valid, prevent submission
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>

<?php
} else {
    header("location:login.php");
}
?>
