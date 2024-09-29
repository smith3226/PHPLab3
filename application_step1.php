<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store form data in session
    $_SESSION['fullname'] = trim($_POST['fullname']);
    $_SESSION['email'] = trim($_POST['email']);
    $_SESSION['phone'] = trim($_POST['phone']);
    
    // Redirect to Step 2
    header("Location: application_step2.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Step 1</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <h1 class="hi">Step 1: Personal Information</h1>
    
    <!-- Progress Bar -->
    <div class="progress">
        <div class="progress-bar" style="width: 33%;">Step 1 of 3</div>
    </div>
    
    <form action="application_step1.php" method="post">
        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($_SESSION['fullname'] ?? ''); ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required>
        
        <label>Phone Number:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?>" required>
        
        <button type="submit">Next</button>
    </form>
</body>
</html>
