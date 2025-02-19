<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "seller") {
    // echo '<script type="text/javascript">alert("Welcome")</script>';

    // Fetch total cars listed from the database
    $totalCarsQuery = "SELECT COUNT(*) as total FROM products";
    $result = $con->query($totalCarsQuery);
    $totalCars = 0;

    if ($result) {
        $row = $result->fetch_assoc();
        $totalCars = $row['total'];
    }

    // Fetch cars sold
    $carsSoldQuery = "SELECT COUNT(*) as total FROM products WHERE status = 'sold'";
    $resultSold = $con->query($carsSoldQuery);
    $carsSold = 0;

    if ($resultSold) {
        $row = $resultSold->fetch_assoc();
        $carsSold = $row['total'];
    }

    // Fetch pending sales
    $pendingSalesQuery = "SELECT COUNT(*) as total FROM orders WHERE status = 'pending'";
    $resultPending = $con->query($pendingSalesQuery);
    $pendingSales = 0;

    if ($resultPending) {
        $row = $resultPending->fetch_assoc();
        $pendingSales = $row['total'];
    }
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
        <script>
            function redirectTototal_car() {
                window.location.href = 'totalListed_car.php'; // Replace 'yourpage.php' with the path to your PHP file
            }

            function redirectsold_car() {
                window.location.href = 'sold_car.php'; // Replace 'yourpage.php' with the path to your PHP file
            }

            function redirectpending_car() {
                window.location.href = 'pending_sell.php'; // Replace 'yourpage.php' with the path to your PHP file
            }
        </script>
        <style>
            /* edit profile picture */
            .error-message {
                color: red;
                /* Red color for error messages */
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
        <title>Seller View</title>
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
                            <a class="nav-link" aria-current="page" href="seller_view.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sell.php">Add Product</a>
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
                        </li>
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
                        <form id="your-form-id" action="edit_profile.php" method="post">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name</label>
                                <input type="text" id="recipient-name" name="nm" class="form-control" value="<?php echo $row['name']; ?>">
                                <div id="name-error" class="text-danger" style="display: none;">Name is required.</div>
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
                        <form id="profileForm" action="edit_profile.php" method="post" enctype="multipart/form-data">
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
        <!-- Navigation Bar -->

        <!-- Dashboard Section -->
        <div class="container mt-5">
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body" type="button" onclick="redirectTototal_car()">
                            <h5 class="card-title">Total Cars Listed</h5>
                            <p class="card-text" id="total-cars"><?php echo $totalCars; ?></p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body" type="button" onclick="redirectsold_car()">
                            <h5 class="card-title">Cars Sold</h5>
                            <p class="card-text" id="cars-sold"><?php echo $carsSold; ?></p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body" type="button" onclick="redirectpending_car()">
                            <h5 class="card-title">Pending Sales</h5>
                            <p class="card-text" id="pending-sales"><?php echo $pendingSales; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php
        include_once "footer.php";
        ?>

        <!-- Bootstrap JS and Dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Custom JS -->
        <script src="script.js"></script>
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
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>