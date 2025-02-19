<?php
include_once "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $car_id = intval($_POST['id']);

    // Delete query
    $deleteQuery = "DELETE FROM products WHERE p_id = $car_id";
    if ($con->query($deleteQuery) === TRUE) {
        // Redirect to the main page after deletion
        header("Location: totalListed_car.php");
        exit();
    } else {
        echo "Error deleting record: " . $con->error;
    }

    // Close the connection
    $con->close();
}
?>
