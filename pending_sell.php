<?php
// Database connection
include_once "connection.php";

// Fetch pending sale details with a join
$sql = "SELECT o.*, p.img1, p.car_compney, p.price, p.car_purch_year, p.car_name, p.car_model, p.kms_driven
        FROM orders o 
        JOIN products p ON o.p_id = p.p_id 
        WHERE o.status = 'pending'"; // Ensure correct spelling of 'pending'
$result = mysqli_query($con, $sql);

// Check if any sales are found
$sales = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row; // Store each row in the sales array
    }
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Sales</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .buyer-info {
            background-color: #f8f9fa;
            /* Light gray background */
            border: 1px solid #ddd;
            /* Light border */
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .buyer-info h3 {
            margin-bottom: 10px;
        }

        .badge-warning {
            background-color: #ffc107;
            /* Bootstrap warning color */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Pending Sales</h1>
        <div class="row">
            <?php if (!empty($sales)) : ?>
                <?php foreach ($sales as $sale) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php
                            // Determine the image source
                            $image_src = (filter_var($sale['img1'], FILTER_VALIDATE_URL)) ? htmlspecialchars($sale['img1']) : htmlspecialchars('Product_images/' . $sale['img1']);
                            ?>
                            <img src="<?php echo $image_src; ?>" class="card-img-top" alt="Car Image">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlspecialchars($sale['car_compney']); ?></h2>
                                <span class="badge badge-warning">PENDING SALE</span>
                                <p class="card-text mt-2">
                                    <strong>Price:</strong> ₹<?php echo $sale['price']; ?><br>
                                    <strong>Year:</strong> <?php echo htmlspecialchars($sale['car_purch_year']); ?><br>
                                    <strong>Make:</strong> <?php echo htmlspecialchars($sale['car_name']); ?><br>
                                    <strong>Model:</strong> <?php echo htmlspecialchars($sale['car_model']); ?><br>
                                    <strong>KMs Driven:</strong> <?php echo htmlspecialchars($sale['kms_driven']); ?><br>
                                </p>
                                <div class="mt-4">
                                    <div class="buyer-info">
                                        <h3>Buyer Information</h3>
                                        <p><strong>Name:</strong> <?php echo htmlspecialchars($sale['fname']) . ' ' . htmlspecialchars($sale['lname']); ?></p>
                                        <p><strong>Email:</strong> <?php echo htmlspecialchars($sale['email']); ?></p>
                                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($sale['mobile_no']); ?></p>
                                    </div>
                                </div>
                                <p><strong>Sale Status:</strong> Pending</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-md-12">
                    <p>No pending sales found.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>