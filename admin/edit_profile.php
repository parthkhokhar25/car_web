<?php
    include_once "connection.php";
    ob_start();
    session_start();
?>
<?php

$error = "";
$success = "";

if (isset($_POST['btnep'])) {
    $name = trim($_POST['nm']);
    $email = trim($_POST['em']);
    
    // Validate input
    if (empty($name)) {
        $error = "Name is required.";
    } elseif (empty($email)) {
        $error = "Email is required.";
    } else {
        $q = "UPDATE user SET name='$name', email='$email' WHERE email='".$_SESSION['em']."'";
        
        if (mysqli_query($con, $q)) {
            $success = "Profile Updated Successfully!";
            // Redirect based on role after success
            if ($_SESSION['role'] == "admin") {
                echo '<script type="text/javascript">alert("'.$success.'"); window.location="../admin_view.php";</script>';
            }  else{
                echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
            }
            exit();
        } else {
            $error = "Error updating profile!";
        }
    }
    
    // Display validation errors if any
    if (!empty($error)) {
        echo '<script type="text/javascript">alert("' . htmlspecialchars($error) . '");</script>';
        // Redirect based on role after showing the error
        if ($_SESSION['role'] == "admin") {
            echo '<script type="text/javascript">alert("'.$success.'"); window.location="admin_view.php";</script>';
        } else{
            echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
        }
        exit();
    }
}
?>
<?php
    if(isset($_POST['btnepp']))
    {
        if ($_FILES['new_ppic']['name'] == "") 
        {
            echo "<script type='text/javascript'> alert('please select a profile picture')</script>";
            if ($_SESSION['role'] == "admin") {
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            }  else{
                echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
            }
            exit();
        } 
        else 
        {
            if ($_FILES['new_ppic']['size'] >= 204000) 
            {
                echo "<script type='text/javascript'> alert('please select a file with size less than 200KB')</script>";
                if ($_SESSION['role'] == "admin") {
                    echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                }  else{
                    echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                }
                exit();
            } 
            else 
            {
                if ($_FILES['new_ppic']['type'] == "image/jpeg" || $_FILES['new_ppic']['type'] == "image/png") 
                {
                    $pic_name = uniqid() . $_FILES['new_ppic']['name'];
                    move_uploaded_file($_FILES['new_ppic']['tmp_name'], "profile_pictures/" . $pic_name);
                    $q = "update user set profile='$pic_name' where email='".$_SESSION['em']."'";
                    if (mysqli_query($con,$q)) 
                    {
                        echo "<script type='text/javascript'> alert('Profile Picture Updated Successfully!')</script>";
                        if ($_SESSION['role'] == "admin") {
                            echo '<script type="text/javascript">window.location="admin_view.php";</script>';
                        } else{
                            echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                        }
                        exit();
                    } 
                    else 
                    {
                        echo $q;
                        echo "<script type='text/javascript'> alert('Errror');</script>";
                        if ($_SESSION['role'] == "admin") {
                            echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                        }  else{
                            echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                        }
                        exit();
                    }
                } 
                else 
                {
                    echo "<script type='text/javascript'> alert('please select a file jpeg or png')</script>";
                    if ($_SESSION['role'] == "admin") {
                        echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                    } else{
                        echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                    }
                    exit();
                }
            }
        }
    }
?>
<?php
    if(isset($_POST['btncp']))
    {
        $opwd=$_POST['opwd'];
        $npwd=$_POST['npwd'];
        $cnpwd=$_POST['cnpwd'];
        $q="select * from user where email='".$_SESSION['em']."'";
        $result=mysqli_query($con,$q);
        $row=mysqli_fetch_array($result);
        if($row['password']==$opwd)
        {
            if($npwd==$cnpwd)
            {
                $q1="update user set password='$npwd' where email='".$_SESSION['em']."'";
                if(mysqli_query($con,$q1))
                {
                    echo '<script type="text/javascript">alert("password changed successfully!");</script>';
                    if ($_SESSION['role'] == "admin") {
                        echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                    } 
                    else{
                        echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                    }
                    exit();
                }
                else
                {
                    echo '<script type="text/javascript">alert("error!");</script>';
                    if ($_SESSION['role'] == "admin") {
                        echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                    }  else{
                        echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                    }
                    exit();
                }
            }
            else
            {
                echo '<script type="text/javascript">alert("new password and confirm new password does not match");</script>';
                if ($_SESSION['role'] == "admin") {
                    echo '<script type="text/javascript">window.location="admin_view.php"</script>';
                }  else{
                    echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
                }
                exit();
            }
        }
        else
        {
            echo '<script type="text/javascript">alert("old password does not match with new password");</script>';
            if ($_SESSION['role'] == "admin") {
                echo '<script type="text/javascript">window.location="admin_view.php"</script>';
            } else{
                echo '<script type="text/javascript">window.location="../admin_view.php"</script>';
            }
            exit();
        }
    }
?>