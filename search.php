<?php
include_once "connection.php";
ob_start();
session_start();
if (isset($_SESSION['em']) && isset($_SESSION['pwd']) && $_SESSION['role'] == "user") {
    // echo '<script type="text/javascript">alert("Welcome")</script>';

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Car Search Results</title>
        <!-- Bootstrap CSS -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container my-4">
            <div class="row">
                <?php
                // Fetch search parameters from GET request
                $company = $_GET['company'];
                $year = $_GET['year'];
                $category = $_GET['category'];

                // Start building the SQL query
                $sql = "SELECT * FROM products";
                $conditions = [];

                // Add filters based on user input
                if ($company != "Select Company:" && !empty($company)) {
                    $conditions[] = "car_compney = '" . $company . "'";
                }
                if ($year != "Select Year:" && !empty($year)) {
                    $conditions[] = "car_purch_year = '" . $year . "'";
                }
                if ($category != "Select Category:" && !empty($category)) {
                    $conditions[] = "fual_type = '" . $category . "'";
                }

                // If there are conditions, append them to the query
                if (!empty($conditions)) {
                    $sql .= " WHERE " . implode(" AND ", $conditions);
                }


                // Execute the query
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data for each row
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card mb-4 shadow-sm">';

                        // Assuming the images are stored in a folder and the filename is in the database
                        $image_path = 'Product_images/' . $row["img1"]; // 'img1' is the column name in the database
                        echo '<img class="card-img-top" src="' . $image_path . '" alt="Car image" style="height: 200px; object-fit: cover;">';

                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["car_compney"] . ' ' . $row["car_name"] . '</h5>';
                        echo '<p class="card-text">Year: ' . $row["car_purch_year"] . '</p>';
                        echo '<p class="card-text">Fuel Type: ' . $row["fual_type"] . '</p>';
                        echo '<p class="card-text">Price: ₹' . $row["price"] . '</p>';
                        echo '<form method="GET" action="details.php">';
                        echo '<input type="hidden" name="pid" value="' . $row["p_id"] . '">';

                        // View Details button (fires the view details functionality)
                        echo '<button type="submit" name="view_btn" class="btn btn-primary">View Details</button>';

                        echo '</form>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-12"><p>No results found.</p></div>';
                }

                ?>
            </div>
        </div>

        <!-- Bootstrap JS (optional) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php
} else {
    header("location:login.php");
    exit();
}
?>