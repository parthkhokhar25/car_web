<?php
include_once "connection.php"; // Include database connection

// Check if ID is set in the URL and fetch car details for the given ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $con->query("SELECT * FROM products WHERE p_id = $id");

    if ($result->num_rows > 0) {
        $car = $result->fetch_assoc();
    } else {
        echo "Car not found!";
        exit();
    }
}

// If form is submitted, update car details
if (isset($_POST['update'])) {
    $kms_driven = str_replace(['km', ',', ' '], '', $_POST['kms_driven']);
    $price = str_replace(',', '', $_POST['price']); // Remove commas from price input
    $car_purch_year = $_POST['car_purch_year'];
    $car_compney = $_POST['car_compney'];
    $car_model = $_POST['car_model'];
    $kms_driven = $_POST['kms_driven'];  // Fetching the value from the form
    $status = $_POST['status'];
    $owner = $_POST['owner'];
    $fual_type = $_POST['fual_type'];
    $insurance = $_POST['insurance'];
    $car_hestory = $_POST['car_hestory'];
    $last_service = $_POST['last_service'];
    $reg_no = $_POST['reg_no'];

    // Update query
    $updateQuery = "UPDATE products SET 
                    price = '$price', 
                    car_purch_year = '$car_purch_year',
                    car_compney = '$car_compney',
                    car_model = '$car_model',
                    kms_driven = '$kms_driven',
                    status = '$status',
                    owner = '$owner',
                    fual_type = '$fual_type',
                    insurance = '$insurance',
                    car_hestory = '$car_hestory',
                    last_service = '$last_service',
                    reg_no = '$reg_no'
                    WHERE p_id = $id";

    if ($con->query($updateQuery) === TRUE) {
        echo "<div class='alert alert-success'>Car details updated successfully!</div>";
        header("Location: totalListed_car.php");
        exit(); 
    } else {
        echo "<div class='alert alert-danger'>Error updating car: " . $con->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script>
        function validateForm() {
            let form = document.forms["carForm"];
            let fields = ["price", "car_purch_year", "car_compney", "car_model", "kms_driven", "status", "owner", "fual_type", "insurance", "car_hestory", "last_service", "reg_no"];
            let hasError = false;

            fields.forEach(field => {
                let value = form[field].value.trim();
                let errorElement = document.getElementById(field + "_error");
                errorElement.innerHTML = ""; // Clear previous error message

                if (value === "") {
                    errorElement.innerHTML = field.charAt(0).toUpperCase() + field.slice(1).replace('_', ' ') + " is required.";
                    hasError = true;
                }
            });

            // Price validation
            let price = form["price"].value;
            let priceError = document.getElementById("price_error");
            if (isNaN(price) || price <= 0) {
                priceError.innerHTML = "Please enter a valid price.";
                hasError = true;
            }

            // KMs Driven validation
            let kmsDriven = form["kms_driven"].value;
            let kmsError = document.getElementById("kms_driven_error");
            if (isNaN(kmsDriven) || kmsDriven <= 0) {
                kmsError.innerHTML = "Please enter valid kilometers driven.";
                hasError = true;
            }

            // Year validation
            let year = form["car_purch_year"].value;
            let yearError = document.getElementById("car_purch_year_error");
            let currentYear = new Date().getFullYear();
            if (year < 1900 || year > currentYear) {
                yearError.innerHTML = "Please enter a valid car purchase year.";
                hasError = true;
            }

            return !hasError;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center">Update Car Details</h1>
        <form method="post" action="" name="carForm" onsubmit="return validateForm();">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($car['price']); ?>">
                    <small id="price_error" class="text-danger"></small>
                </div>

                <div class="form-group col-md-6">
                    <label for="car_purch_year">Car Purchase Year</label>
                    <input type="number" class="form-control" id="car_purch_year" name="car_purch_year" value="<?php echo $car['car_purch_year']; ?>">
                    <small id="car_purch_year_error" class="text-danger"></small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="car_compney">Make</label>
                    <input type="text" class="form-control" id="car_compney" name="car_compney" value="<?php echo htmlspecialchars($car['car_compney']); ?>">
                    <small id="car_compney_error" class="text-danger"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="car_model">Model</label>
                    <input type="text" class="form-control" id="car_model" name="car_model" value="<?php echo htmlspecialchars($car['car_model']); ?>">
                    <small id="car_model_error" class="text-danger"></small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kms_driven">KMs Driven</label>
                    <input type="text" class="form-control" id="kms_driven" name="kms_driven" value="<?php echo htmlspecialchars($car['kms_driven']); ?>">
                    <small id="kms_driven_error" class="text-danger"></small>
                </div>

                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="onsell" <?php if ($car['status'] == 'onsell') echo 'selected'; ?>>On Sell</option>
                        <option value="sold" <?php if ($car['status'] == 'sold') echo 'selected'; ?>>Sold</option>
                    </select>
                    <small id="status_error" class="text-danger"></small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="owner">Owner</label>
                    <input type="text" class="form-control" id="owner" name="owner" value="<?php echo htmlspecialchars($car['owner']); ?>">
                    <small id="owner_error" class="text-danger"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="fual_type">Fuel Type</label>
                    <select class="form-control" id="fual_type" name="fual_type">
                        <option value="petrol" <?php if ($car['fual_type'] == 'petrol') echo 'selected'; ?>>Petrol</option>
                        <option value="diesel" <?php if ($car['fual_type'] == 'diesel') echo 'selected'; ?>>Diesel</option>
                    </select>
                    <small id="fual_type_error" class="text-danger"></small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="insurance">Insurance</label>
                    <input type="text" class="form-control" id="insurance" name="insurance" value="<?php echo htmlspecialchars($car['insurance']); ?>">
                    <small id="insurance_error" class="text-danger"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="car_hestory">Car History</label>
                    <input type="text" class="form-control" id="car_hestory" name="car_hestory" value="<?php echo htmlspecialchars($car['car_hestory']); ?>">
                    <small id="car_hestory_error" class="text-danger"></small>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="last_service">Last Service</label>
                    <input type="date" class="form-control" id="last_service" name="last_service" value="<?php echo htmlspecialchars($car['last_service']); ?>">
                    <small id="last_service_error" class="text-danger"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="reg_no">Registration Number</label>
                    <input type="text" class="form-control" id="reg_no" name="reg_no" value="<?php echo htmlspecialchars($car['reg_no']); ?>">
                    <small id="reg_no_error" class="text-danger"></small>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block" name="update">Update Car</button>
        </form>
    </div>
</body>
</html>
