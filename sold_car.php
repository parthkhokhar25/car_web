<?php
// Database connection
include_once "connection.php";

// Fetch all car details
$sql = "SELECT * FROM products WHERE status = 'sold'";
$result = mysqli_query($con, $sql);

// Check if any cars are found
$cars = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cars[] = $row; // Store each row in the cars array
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Sold</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Cars Sold</h1>
        <div class="row">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php
                            // Determine the image source
                            $image_src = (filter_var($car['img1'], FILTER_VALIDATE_URL)) ? htmlspecialchars($car['img1']) : htmlspecialchars('Product_images/' . $car['img1']);
                            ?>
                            <img src="<?php echo $image_src; ?>" class="card-img-top" alt="Car Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($car['car_compney']); ?></h5>
                                <span class="badge badge-primary">SOLD</span>
                                <p class="card-text mt-2">
                                    <strong>Price:</strong> ₹<?php echo $car['price']; ?><br>
                                    <strong>Year:</strong> <?php echo htmlspecialchars($car['car_purch_year']); ?><br>
                                    <strong>Make:</strong> <?php echo htmlspecialchars($car['car_name']); ?><br>
                                    <strong>Model:</strong> <?php echo htmlspecialchars($car['car_model']); ?><br>
                                    <strong>KMs Driven:</strong> <?php echo htmlspecialchars($car['kms_driven']); ?><br>
                                   
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <p>No cars found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
