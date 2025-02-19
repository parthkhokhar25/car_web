<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "admin") {
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            #msg {
                text-align: center;
                margin-top: 5%;
                margin-bottom: 8%;
                font-size: 20px;
                color: #777;
            }
        </style>
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

        <title>Admin View</title>
    </head>

    <body>

        <!-- main container -->
        <div class="container my-5">
            <!-- <p id="msg">No Notifications Yet.</p> -->
            <h2 class="text-center text-warning mb-4">ORDERS</h2>
            <?php
            $q = "select * from orders where status = 'pending'";
            $result = mysqli_query($con, $q);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <?php
                    $q1 = "select * from products where p_id = '" . $row['p_id'] . "'";
                    $result1 = mysqli_query($con, $q1);
                    $row1 = mysqli_fetch_array($result1);
                    ?>
                    <div class="card mb-4">
                        <h4 class="text-warning mx-5 mt-3"><?php echo $row1['car_compney'], " ", $row1['car_name'] ?></h4>
                        <div class="row mx-4 mb-4">
                            <div class="col-md-6 col-sm-12 my-3">
                                <img src="Product_images/<?php echo $row1['img1']; ?>" class="img-fluid">
                            </div>
                            <div class="col-md-5 col-sm-12 ms-3">
                                <br>
                                <p><b>Ordered By : </b><?php echo $row['fname'], " ", $row['lname']; ?></p>
                                <p><b>Email : </b><?php echo $row['email']; ?></p>
                                <p><b>Mobile-No : </b><?php echo $row['mobile_no']; ?></p>
                                <p><b>Address : </b><?php echo $row['address']; ?></p>
                                <p><b>Razorpay_id : </b><?php echo $row['razorpay_order_id']; ?></p>
                                <p><b>Transaction_id : </b><?php echo $row['transaction_id']; ?></p>
                                <p><b>Payment Status : </b><?php echo $row['payment_status']; ?></p>
                                <p><b>amount : </b><?php echo $row['amount']; ?></p>
                                <form action="../confirm_order.php" method="post" class="mt-3">
                                    <input type="hidden" name="id" value="<?php echo $row['p_id']; ?>">
                                    <input type="submit" class="btn btn-outline-success mt-4" value="Confirm" name="cnf_btn">&nbsp;
                                    <input type="submit" class="btn btn-outline-danger mt-4" value="Decline" name="dec_btn">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p id="msg">No Orders Yet.</p>
            <?php
            }
            ?>
        </div>
        <div class="container my-5">
            <!-- <p id="msg">No Notifications Yet.</p> -->
            <h2 class="text-center text-warning mb-4">SELLER</h2>
            <?php
            $q = "select * from seller where status = 'pending'";
            $result = mysqli_query($con, $q);
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="card mb-4">
                        <h3 class="text-warning mx-5 mt-3"><?php echo $row['car_compney'], " ", $row['car_name'] ?></h3>
                        <div class="row mx-4 mb-4">
                            <div class="col-md-3 col-sm-12 my-3">
                                <img src="Product_images/<?php echo $row['img1']; ?>" class="img-fluid mt-4">
                                <img src="Product_images/<?php echo $row['document']; ?>" class="img-fluid mt-3">
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div style="border:none;overflow-x:auto;">
                                    <table class="table table-hover mt-3" style="cursor:pointer;">
                                        <tr>
                                            <td><img src="https://www.cars24.com/js/c244f7e76abe7b4d9e3800a16ab79ce2.svg"></td>
                                            <td><label>History</label></td>
                                            <td><label>Non-Accidental</label></td>
                                            <td><img src="https://www.cars24.com/js/31aad21a7cefa87a350b7f33f1728075.svg"></td>
                                            <td><label>Owner</label></td>
                                            <td><label><?php echo $row['owner']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://www.cars24.com/js/e3a50ff3d7dabe4486ebe3abd088fd57.svg"></td>
                                            <td><label>Kilometers Driven</label></td>
                                            <td><label><?php echo $row['kms_driven']; ?></label></td>
                                            <td><img src="https://www.cars24.com/js/cbbaf45f2d2f91ddf9f1b5d98eb8303e.svg"></td>
                                            <td><label>Fuel Type</label></td>
                                            <td><label><?php echo $row['fual_type']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://www.cars24.com/js/9e1dd1e3c17bcc3f7e05a7e8b572b3fc.svg"></td>
                                            <td><label>Last Service</label></td>
                                            <td><label><?php echo $row['kms_driven'] ?>(13 Nov 2021)</label></td>
                                            <td><img src="https://www.cars24.com/js/79ad45566630b92b7d80c9a388f70aef.svg"></td>
                                            <td><label>Transmission</label></td>
                                            <td><label><?php echo $row['type']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://www.cars24.com/js/7a9e42d67e964d25b648dcb59297975c.svg"></td>
                                            <td><label>Registration</label></td>
                                            <td><label><?php echo $row['reg_no']; ?></label></td>
                                            <td><img src="https://www.cars24.com/js/a0a1560d73c5174bceb87f81debca7c0.svg"></td>
                                            <td><label>Insurance</label></td>
                                            <td><label><?php echo $row['insurance']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><img src="https://www.cars24.com/js/f8a3bec1d206e4a415212e6512d3cdfc.svg"></td>
                                            <td><label>Year of Purchase</label></td>
                                            <td><label><?php echo $row['car_purch_year']; ?></label></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                                <form action="confirm_seller.php" method="post" class="mt-3">
                                    <input type="hidden" name="id" value="<?php echo $row['seller_id']; ?>">
                                    <input type="text" name="price" required class="form-control" placeholder="Give Price To Seller" />
                                    <input type="submit" class="btn btn-outline-success mt-4" value="Confirm" name="cnf_btn">&nbsp;
                                    <input type="submit" class="btn btn-outline-danger mt-4" value="Decline" name="dec_btn">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p id="msg">No Sellers Yet.</p>
            <?php
            }
            ?>
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
    </body>

    </html>
<?php
} else {
    header("location:login.php");
}
?>