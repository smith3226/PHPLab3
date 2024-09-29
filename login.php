<?php
// Start session
session_start();

// Checking if the remember me cookie exists 
$cookieUsername = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']);  // Checking if Remember Me  is checked

    // Load users from JSON file
    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json'), true);
    } else {
        $users = [];
    }

    //validating credentials
    $isAuthenticated = false;
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            if (password_verify($password, $user['password'])) {
                $isAuthenticated = true;
                $_SESSION['username'] = $username;  

               //remeber me 
                if ($rememberMe) {
                    setcookie('remember_me', $username, time() + (7 * 24 * 60 * 60), "/"); // 7 days
                } else {
                    // Remove the cookie if not checked
                    if (isset($_COOKIE['remember_me'])) {
                        setcookie('remember_me', '', time() - 3600, "/"); // Expire the cookie
                    }
                }

                // Redirect to the next page after successful login
                header("Location: application_step1.php");
                exit;
            }
        }
    }

    // If user authentication fails thrw error
    if (!$isAuthenticated) {
        $errorMsg = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>

    <?php if (isset($errorMsg)) { ?>
        <p style="color: red;"><?php echo $errorMsg; ?></p>
    <?php } ?>

    <form action="login.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($cookieUsername) ?>" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <!-- "Remember Me" checkbox -->
        <div>
            <label for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me">
                Remember Me
            </label>
        </div>

        <button type="submit">Login</button>
    </form>
    <a href="register.php">Don't have an account? Register here.</a>
</body>
</html>
