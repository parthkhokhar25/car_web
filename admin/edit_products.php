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
                if(isset($_POST['edit_products_btn']))
                {
                    $p_id=$_POST['edit_products'];
                    $q="select * from products where p_id='$p_id'";
                    $result=mysqli_query($con,$q);
                    foreach($result as $row)
                    {
            ?>
        <form action="edit_products.php" method="post">
            <div class="mb-4">
                <label>Product id</label>
                <input type="text" readonly name="p_id" value="<?php echo $row['p_id']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Compney</label>
                <input type="text" name="car_compney" value="<?php echo $row['car_compney']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Year</label>
                <input type="text" name="car_purch_year" value="<?php echo $row['car_purch_year']?>"
                    class="form-control" />
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
                <label>Car Hestory</label>
                <input type="text" name="car_hestory" value="<?php echo $row['car_hestory']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Kms Driven</label>
                <input type="text" name="kms_driven" value="<?php echo $row['kms_driven']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Last Service</label>
                <input type="text" name="last_service" value="<?php echo $row['last_service']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Registration No</label>
                <input type="text" name="reg_no" value="<?php echo $row['reg_no']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Owner</label>
                <input type="text" name="owner" value="<?php echo $row['owner']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Fuel Type</label>
                <input type="text" name="fual_type" value="<?php echo $row['fual_type']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Type</label>
                <input type="text" name="type" value="<?php echo $row['type']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Insurence</label>
                <input type="text" name="insurance" value="<?php echo $row['insurance']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Price</label>
                <input type="text" name="price" value="<?php echo $row['price']?>" class="form-control" />
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
            $p_id=$_POST['p_id'];
            $car_compney=$_POST['car_compney'];
            $car_purch_year=$_POST['car_purch_year'];
            $car_name=$_POST['car_name'];
            $car_model=$_POST['car_model'];
            $car_hestory=$_POST['car_hestory'];
            $kms_driven=$_POST['kms_driven'];
            $last_service=$_POST['last_service'];
            $reg_no=$_POST['reg_no'];
            $owner=$_POST['owner'];
            $fual_type=$_POST['fual_type'];
            $type=$_POST['type'];
            $insurance=$_POST['insurance'];
            $price=$_POST['price'];
            $status=$_POST['status'];
            $q="update products set car_compney='$car_compney',car_purch_year='$car_purch_year',car_name='$car_name',car_model='$car_model',car_hestory='$car_hestory',kms_driven='$kms_driven',last_service='$last_service',reg_no='$reg_no',owner='$owner',fual_type='$fual_type',type='$type',insurance='$insurance',price='$price',status='$status' where p_id='$p_id'";
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
        if(isset($_POST['del_products_btn']))
        {
            $p_id=$_POST['del_products'];
            $q="delete from products where p_id='$p_id'";
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