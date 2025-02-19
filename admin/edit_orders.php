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
                if(isset($_POST['edit_orders_btn']))
                {
                    $ord_id=$_POST['edit_orders'];
                    $q="select * from orders where ord_id='$ord_id'";
                    $result=mysqli_query($con,$q);
                    foreach($result as $row)
                    {
            ?>
        <form action="edit_orders.php" method="post">
            <div class="mb-4">
                <label>Order id</label>
                <input type="text" readonly name="ord_id" value="<?php echo $row['ord_id']?>" class="form-control" />
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
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $row['email']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Mobile No</label>
                <input type="text" name="mno" value="<?php echo $row['mobile_no']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $row['address']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Status</label>
                <input type="text" name="status" value="<?php echo $row['status']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <label>Product id</label>
                <input type="text" readonly name="p_id" value="<?php echo $row['p_id']?>" class="form-control" />
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
            $ord_id=$_POST['ord_id'];
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $email=$_POST['email'];
            $mno=$_POST['mno'];
            $address=$_POST['address'];
            $p_id=$_POST['p_id'];
            $status=$_POST['status'];
            $q="UPDATE `orders` SET `fname`='".$fname."',`lname`='".$lname."',`email`='".$email."',`mobile_no`='".$mno."',`address`='".$address."',`status`='".$status."' where ord_id='$ord_id'";
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
        if(isset($_POST['del_orders_btn']))
        {
            $ord_id=$_POST['del_orders'];
            $q="delete from orders where ord_id='$ord_id'";
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