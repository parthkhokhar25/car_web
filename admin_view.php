<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" class="bg-dark">
            <div class="sidebar-header text-center text-white p-3">
                <h3>Admin Panel</h3>
            </div>
            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#dashboard" class="nav-link text-white">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="admin/user.php" class="nav-link text-white">
                        <i class="bi bi-people"></i> User Management
                    </a>
                </li>
                <li>
                    <a href="admin/contact.php" class="nav-link text-white">
                        <i class="bi bi-envelope"></i> Contact
                    </a>
                </li>
                <li>
                    <a href="#product" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#productSubmenu" aria-expanded="false">
                        <i class="bi bi-box"></i> Products <i class="bi bi-caret-down float-end"></i>
                    </a>
                    <ul class="collapse list-unstyled ps-4" id="productSubmenu">
                        <li>
                            <a href="admin/add_product.php" class="nav-link text-white">Add Product</a>
                        </li>
                        <li>
                            <a href="admin/manage_product.php" class="nav-link text-white">Manage Products</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin/order.php" class="nav-link text-white">
                        <i class="bi bi-receipt"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="admin/seller.php" class="nav-link text-white">
                        <i class="bi bi-shop"></i> Sellers
                    </a>
                </li>
                <li>
                    <a href="admin/notification.php" class="nav-link text-white">
                        <i class="bi bi-bell"></i> Notifications
                    </a>
                </li>
                <li>
                    <a href="admin/profile.php" class="nav-link text-white">
                        <i class="bi bi-person"></i> Profile
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <div class="container-fluid px-4 py-3">
                <h1>Admin Dashboard</h1>
                <p>Welcome to the admin dashboard! Use the sidebar to navigate through the different sections of the application.</p>
                <!-- Your PHP logic for dashboard content goes here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>