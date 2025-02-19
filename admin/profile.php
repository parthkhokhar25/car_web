<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Profile Page</title>
    
    <style>
        .profile-card {
            width: 100%;
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .profile-card .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-card .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        .error-message {
            color: red;
            font-size: 0.875em;
            display: none;
        }
        .error-border {
            border-color: red;
            border-width: 2px;
        }
    </style>
</head>

<body>
    <?php
        include_once 'connection.php';
        $q = "SELECT * FROM user WHERE role='admin'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_array($result);
    ?>

    <div class="container">
        <div class="profile-card card">
            <img src="profile_pictures/<?php echo $row['profile']; ?>" alt="Profile Picture" class="profile-image img-fluid rounded-circle">
            <h3><?php echo $row['name']; ?></h3>
            <p class="text-muted"><?php echo $row['email']; ?></p>
            
            <!-- Buttons for profile actions -->
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_profile">Edit Profile</button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit_profile_pic">Edit Profile Picture</button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#change_pwd">Change Password</button>
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="edit_profile" tabindex="-1" aria-labelledby="edit_profileLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_profileLabel">Edit Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" action="edit_profile.php" method="POST">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" id="recipient-name" name="nm" class="form-control" value="<?php echo $row['name']; ?>">
                            <div id="name-error" class="error-message">Name is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" id="email" name="em" class="form-control" value="<?php echo $row['email']; ?>" readonly>
                        </div>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" name="btnep" value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Picture Modal -->
    <div class="modal fade" id="edit_profile_pic" tabindex="-1" aria-labelledby="edit_profile_picLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_profile_picLabel">Edit Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="profileForm" action="edit_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="new_ppic" class="col-form-label">Select New Profile Picture</label>
                            <input type="file" id="new_ppic" name="new_ppic" class="form-control">
                            <div id="fileError" class="error-message">Please select a valid profile picture (JPEG/PNG, < 200KB).</div>
                        </div>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" name="btnepp" value="Save Changes">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="change_pwd" tabindex="-1" aria-labelledby="change_pwdLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_pwdLabel">Change Your Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm" action="edit_profile.php" method="POST">
                        <div class="mb-3">
                            <label for="oldPassword" class="col-form-label">Old Password</label>
                            <input type="password" id="oldPassword" name="opwd" class="form-control">
                            <div id="opwdError" class="error-message">Old Password is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="col-form-label">New Password</label>
                            <input type="password" id="newPassword" name="npwd" class="form-control">
                            <div id="npwdError" class="error-message">New Password is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="col-form-label">Confirm New Password</label>
                            <input type="password" id="confirmNewPassword" name="cnpwd" class="form-control">
                            <div id="cnpwdError" class="error-message">Passwords do not match.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <input type="submit" name="btncp" class="btn btn-primary" value="Save Changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Picture Validation -->
    <script>
        $(document).ready(function() {
            $("#profileForm").submit(function(event) {
                var fileInput = $("#new_ppic")[0].files[0];
                var errorMessage = "";

                $(".error-message").hide();

                if (!fileInput) {
                    $("#fileError").show();
                    errorMessage += "No file selected.\n";
                } else {
                    if (fileInput.size >= 204800) {
                        $("#fileError").text("File size exceeds the 200KB limit.").show();
                        errorMessage += "File too large.\n";
                    }

                    var validTypes = ["image/jpeg", "image/png"];
                    if ($.inArray(fileInput.type, validTypes) === -1) {
                        $("#fileError").text("Please select a JPEG or PNG file.").show();
                        errorMessage += "Invalid file type.\n";
                    }
                }

                if (errorMessage !== "") {
                    event.preventDefault();
                }
            });

            // Change Password Form Validation
            $("#changePasswordForm").submit(function(event) {
                var isValid = true;
                $('.error-message').hide();

                var oldPassword = $("#oldPassword").val().trim();
                var newPassword = $("#newPassword").val().trim();
                var confirmPassword = $("#confirmNewPassword").val().trim();

                if (oldPassword === "") {
                    $("#opwdError").show();
                    isValid = false;
                }

                if (newPassword === "") {
                    $("#npwdError").show();
                    isValid = false;
                }

                if (confirmPassword === "") {
                    $("#cnpwdError").show();
                    isValid = false;
                }

                if (newPassword !== confirmPassword) {
                    $("#cnpwdError").text("Passwords do not match.").show();
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>

</body>

</html>
