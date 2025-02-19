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
    <title>Edit user table</title>
</head>

<body>
    <div class="container mt-5">
        <?php
                if(isset($_POST['edit_user_btn']))
                {
                    $uid=$_POST['edit_user'];
                    $q="select * from user where uid='$uid'";
                    $result=mysqli_query($con,$q);
                    foreach($result as $row)
                    {
            ?>
        <form action="edit_user.php" method="post">
            <div class="mb-4">
                <input type="text" readonly name="id" value="<?php echo $row['uid']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" name="nm" value="<?php echo $row['name']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" name="em" value="<?php echo $row['email']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" name="pwd" value="<?php echo $row['password']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" name="role" value="<?php echo $row['role']?>" class="form-control" />
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
<!-- edit data from user Table -->
<?php
        if(isset($_POST['btne']))
        {
            $uid=$_POST['id'];
            $name=$_POST['nm'];
            $email=$_POST['em'];
            $password=$_POST['pwd'];
            $role=$_POST['role'];
            $q="update user set name='$name',email='$email',password='$password',role='$role' where uid='$uid'";
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
        if(isset($_POST['del_user_btn']))
        {
            $uid=$_POST['del_user'];
            $q="delete from user where uid='$uid'";
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