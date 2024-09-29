<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validating inputs
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
        exit;
    }

    // Hashing the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // storing the user data in php array
    $newUser = [
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword
    ];

    // check if there is users,json file 
    $users = [];
    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json'), true);
    }

    // Validating if user already exisits
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            echo "Username already exists!";
            exit;
        }
    }

    // Add new user
    $users[] = $newUser;

    // Saving user  to JSON
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    echo "Registration successful! You can now <a href='login.php'>login</a>.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account Login here.</a>
</body>
</html>
