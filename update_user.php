<?php
include('auth.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username='$username', role='$role' WHERE id=$user_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // Redirect to the admin dashboard if the user is not found
        header("Location: admin_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Allura&family=Fraunces:opsz,wght@9..144,200;9..144,500;9.
.144,700&family=Recursive:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style5.css" >
    <title>Edit User</title>
    <style>
       h2{
    color:#002004 ;
    font-weight:900 ;
    font-size: 34px;
    font-family:"Fraunces",serif ;
    align-items: center;
}
    </style>
</head>
<body>
<div class="container">
        <div class="box">
    <h2>update User</h2>

    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
       <div class="inputbox">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        </div>
        <div class="inputbox">
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="user" <?php echo ($user['role'] === 'user') ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select><br>
        </div>

        <button class="signupB" type="submit" name="submit" value="Save Changes">Save Changes</button>
    </form>
        </div>
</div>

    <a href="admin_dashboard.php" class="btn">Cancel</a>

</body>
</html>
