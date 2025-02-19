<?php
  include_once "connection.php";
 session_start();
 $error_message = '';
 if(isset($_POST['btnl']))
 {
    $email = trim($_POST['em']);
    $password = trim($_POST['pwd']);
   $q="select * from user where email='".$email."' AND password='".$password."'";
   $result= mysqli_query($con,$q);
   
   $row=mysqli_fetch_assoc($result);

if ($row) {
    if ($row['role'] == "user") {
        $_SESSION['em'] = $email;
        $_SESSION['pwd'] = $password;
        $_SESSION['role'] = "user";
        header('Location:user_view.php');
    } elseif ($row['role'] == "seller") {
        $_SESSION['em'] = $email;
        $_SESSION['pwd'] = $password;
        $_SESSION['role'] = "seller";
        header('Location:seller_view.php');
    } elseif ($row['role'] == "admin") {
        $_SESSION['em'] = $email;
        $_SESSION['pwd'] = $password;
        $_SESSION['role'] = "admin";
        header('Location:admin_view.php');
    } else {
        $error_message = 'Invalid Email or Password';
    }
    exit();
} else {
    $error_message = 'Invalid Email or Password';
    
}

 } 




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

    <title>Login page</title>
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
  
    <section class="vh-100"
        style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bg.jpg');background-position:center;background-size:cover;">
        <div class="container py-2 h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="flex-grow-1 col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="young-man-giving-the-rental-car-key-to-the-consumer-3d-character-illustration-png.png"
                                    alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;height:100%;width:100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p- p-lg-5 text-black">
                                <?php if (!empty($error_message)): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="dialog">
                                            <?php echo $error_message; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                <form id="loginForm" action="login.php" method="post">


                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account</h3>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="form2Example17" name="em"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example17">Email address</label>
        
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" name="pwd"
                                                class="form-control form-control-lg" />
                                            <label class="form-label" for="form2Example27">Password</label>
                                           
                                        </div> 


                                        <div class="pt-1 mb-4">
                                            <input type="submit" value="Login"
                                                class="btn btn-outline-warning btn-lg btn-block" name="btnl">
                                        </div>
                                        <p class="mb-1 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                href="register.php" class="text-decoration-none"
                                                style="color: #393f81;">Register here</a></p>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;"><a href="forget_pwd_form.php"
                                                class="text-decoration-none" style="color: #393f81;">Forgot
                                                Password?</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var email = document.getElementById('form2Example17').value;
        var password = document.getElementById('form2Example27').value;
        var valid = true;
        var errorMsg = '';

        // Clear previous error messages
        var errorElements = document.querySelectorAll('.error');
        errorElements.forEach(function(el) {
            el.remove();
        });

        // Email validation
        if (!email) {
            errorMsg = 'Email is required.';
            valid = false;
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            errorMsg = 'Please enter a valid email address.';
            valid = false;
        }

        // Password validation
        if (!password) {
            errorMsg = 'Password is required.';
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission
            var emailField = document.getElementById('form2Example17');
            var passwordField = document.getElementById('form2Example27');
            if (errorMsg) {
                if (email === '' || !/\S+@\S+\.\S+/.test(email)) {
                    var emailError = document.createElement('div');
                    emailError.className = 'error';
                    emailError.style.color = 'red';
                    emailError.textContent = errorMsg;
                    emailField.parentElement.appendChild(emailError);
                }
                if (password === '') {
                    var passwordError = document.createElement('div');
                    passwordError.className = 'error';
                    passwordError.style.color = 'red';
                    passwordError.textContent = errorMsg;
                    passwordField.parentElement.appendChild(passwordError);
                }
            }
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() { 
        $('#loginForm').on('submit', function(event) {
            var email = $('#form2Example17').val();
            var password = $('#form2Example27').val();
            var valid = true;
            
            // Clear previous error messages
            $('.error').remove();

            // Email validation
            if (!email) {
                $('#form2Example17').after('<div class="error" style="color: red;">Email is required.</div>');
                valid = false;
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                $('#form2Example17').after('<div class="error" style="color: red;">Please enter a valid email address.</div>');
                valid = false;
            }

            // Password validation
            if (!password) {
                $('#form2Example27').after('<div class="error" style="color: red;">Password is required.</div>');
                valid = false;
            }

            if (!valid) {
                event.preventDefault(); // Prevent form submission
            }
        });
    });
</script>

<?php
    include_once "footer.php"; 
  ?>
</body>

</html>