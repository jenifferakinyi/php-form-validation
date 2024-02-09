
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lets go green</title>
    <link rel="stylesheet"href="style3.css">
</head>
<body>
    <?php
    include_once ("navbar.php");
    include_once("auth.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
    
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        
        if ($stmt->execute()) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Registration failed. Please try again.";
        }
        $stmt->close();
    }
    ?>
    <div class="container">
        <div class="box">
            <h2>signup</h2>
            <form  method="POST" action="signup.php">
                <div class="inputbox">
                    <input type="text"  name= "username" required>
                    <label>username</label>
                </div>
            
                <div class="inputbox">
                    <input type="text" name="role" required>
                    <label>role</label>
                </div>
                <div class="inputbox">
                    <input type="password" name= "password" required>
                    <label>password</label>
                </div>
                <button class="signupB" type="submit" name="submit" value="submit">Creat Account</button>
                <div class="login_link"><a href="login.php">Already have an Account</a></div>
            </form>
        </div>
    
    </div>
</body>
</html>


