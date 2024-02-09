<?php
include('auth.php');

//check if id is set in url method:GET
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    //sql query to delete user from users table
    $sql = "DELETE FROM users WHERE id=$user_id";
    
    //Execution of SQL query in db connection $conn  if true location dash
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
} else {
    // if not true back to admin dash board
    header("Location: admin_dashboard.php");
    exit();
}
?>
