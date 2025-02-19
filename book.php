<?php
session_start();
include_once "connection.php";

// Razorpay Configuration
$keyId = "rzp_test_khmkAgVH3KxnA3";
$keySecret = "a695cyPFkkgIlryjyHPQzIe5";

require 'vendor/autoload.php'; // Razorpay PHP SDK
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

// Check if the user is logged in
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "user") {
    $email = $_SESSION['em'];
    $user_query = "SELECT name FROM user WHERE email='$email'";
    $user_result = mysqli_query($con, $user_query);
    $username = "Guest";
    if (mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $username = $user_row['name'];
    }

    // Fetch product details
    if (isset($_GET['pid'])) {
        $p_id = $_GET['pid'];

        // Check if the user has already placed an order for this car and the payment status is 'Pending' or 'Paid'
        $check_order_query = "SELECT * FROM orders WHERE p_id='$p_id' AND email='$email' AND (payment_status='Pending' OR payment_status='Paid')";
        $order_result = mysqli_query($con, $check_order_query);

        if (mysqli_num_rows($order_result) > 0) {
            $order = mysqli_fetch_assoc($order_result);
            $payment_status = $order['payment_status'];

            // If the order is already placed and payment status is 'Paid', show message
            if ($payment_status == 'Paid') {
                $order_exists = true;
                $order_message = "Your order has been successfully placed and paid. You do not need to make another payment.";
            } else {
                // If payment status is 'Pending', show a different message
                $order_exists = true;
                $order_message = "Order already placed! You have already booked a token for this car. Please wait for the payment process to complete.";
            }
        } else {
            // Fetch car details from products table if no previous order exists
            $q = "SELECT * FROM products WHERE p_id='$p_id'";
            $result = mysqli_query($con, $q);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $car_company = $row['car_compney'];
                $car_name = $row['car_name'];
                $car_image = $row['img1'];
                $price = $row['price'];
                $token_amount = (float)$price * 100000 / 100; // Token amount calculation

                // Create Razorpay order
                $orderData = [
                    'receipt' => "receipt_{$p_id}",
                    'amount' => $token_amount * 100, // Amount in paise
                    'currency' => 'INR',
                    'payment_capture' => 1,
                ];
                $razorpayOrder = $api->order->create($orderData);
                $razorpayOrderId = $razorpayOrder['id'];

                if (isset($_GET['btn_cof'])) {
                    // Collect the user details for the order
                    $fname = $_GET['fname'];
                    $lname = $_GET['lname'];
                    $email = $_GET['email'];
                    $mno = $_GET['mno'];
                    $address = $_GET['addres'];

                    // Store the order details in session
                    $_SESSION['order_details'] = [
                        'fname' => $fname,
                        'lname' => $lname,
                        'email' => $email,
                        'mno' => $mno,
                        'address' => $address,
                        'amount' => $token_amount,
                        'p_id' => $p_id,
                        'razorpay_order_id' => $razorpayOrderId
                    ];

                    // Insert the order details into the database if no order exists
                    if (!isset($order_exists) || !$order_exists) {
                        $orderQuery = "INSERT INTO orders (fname, lname, email, mobile_no, address, p_id, status ,razorpay_order_id, payment_status, amount) 
                        VALUES ('$fname', '$lname', '$email', '$mno', '$address', '$p_id', 'pending', '$razorpayOrderId', 'Pending', '$token_amount')";
                        mysqli_query($con, $orderQuery);
                    }
                }

                // Set flag to indicate payment process can proceed
                $order_exists = false;
            } else {
                echo "<p>Car details not found.</p>";
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Token</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .card {
            margin-top: 30px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        .card-title {
            font-size: 1.5rem;
        }
        .card-text {
            font-size: 1.1rem;
        }
        .price-text {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <?php if (isset($order_exists) && $order_exists): ?>
                <!-- Bootstrap Modal for Order Already Placed -->
                <div class="alert alert-warning text-center">
                    <strong><?php echo $order_message; ?></strong>
                </div>
            <?php else: ?>
                <!-- Bootstrap Card for Product Details and Razorpay Payment Button -->
                <div class="card shadow-lg border-light">
                    <img src="Product_images/<?php echo $car_image; ?>" class="card-img-top" alt="Car Image">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?php echo $car_company . ' ' . $car_name; ?></h5>
                        <p class="card-text text-center">Book a token for your next dream car! Secure your spot with a token payment.</p>
                        <div class="d-flex justify-content-center">
                            <div class="price-text mr-3">Price: ₹<?php echo $price; ?></div>
                            <div class="price-text text-success">Token Amount: ₹<?php echo $token_amount; ?></div>
                        </div>
                        <p class="card-text text-muted text-center mt-2">This token guarantees your booking, and the amount will be adjusted in the final payment.</p>
                        <!-- Disable the button if order already exists -->
                        <button id="rzp-button" class="btn btn-custom btn-block" 
                            <?php echo isset($order_exists) && $order_exists ? 'disabled' : ''; ?> >
                            Pay ₹<?php echo $token_amount; ?>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Razorpay Checkout Script -->
<script>
    const options = {
        "key": "<?php echo $keyId; ?>",
        "order_id": "<?php echo isset($razorpayOrderId) ? $razorpayOrderId : ''; ?>",
        "amount": "<?php echo isset($token_amount) ? $token_amount * 100 : ''; ?>", // Amount in paise
        "currency": "INR",
        "name": "<?php echo $username; ?>",
        "description": "<?php echo $car_company . ' ' . $car_name; ?>",
        "handler": function (response) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'process_payment.php';
            form.innerHTML = ` 
                <input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">
                <input type="hidden" name="razorpay_order_id" value="${response.razorpay_order_id}">
                <input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">
                <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    };

    const rzp = new Razorpay(options);
    document.getElementById('rzp-button').onclick = function (e) {
        rzp.open();
        e.preventDefault();
    };
</script>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
