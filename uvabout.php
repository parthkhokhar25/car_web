<?php
    include_once "connection.php";
    ob_start();
    session_start();
    if(isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role']=="user")
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
    <link rel="stylesheet" href="aboutus.css" />
    <title>User View</title>
    <style>
        /* edit profile picture */
        .error-message {
            color: red; /* Red color for error messages */
            font-size: 14px;
            margin-top: 5px;
        }
    </style>

    <style>
        /* change password */
    .error-message1 {
        color: red;
        font-size: 0.875em;
        display: none;
    }
    </style>
    <style>
    .error-border {
        /* edit profile */
        border-color: red;
        border-width: 2px;
    }
</style>
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
    <?php
            $q = "select * from user where email='".$_SESSION['em']."'";
            $result = mysqli_query($con, $q);
            $row = mysqli_fetch_array($result);
        ?>
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
                        <a class="nav-link" aria-current="page" href="user_view.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvcar.php">Buy Car</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="sell.php">Sell Used Car</a>
                    </li> -->
                    <li class="nav-item active">
                        <a class="nav-link" style="color:#ffcb3d;" href="uvabout.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="uvcontact.php">Contact Us</a>
                    </li>
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="img-fluid rounded-circle" src="profile_pictures/<?php echo $row['profile'];?> "
                                alt="Avatar Logo" style="width:40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <p class="text-center mx-2"><?php echo $row['name'];echo "<br>";echo $row['email'];?>
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
                    <form  id="your-form-id" action="edit_profile.php" method="post">
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Name</label>
                      <input type="text" id="recipient-name" name="nm" class="form-control" value="<?php echo $row['name'];?>">
                      <div id="name-error" class="text-danger" style="display: none;">Name is required.</div>
                    </div>

                    <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email</label>
                            <input type="email" readonly name="em" class="form-control"
                                value="<?php echo $row['email'];?>">
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
                    <form  id="profileForm" action="edit_profile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Select New Profile Picture</label>
                            <input type="file" id="new_ppic" name="new_ppic" class="form-control">
                            <span id="fileError" class="error-message"></span><br>

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
                <form id="editProfileForm" action="edit_profile.php" method="post">
    <div class="mb-3">
        <label for="oldPassword" class="col-form-label">Old Password</label>
        <input type="password" id="oldPassword" name="opwd" class="form-control">
        <span id="opwdError" class="error-message1"></span>
    </div>
    <div class="mb-3">
        <label for="newPassword" class="col-form-label">New Password</label>
        <input type="password" id="newPassword" name="npwd" class="form-control">
        <span id="npwdError" class="error-message1"></span>
    </div>
    <div class="mb-3">
        <label for="confirmNewPassword" class="col-form-label">Confirm New Password</label>
        <input type="password" id="confirmNewPassword" name="cnpwd" class="form-control">
        <span id="cnpwdError" class="error-message1"></span>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="btncp" class="btn btn-secondary" value="Save Changes">
    </div>
</form>

                </div>
            </div>
        </div>
    </div>



    <!-- -------------------------------------------------------------------------------- -->
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

     <!-- profile picture validation -->
     <script>
        $(document).ready(function() {
            // Client-side form validation
            $("#profileForm").submit(function(event) {
                var fileInput = $("#new_ppic")[0].files[0];
                var errorMessage = "";

                // Clear previous error messages
                $(".error-message").text("");

                if (!fileInput) {
                    $("#fileError").text("Please select a profile picture.");
                    errorMessage += "Please select a profile picture.\n";
                } else {
                    // Check file size
                    if (fileInput.size >= 204000) {
                        $("#fileError").text("Please select a file with size less than 200KB.");
                        errorMessage += "File size exceeds the limit.\n";
                    }

                    // Check file type
                    var validTypes = ["image/jpeg", "image/png"];
                    if ($.inArray(fileInput.type, validTypes) === -1) {
                        $("#fileError").text("Please select a file in JPEG or PNG format.");
                        errorMessage += "Invalid file type.\n";
                    }
                }

                // Display error message if any
                if (errorMessage !== "") {
                    event.preventDefault(); // Prevent form submission if validation fails
                }
            });
        });
    </script>

    <!-- change password validation -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#editProfileForm').on('submit', function(event) {
        // Clear previous error messages
        $('.error-message').hide();

        let isValid = true;

        // Get values
        const oldPassword = $('#oldPassword').val().trim();
        const newPassword = $('#newPassword').val().trim();
        const confirmNewPassword = $('#confirmNewPassword').val().trim();

        // Validate Old Password
        if (oldPassword === '') {
            $('#opwdError').text('Old Password is required.').show();
            isValid = false;
        }

        // Validate New Password
        if (newPassword === '') {
            $('#npwdError').text('New Password is required.').show();
            isValid = false;
        }

        // Validate Confirm New Password
        if (confirmNewPassword === '') {
            $('#cnpwdError').text('Please confirm your new password.').show();
            isValid = false;
        } else if (newPassword !== confirmNewPassword) {
            $('#cnpwdError').text('New passwords do not match.').show();
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            event.preventDefault();
        }
    });
});
</script>

<!-- for edit profile -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#your-form-id').submit(function(event) {
            var isValid = true;
            var nameInput = $('#recipient-name');
            var errorDiv = $('#name-error');

            // Remove previous error states
            nameInput.removeClass('error-border');
            errorDiv.hide();

            // Validate name field
            if (nameInput.val().trim() === '') {
                nameInput.addClass('error-border');
                errorDiv.show();
                isValid = false;
            }

            // Prevent form submission if invalid
            if (!isValid) {
                event.preventDefault(); // Stops form from submitting
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
    }
    else
    {
        header("location:login.php");
    }
?>