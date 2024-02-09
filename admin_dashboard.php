<?php
include('db_connection.php');
session_start();
//checking if user role session variable is admin 
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// CRUD  for users 
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);

// CRUD  for products 
$sql_products = "SELECT * FROM products";
$result_products = $conn->query($sql_products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family:'Roboto', sans-serif ;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
        }

        .crud-section {
            flex: 1;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 10px;
            text-decoration: none;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
        }

        .btn-danger {
            background-color: #f44336;
        }
    </style>
</head>
<body>
            
    <h2>Welcome, Admin</h2>

    <div class="dashboard-container">
        <div class="crud-section">
            <h3>User Management</h3>
            <a href="signup.php" class="btn">Create User</a>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                  <!-- storing key value pairs -->
                <!-- <?php while ($user = $result_users->fetch_assoc()) { ?> -->
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                        <a href="read_user.php?id=<?php echo $user['id']; ?>" class="btn">read</a>
                            <a href="update_user.php?id=<?php echo $user['id']; ?>" class="btn">update</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div><br>

        <div class="crud-section">
            <h3>Product Management</h3>
            <a href="create_product.php" class="btn">Create Product</a>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                <?php while ($product = $result_products->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['description']; ?></td>
                        <td>
                        <a href="read_product.php?id=<?php echo $product['id']; ?>" class="btn">Read</a>
                            <a href="update_product.php?id=<?php echo $product['id']; ?>" class="btn">Update</a>
                            <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div> <br><br>

    <a href="index.php" class="btn">Logout</a>
</body>
</html>
