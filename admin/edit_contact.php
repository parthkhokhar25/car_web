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
    <title>Edit contact table</title>
</head>

<body>
    <div class="container mt-5">
        <?php
                if(isset($_POST['edit_contact_btn']))
                {
                    $email=$_POST['edit_contact'];
                    $q="select * from contact where email='$email'";
                    $result=mysqli_query($con,$q);
                    foreach($result as $row)
                    {
            ?>
        <form action="edit_contact.php" method="post">
            <div class="mb-4">
                <input type="text" name="nm" value="<?php echo $row['name']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" readonly name="em" value="<?php echo $row['email']?>" class="form-control" />
            </div>
            <div class="mb-4">
                <input type="text" name="msg" value="<?php echo $row['message']?>" class="form-control" />
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
            $name=$_POST['nm'];
            $email=$_POST['em'];
            $massage=$_POST['msg'];
            $q="update contact set name='$name',message='$massage' where email='$email'";
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
        if(isset($_POST['del_contact_btn']))
        {
            $email=$_POST['del_contact'];
            $q="delete from contact where email='$email'";
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