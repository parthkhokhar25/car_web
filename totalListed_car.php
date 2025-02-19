<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Total Cars Listed: 
            <?php
                include_once "connection.php";

                // Query to get all cars
                $result = $con->query("SELECT * FROM products");
                $totalCars = $result->num_rows; // Get total number of cars
                echo $totalCars;
            ?>
        </h1>

        <div class="row">
            <?php
                // Query to get all cars
                $result = $con->query("SELECT * FROM products");
                while ($car = $result->fetch_assoc()) {
                    // Determine the image path
                    $imagePath = $car['img2'];
                    if (strpos($imagePath, 'http') === false) {
                        $imagePath = 'Product_images/' . $imagePath; // Local path
                    }
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Car Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($car['car_purch_year'] . ' ' . $car['car_compney'] . ' ' . $car['car_model']); ?></h5>
                        <p class="card-text">
                            <strong>Price:</strong> ₹<?php echo $car['price']; ?><br>
                            <strong>Car Purchase Year:</strong> <?php echo htmlspecialchars($car['car_purch_year']); ?><br>
                            <strong>Make:</strong> <?php echo htmlspecialchars($car['car_compney']); ?><br>
                            <strong>Model:</strong> <?php echo htmlspecialchars($car['car_model']); ?><br>
                            <strong>KMs Driven:</strong> <?php echo htmlspecialchars($car['kms_driven']); ?><br>
                            <strong>Status:</strong> <?php echo htmlspecialchars($car['status']); ?><br>
                            <strong>Owner:</strong> <?php echo htmlspecialchars($car['owner']); ?><br>
                            <strong>Fuel Type:</strong> <?php echo htmlspecialchars($car['fual_type']); ?><br>
                            <strong>Insurance:</strong> <?php echo htmlspecialchars($car['insurance']); ?><br>
                            <strong>Car History:</strong> <?php echo htmlspecialchars($car['car_hestory']); ?><br>
                            <strong>Last Service:</strong> <?php echo htmlspecialchars($car['last_service']); ?><br>
                            <strong>Registration Number:</strong> <?php echo htmlspecialchars($car['reg_no']); ?><br>
                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="update_car.php?id=<?php echo $car['p_id']; ?>" name="update" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" 
    data-id="<?php echo $car['p_id']; ?>" 
    data-car="<?php echo htmlspecialchars($car['car_purch_year'] . ' ' . $car['car_compney'] . ' ' . $car['car_model']); ?>">
    Delete
</button>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
                // Close the connection
                $con->close();
            ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the car <strong id="carName"></strong>?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="delete_car.php">
                    <input type="hidden" name="id" id="deleteCarId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var carId = button.data('id'); // Extract the car ID
        var carTitle = button.data('car'); // Extract the car's full title (year, company, model)

        var modal = $(this);
        modal.find('#carName').text(carTitle); // Update the car name in the modal
        modal.find('#deleteCarId').val(carId); // Set the car ID in the hidden input
    });
</script>

</body>
</html>
