
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lets go green</title>
    <link rel="stylesheet"href="style4.css">
</head>
<body>
    <?php
    include_once ("navbar.php");
include("auth.php");

//checking if request method is post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //retreiving data
    $username = $_POST['username'];
    $password = $_POST['password'];
//prepared statement for database query
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
    //binding username to the prepared statement
    $stmt->bind_param("s", $username);
    $stmt->execute();
    //storing result to be checked later
    $stmt->store_result();

    //  Checks if there is exactly one user with the provided username.
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id, $hashed_password, $user_role);
        $stmt->fetch();


        //if user exits password is verified
        if (password_verify($password, $hashed_password)) {
            // Login successful/paasword is valid,start session and set session variables
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_role'] = $user_role;

            // Redirect to the respective dashboard
            if ($user_role === 'user') {
                header("Location: index.php");
            } elseif ($user_role === 'admin') {
                header("Location: admin_dashboard.php");
            }
            exit();
        } else {
            $error_message = "Invalid password. Please try again.";
        }
    } else {
        $error_message = "Invalid username. Please try again.";
    }
    $stmt->close();
}
?>
    <div class="container">
        <div class="box">
            <h2>Login</h2>
            <form method="POST" action="login.php">
                <div class="inputbox">
                    <input type="text" name="username" required>
                    <label>username</label>
                </div>
                <div class="inputbox">
                    <input type="password" name= "password" required>
                    <label>password</label>
                </div>
                <div class="forgot_password"><a href="#">Forgot password</a></div>
                <button class="loginB" type="submit" value="submit">LOGIN</button>
                <div class="signup_link"><a href="signup.php">Don't have an Account</a></div>
            </form>
        </div>
    
    </div>
</body>
</html>
    
</body>
</html>