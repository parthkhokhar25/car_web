<?php
session_start();
include_once "connection.php"; // Ensure DB connection is established
require 'vendor/autoload.php';
include 'generate_pdf.php'; // Include the separate PDF generation file

use Razorpay\Api\Api;

$keyId = "rzp_test_khmkAgVH3KxnA3";
$keySecret = "a695cyPFkkgIlryjyHPQzIe5";
$api = new Api($keyId, $keySecret);

$alertType = '';
$alertMessage = '';
$pdfFileName = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $razorpayPaymentId = $_POST['razorpay_payment_id'];
    $razorpayOrderId = $_POST['razorpay_order_id'];
    $razorpaySignature = $_POST['razorpay_signature'];
    $p_id = $_POST['p_id'];

    // Step 1: Check if the order already exists and if payment has already been made
    $checkOrderQuery = "SELECT * FROM orders WHERE (razorpay_order_id = '$razorpayOrderId' OR transaction_id = '$razorpayPaymentId') AND p_id = '$p_id'";
    $orderResult = mysqli_query($con, $checkOrderQuery);
    
    if (mysqli_num_rows($orderResult) > 0) {
        // Order already exists, fetch order details
        $order = mysqli_fetch_assoc($orderResult);
        $fname = $order['fname'];
        $lname = $order['lname'];
        $email = $order['email'];
        $mno = $order['mobile_no'];
        $address = $order['address'];
        $token_amount = $order['amount'];

        // Step 2: Verify the payment signature
        try {
            $attributes = [
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature
            ];

            // Verify the payment signature with Razorpay
            $api->utility->verifyPaymentSignature($attributes);

            // Step 3: Update the database with payment success
            $updateQuery = "UPDATE orders SET payment_status = 'Paid', transaction_id = '$razorpayPaymentId' WHERE razorpay_order_id = '$razorpayOrderId' AND p_id = '$p_id'";

            if (mysqli_query($con, $updateQuery)) {
                $alertType = "success";
                $alertMessage = "Payment successful! Order status has been updated.";

                $_SESSION['email'] = $email;

                // Generate PDF after successful payment
                $orderDetails = [
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'mno' => $mno,
                    'address' => $address,
                    'amount' => $token_amount,
                    'p_id' => $p_id,
                    'razorpay_order_id' => $razorpayOrderId
                ];
                $pdfFileName = generateBookingPDF($orderDetails);  // Generate the PDF
                $_SESSION['pdf_file'] = $pdfFileName;  // Store PDF filename in session
            } else {
                $alertType = "danger";
                $alertMessage = "Error updating the order: " . mysqli_error($con);
            }

        } catch (Exception $e) {
            $alertType = "danger";
            $alertMessage = "Payment verification failed: " . $e->getMessage();
        }
    } else {
        // Handle order not found
        $alertType = "danger";
        $alertMessage = "Order not found!";
    }
} else {
    header("location: index.php");
    exit();
}


// Generate the HTML alert and modal based on the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($alertType && $alertMessage): ?>
            <!-- Bootstrap Alert for Payment Status -->
            <div class="alert alert-<?= $alertType ?> alert-dismissible fade show" role="alert">
                <strong><?= $alertMessage ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Modal for Payment Success -->
        <?php if ($alertType == "success"): ?>
            <div class="modal fade" id="paymentSuccessModal" tabindex="-1" aria-labelledby="paymentSuccessModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentSuccessModalLabel">Payment Successful</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Your payment was successful. You can now download the booking confirmation PDF.
                        </div>
                        <div class="modal-footer">
                            <a href="pdfs/<?= $pdfFileName ?>" class="btn btn-primary" download>Download PDF</a>
                            <button type="button" class="btn btn-secondary" id="closeModalBtn" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Trigger the modal
                    var myModal = new bootstrap.Modal(document.getElementById('paymentSuccessModal'));
                    myModal.show();

                    // Redirect user to user_view.php after closing the modal
                    var closeModalBtn = document.getElementById('closeModalBtn');
                    closeModalBtn.addEventListener('click', function() {
                        window.location.href = 'user_view.php';  // Redirect to user_view.php
                    });
                });
            </script>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
