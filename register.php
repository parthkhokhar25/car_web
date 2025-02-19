<?php
include_once "connection.php";
// Start session at the very beginning of the file
session_start();

if (isset($_POST['btnr'])) {
    $name = trim($_POST['nm']);
    $email = trim($_POST['em']);
    $password = trim($_POST['pwd']);
    $role = trim($_POST['role']);
    $errorsMessage = '';

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $_SESSION['error']['form'] = 'All fields are required.';
        header('Location: register.php');
        exit();
    }

    // Handle file upload
    $profilePicture = '';
    if (isset($_FILES['p_pic']) && $_FILES['p_pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['p_pic']['tmp_name'];
        $fileName = $_FILES['p_pic']['name'];
        $fileNameCmps = explode('.', $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions and size
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB

        if (in_array($fileExtension, $allowedExtensions)) {
            if ($_FILES['p_pic']['size'] <= $maxFileSize) {
                $uploadDir = 'profile_pictures/';
                $destPath = $uploadDir . $fileName;

                // Move the uploaded file to the server
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $profilePicture = $fileName;
                } else {
                    $errorsMessage = 'Error uploading file.';
                }
            } else {
                $errorsMessage = 'File size exceeds 2MB.';
            }
        } else {
            $errorsMessage = 'Invalid file extension.';
        }
    } else {
        $errorsMessage = 'Profile picture is required.';
    }

    if (!empty($errorsMessage)) {
        $_SESSION['error']['form'] = $errorsMessage;
        header('Location: register.php');
        exit();
    }

    // Check if email already exists
    $emailCheckQuery = "SELECT uid FROM user WHERE email = '$email'";
    $result = mysqli_query($con, $emailCheckQuery);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error']['form'] = 'Email already exists.';
        mysqli_close($con);
        header('Location: register.php');
        exit();
    }

    // Insert new user
    $insertQuery = "INSERT INTO user (name, email, password, profile, role) VALUES ('$name', '$email', '$password', '$profilePicture', '$role')";

    if (mysqli_query($con, $insertQuery)) {
        $_SESSION['success'] = 'Registration successful!';
    } else {
        $_SESSION['error']['form'] = 'Registration failed: ' . mysqli_error($con);
    }

    mysqli_close($con);
    header('Location: register.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Bootsrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- <script type="text/javascript" src="main.js"></script> -->
    
    <title>Register page</title>
    <style>
        .form-error {
            color: red;
            font-size: 0.875em;
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
    <section class="h-100 h-custom"
        style="background-image: linear-gradient(rgba(4,9,30,0.7), rgba(4,9,30,0.7)), url('bg.jpg'); background-position: center; background-size: cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="buying-new-car-rent-auto-carsharing-businessmen-signing-contract-for-car-leasing-and-shaking-hands-bank-loan-agreement-property-insurance-agent-selling-vehicle-to-customer-vector.png"
                            class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                            alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>
                             <!-- Display alerts for success and error messages -->
                            <form class="px-md-2" action="register.php" method="post" id="myForm" enctype="multipart/form-data">
                            <!-- Display Bootstrap Alerts (if needed) -->
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                                echo $_SESSION['success'];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION['success']);
                            }
                            if (isset($_SESSION['error']['form'])) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                echo $_SESSION['error']['form'];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                                echo '</div>';
                                unset($_SESSION['error']['form']);
                            }
                            ?>

                            <div class="mb-4">
                                    <input type="text" name="nm" id="t1" class="form-control" />
                                    <label class="form-label" for="forname">Name</label>
                                    <p id="p1" class="form-error"></p>
                                </div>
                                <div class="mb-4">
                                    <input type="text" id="t2" name="em" class="form-control">
                                    <label class="form-label" for="foremail">E-mail</label>
                                    <p id="p2" class="form-error"></p>
                                </div>
                                <div class="mb-4">
                                    <input type="password" id="t3" name="pwd" class="form-control" />
                                    <label class="form-label" for="forpassword">Password</label>
                                    <p id="p3" class="form-error"></p>
                                </div>
                                
                                <div class="mb-4">
                                <input type="file" class="form-control" name="p_pic" id="p_pic">
                                    <label for="p_pic">Profile Picture:</label>
                                    <p id="p4" class="form-error"></p>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="role" class="form-label">Register as :</label>
                                    <select id="role" name="role" class="form-select">
                                        <option value=""></option>   
                                        <option value="user">Buyer</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                    <p id="p5" class="form-error"></p>
                                </div>
                               
                                
                                <input type="submit" name="btnr" id="temp" value="Register"
                                    class="btn btn-outline-warning btn-lg mb-1" /><br><br>
                                <p class="mb-5 pb-lg-2" style="color: #393f81;">Have already an account?
                                    <a href="login.php" class="text-decoration-none" style="color: #393f81;">Login
                                        here</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     

       <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            // e.preventDefault(); // Comment this out if you want normal form submission

            // Clear previous errors
            $('.form-error').text('');

            // Get form values
            var name = $('#t1').val().trim();
            var email = $('#t2').val().trim();
            var password = $('#t3').val().trim();
            var profilePic = $('#p_pic')[0].files[0];
            var role = $('#role').val();

            var isValid = true;

            // Basic validation
            if (name === '') {
                $('#p1').text('Name is required.');
                isValid = false;
            }
            if (email === '') {
                $('#p2').text('Email is required.');
                isValid = false;
            } else if (!validateEmail(email)) {
                $('#p2').text('Invalid email format.');
                isValid = false;
            }
            if (password === '') {
                $('#p3').text('Password is required.');
                isValid = false;
            }
            
            // File validation
            if (!profilePic) {
                $('#p4').text('Profile picture is required.');
                isValid = false;
            } else {
                var fileType = profilePic.type;
                var fileSize = profilePic.size;

                // Allowed file types
                var allowedTypes = ['image/jpeg', 'image/png'];

                if (!allowedTypes.includes(fileType)) {
                    $('#p4').text('Invalid file type. Only JPG and PNG are allowed.');
                    isValid = false;
                }

                // Optional: Check file size (e.g., max 2MB)
                var maxSize = 2 * 1024 * 1024; // 2MB
                if (fileSize > maxSize) {
                    $('#p4').text('File size exceeds 2MB.');
                    isValid = false;
                }
            }

            if (role === '') {
                $('#p5').text('Role is required.');
                isValid = false;
            }

            // If not valid, prevent form submission
            if (!isValid) {
                e.preventDefault();
            }
        });

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    });
</script>
 <?php
        include_once "footer.php";
    ?>
       
</body>

</html>