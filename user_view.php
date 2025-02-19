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
    <link rel="stylesheet" href="main.css" />
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
                        <a class="nav-link active" aria-current="page" href="user_view.php"
                            style="color:#ffcb3d;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="uvcar.php">Buy Car</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="sell.php">Sell Used Car</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="uvabout.php">About Us</a>
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
   
    <div class="container" style="padding-top:5%;padding-left:10%;padding-right:10%;padding-bottom:3%;">
    <div class="card bg-dark">
        <div class="card-body">
            <form action="search.php" method="GET"> <!-- Form action to send data to PHP script -->
                <div class="row">
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control" name="company">
                            <option class="selected">Select Company:</option>
                            <option>Vokswagen</option>
                            <option>Maruti</option>
                            <option>Hyundai</option>
                            <option>Ford</option>
                            <option>Honda</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 pb-2">
                        <select class="form-control" name="year">
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
                        <select class="form-control" name="category">
                            <option class="selected">Select Category:</option>
                            <option>Petrol</option>
                            <option>Disel</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12 text-center">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
   
   
   
<div class="mt-5 container" style="padding-bottom:10%;">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card bg-dark">
                    <a href="uvcar.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FTigor%2F2024%2F04%2F01%2F71bea915-ddf4-46b1-95c6-cd2615b3960a-Tata_Tigor_Magnetic-Red.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">SADAN</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="uvcar.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FCar-Image%2F2024%2F04%2F16%2F1336a4f6-da41-4b8b-b59f-785338c925d3-Maruti-Suzuki_Alto-Tour_Car-Image.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">COUPE</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="uvcar.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FNexon%2F2024%2F04%2F09%2F7f825519-2f2b-437e-8069-6133d825af28-Tata_Nexon_Fearless-Purple-Dual-Tone.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">NEXON</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-dark">
                    <a href="uvcars.php">
                        <img src="https://www.cars24.com/new-cars/_next/image/?url=https%3A%2F%2Fcdn.24c.in%2Fprod%2Fnew-car-cms%2FTata%2FPunch%2F2024%2F04%2F01%2F97d3654c-05da-45ab-9b42-1b5f17ce3b4f-Tata_Punch_Tornado-Blue-with-White-Roof.png&w=384&q=75" class="card-img-top" alt="cars" style="width:100%;height:100%;">
                    </a>
                    <div class="card-body">
                        <p class="h5 text-center" style="color:#fff;">PUNCH</p>
                    </div>
                </div>
            </div>
        </div>

       <div class="text-center" style="margin-top: 10%;">
  <button type="button" class="btn btn-primary"><a href="uvcar.php"  class="text-decoration-none" style="color:aliceblue;">Explore Our Inventory</a></button>
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
        exit();
    }
?>