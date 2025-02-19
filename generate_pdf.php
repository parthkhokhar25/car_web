<?php
// generate_pdf.php
include_once 'connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'vendor/fpdf/fpdf.php';  // Include FPDF
function generateBookingPDF($orderDetails) {
    $razorpayOrderId = $orderDetails['razorpay_order_id'];
    $userEmail = $orderDetails['email'];
    $p_id = $orderDetails['p_id'];
    $fname = $orderDetails['fname'];
    $lname = $orderDetails['lname'];
    $mno = $orderDetails['mno'];
    $address = $orderDetails['address'];
    $amount = $orderDetails['amount'];

    // Remove the ₹ symbol and format the amount (integer without decimals)
    $formattedAmount = number_format($amount, 0); // Format amount to display only the integer part

    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(200, 10, 'Booking Confirmation', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Thank you for your booking!', 0, 1);
    $pdf->Cell(0, 10, 'Booking ID: ' . $razorpayOrderId, 0, 1);
    $pdf->Cell(0, 10, 'Payment Status: Paid', 0, 1);
    $pdf->Cell(0, 10, 'Email: ' . $userEmail, 0, 1);
    $pdf->Cell(0, 10, 'Product/Order ID: ' . $p_id, 0, 1);
    $pdf->Cell(0, 10, 'First Name: ' . $fname, 0, 1);
    $pdf->Cell(0, 10, 'Last Name: ' . $lname, 0, 1);
    $pdf->Cell(0, 10, 'Mobile No: ' . $mno, 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
    $pdf->Cell(0, 10, 'Amount Paid (rs) : '. $formattedAmount, 0, 1);


    // Set the path to save the PDF
    $pdfDirectory = 'pdfs/';
    if (!file_exists($pdfDirectory)) {
        mkdir($pdfDirectory, 0777, true); // Create the directory if it doesn't exist
    }

    // Set the file name and save the PDF
    $pdfFileName = 'booking_' . $razorpayOrderId . '.pdf';
    $pdfFilePath = $pdfDirectory . $pdfFileName;

    // Output the PDF to the file
    $pdf->Output('F', $pdfFilePath);  // 'F' to save to a file, not output to the browser

    return $pdfFileName;
}


?>
