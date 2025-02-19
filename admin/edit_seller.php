<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "admin") 
{
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
    <title>Edit roducts table</title>
</head>

<body>
    <div class="container mt-5 mb-5">
        <?php
                if(isset($_POST['edit_seller_btn']))
                {
                    $seller_id=$_POST['edit_seller'];
                    $q="select * from seller where seller_id='$seller_id'";
                    $result=mysqli_query($con,$q);
                    foreach($result as $row)
                    {
            ?>
        <form action="edit_seller.php" method="post">
            <div class="mb-4">
                <label>Seller id</label>
                <input type="text" readonly name="seller_id" value="<?php echo $row['seller_id']?>"
                    class="form-control" />
            </div>
            <div class="mb-4">
                <label>First name</label>
                <input type="text" name="fname" value="<?php echo $row['fname']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Last name</label>
                <input type="text" name="lname" value="<?php echo $row['lname']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Car Compney</label>
                <input type="text" name="car_compney" value="<?php echo $row['car_compney']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Car Name</label>
                <input type="text" name="car_name" value="<?php echo $row['car_name']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Car Model</label>
                <input type="text" name="car_model" value="<?php echo $row['car_model']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Fual Type</label>
                <input type="text" name="fual_type" value="<?php echo $row['fual_type']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Kms Driven</label>
                <input type="text" name="kms_driven" value="<?php echo $row['kms_driven']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Owner</label>
                <input type="text" name="owner" value="<?php echo $row['owner']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Registration No</label>
                <input type="text" name="reg_no" value="<?php echo $row['reg_no']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Type</label>
                <input type="text" name="type" value="<?php echo $row['type']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Car Purchase Year</label>
                <input type="text" name="car_purch_year" value="<?php echo $row['car_purch_year']?>"
                    class="form-control" />
            </div>
            <div class="mb-4">
                <label>Indurance</label>
                <input type="text" name="insurance" value="<?php echo $row['insurance']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Mobile No</label>
                <input type="text" name="mno" value="<?php echo $row['mobile_no']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $row['email']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Status</label>
                <input type="text" name="status" value="<?php echo $row['status']?>" class="form-control" />
            </div>

            <a href="admin_view.php" class="btn btn-danger">Cancle</a>
            <input type="submit" value="Update" name="btne" class="btn btn-secondary" />
        </form>
        <?php
                    }
                }
            ?>
    </div>
</body>
<!-- edit data from contact Table -->
<?php
        if(isset($_POST['btne']))
        {
            $seller_id=$_POST['seller_id'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $car_compney=$_POST['car_compney'];
            $car_purch_year=$_POST['car_purch_year'];
            $car_name=$_POST['car_name'];
            $car_model=$_POST['car_model'];
            $kms_driven=$_POST['kms_driven'];
            $reg_no=$_POST['reg_no'];
            $owner=$_POST['owner'];
            $fual_type=$_POST['fual_type'];
            $type=$_POST['type'];
            $insurance=$_POST['insurance'];
            $email=$_POST['email'];
            $mno=$_POST['mno'];
            $status=$_POST['status'];
            $q="update seller set car_compney='$car_compney',car_purch_year='$car_purch_year',car_name='$car_name',car_model='$car_model',kms_driven='$kms_driven',reg_no='$reg_no',owner='$owner',fual_type='$fual_type',type='$type',insurance='$insurance',status='$status',fname='$fname',lname='$lname',email='$email',mobile_no='$mno' where seller_id='$seller_id'";
            if(mysqli_query($con,$q))
            {
                echo '<script type="text/javascript">alert("Data Edited Successfull!")</script>';
                echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Data is not Edited!")</script>';
            }
        }
    ?>

<!-- delete data from user Table -->
<?php
        if(isset($_POST['del_seller_btn']))
        {
            $seller_id=$_POST['del_seller'];
            $q="delete from seller where seller_id='$seller_id'";
            if(mysqli_query($con,$q))
            {
                echo '<script type="text/javascript">alert("Data Deleted Successfully!")</script>';
                echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
            }
            else
            {
                echo '<script type="text/javascript">alert("Data is not Deleted!")</script>';
            }
        }
    ?>

</html>
<?php
} 
else 
{
    header("location:login.php");
}
?>