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
        <style>
            /* edit profile picture */
            .error-message {
                color: red;
                /* Red color for error messages */
                font-size: 14px;
                margin-top: 5px;
            }

            /* change password */
            .error-message1 {
                color: red;
                font-size: 0.875em;
                display: none;
            }


            .error-border {
                /* edit profile */
                border-color: red;
                border-width: 2px;
            }


            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .accordion {
                margin: 40px 0;
            }

            .accordion .item {
                border: none;
                margin-bottom: 50px;
                background: none;
            }

            .t-p {
                padding: 40px 30px 0px 30px;
            }

            .accordion .item .item-header h2 button.btn.btn-link {
                background: #333435;
                color: white;
                border-radius: 0px;
                font-family: "Poppins";
                font-size: 16px;
                font-weight: 400;
                line-height: 2.5;
                text-decoration: none;
            }

            .accordion .item .item-header {
                border-bottom: none;
                background: transparent;
                padding: 0px;
                margin: 2px;
            }

            .accordion .item .item-header h2 button {
                color: white;
                font-size: 20px;
                padding: 15px;
                display: block;
                width: 100%;
                text-align: left;
            }

            .accordion .item .item-header h2 i {
                float: right;
                font-size: 30px;
                color: #eca300;
                background-color: black;
                width: 60px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
            }

            button.btn.btn-link.collapsed i {
                transform: rotate(0deg);
            }

            button.btn.btn-link i {
                transform: rotate(180deg);
                transition: 0.5s;
            }

            #profile {
                height: 15%;
                width: 15%;
            }

            #temp {
                text-align: center;
            }

            #product {
                height: 100%;
                width: 100%;
            }

            @media(max-width:991px) {
                #profile {
                    height: 100%;
                    width: 100%;
                }
            }
        </style>
        <title>Admin Dashboard</title>
    </head>

    <body>
        <?php
        $q = "select * from user where email='" . $_SESSION['em'] . "'";
        $result = mysqli_query($con, $q);
        $row = mysqli_fetch_array($result);
        ?>
        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="t-p">
                <div style="overflow-x:auto;">
                    <?php
                    $q = "select * from orders";
                    $result = mysqli_query($con, $q);
                    ?>
                    <table class="table table-striped">
                        <tr>
                            <th>ord_id</th>
                            <th>fname</th>
                            <th>lname</th>
                            <th>email</th>
                            <th>mobile_no</th>
                            <th>address</th>
                            <th>p_id</th>
                            <th>staus</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['ord_id']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile_no']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['p_id']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td>
                                        <form action="edit_orders.php" method="post">
                                            <input type="hidden" value="<?php echo $row['ord_id'] ?>" name="edit_orders" />
                                            <input type="submit" value="Edit" class="btn btn-secondary" name="edit_orders_btn" />
                                        </form>
                                    </td>
                                    <td>
                                        <form action="edit_orders.php" method="post">
                                            <input type="hidden" value="<?php echo $row['ord_id'] ?>" name="del_orders" />
                                            <input type="submit" value="Delete" class="btn btn-danger" name="del_orders_btn" />
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No Record Found.";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </body>

    </html>

<?php
}
?>