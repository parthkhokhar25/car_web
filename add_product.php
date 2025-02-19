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
    <title>Add Product</title>
</head>

<body>
    <?php
            $q="select * from user where email='".$_SESSION['em']."'";
            $result=mysqli_query($con,$q);
            $row=mysqli_fetch_array($result);
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
                        <a class="nav-link" aria-current="page" href="admin_view.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="add_product.php" style="color:#ffcb3d;">Add Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="notification.php">Notification</a>
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
                    <form action="edit_profile.php" method="post">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" name="nm" class="form-control" value="<?php echo $row['name'];?>">
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


    <!-- main container -->
    <!-- <Section class="vh-100" style="background-image:url('bag.jpg');background-position:center;background-size:contain;"> -->
    <Section class="h-100 h-custom"
        style="background-image:linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)),url('bag.jpg');min-height:100vh;width:100%;background-position:center;background-size:cover;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="mx-2 mb-4" style="color:#ffcb3d;">Add Product</h2>
                            <form class="px-md-2" action="add_product.php" method="post" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Compony</label>
                                            <input type="text" required name="car_compney"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Purchase Year</label>
                                            <input type="text" required name="car_purch_year"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Name</label>
                                            <input type="text" required name="car_name"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Car Model</label>
                                            <input type="text" required name="car_model"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Hestory</label>
                                            <input type="text" required name="car_hestory"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">KMS Driven</label>
                                            <input type="text" required name="kms_driven"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Last Service</label>
                                            <input type="text" required name="last_service"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Registration No</label>
                                            <input type="text" required name="reg_no"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Owner</label>
                                            <input type="text" required name="owner"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Fual Type</label>
                                            <input type="text" required name="fual_type"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Type</label>
                                            <input type="text" required name="type"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Insurance</label>
                                            <input type="textarea" required name="insurance"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Price</label>
                                            <input type="text" required name="price"
                                                class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Image</label>
                                            <input type="file" name="img1" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Car Image Angle-1</label>
                                            <input type="file" name="img2" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Image Angle-2</label>
                                            <input type="file" name="img3" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Car Image Angle-3</label>
                                            <input type="file" name="img4" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="firstName">Car Interior Image</label>
                                            <input type="file" name="img5" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                    <div class="col-md-12 mb-4">

                                        <div class="form-outline">
                                            <label class="form-label" for="lastName">Car Speedometer Image</label>
                                            <input type="file" name="img6" class="form-control form-control-md" />
                                        </div>

                                    </div>
                                </div>


                                <input type="submit" value="add product" name="btna"
                                    class="btn btn-outline-warning btn-lg" />

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Section>

    <div>

        <?php
        include_once ("footer.php");
        ?>
    </div>
    <!-- insert into products table -->
    <?php
        if (isset($_POST['btna'])) {
            $car_compney = $_POST['car_compney'];
            $car_purch_year = $_POST['car_purch_year'];
            $car_name = $_POST['car_name'];
            $car_model = $_POST['car_model'];
            $car_hestory = $_POST['car_hestory'];
            $kms_driven = $_POST['kms_driven'];
            $last_service = $_POST['last_service'];
            $reg_no = $_POST['reg_no'];
            $owner = $_POST['owner'];
            $fual_type = $_POST['fual_type'];
            $type = $_POST['type'];
            $insurance = $_POST['insurance'];
            $price = $_POST['price'];

            if ($_FILES['img1']['name'] == "" && $_FILES['img2']['name'] == "" && $_FILES['img3']['name'] == "" && $_FILES['img4']['name'] == "" && $_FILES['img5']['name'] == "" && $_FILES['img6']['name'] == "") {
                echo "<script type='text/javascript'> alert('please select a file');";
                echo "window.location='add_product.php';</script>";
            } else {
                if ($_FILES['img1']['size'] >= 204000 && $_FILES['img2']['size'] >= 204000 && $_FILES['img3']['size'] >= 204000 && $_FILES['img4']['size'] >= 204000 && $_FILES['img5']['size'] >= 204000 && $_FILES['img6']['size'] >= 204000) {
                    echo "<script type='text/javascript'> alert('please select a file with size less than 200KB');";
                    echo "window.location='add_product.php';</script>";
                } else {
                    if ($_FILES['img1']['type'] == "image/jpeg" || $_FILES['img1']['type'] == "image/png" && $_FILES['img2']['type'] == "image/jpeg" || $_FILES['img2']['type'] == "image/png" && $_FILES['img3']['type'] == "image/jpeg" || $_FILES['img3']['type'] == "image/png" && $_FILES['img4']['type'] == "image/jpeg" || $_FILES['img4']['type'] == "image/png" && $_FILES['img5']['type'] == "image/jpeg" || $_FILES['img5']['type'] == "image/png" && $_FILES['img6']['type'] == "image/jpeg" || $_FILES['img6']['type'] == "image/png") {
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
                        $q = "INSERT INTO `products`(`p_id`, `car_compney`, `car_purch_year`, `car_name`, `car_model`, `car_hestory`, `kms_driven`, `last_service`, `reg_no`, `owner`, `fual_type`, `type`, `insurance`, `price`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `status`) VALUES ('','$car_compney','$car_purch_year','$car_name','$car_model','$car_hestory','$kms_driven','$last_service','$reg_no','$owner','$fual_type','$type','$insurance','$price','$img1','$img2','$img3','$img4','$img5','$img6','onsall')";
                        if (mysqli_query($con, $q)) {
                            echo "<script type='text/javascript'> alert('Product Added Successfully!');";
                            echo "window.location='add_product.php';</script>";
                        } else {
                            echo $q;
                            echo "<script type='text/javascript'> alert('Errror in Addong Product!');";
                            echo "window.location='add_product.php';</script>";
                        }
                    } else {
                        echo "<script type='text/javascript'> alert('please select a file jpeg or png');";
                        echo "window.location='add_product.php';</script>";
                    }
                }
            }
        }
        ?>
</body>

</html>

<?php
} else {
    header("location:login.php");
}
?>