<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //store the user details in session
    $_SESSION['job_title'] = htmlspecialchars(trim($_POST['job_title']));
    $_SESSION['company_name'] = htmlspecialchars(trim($_POST['company_name']));
    $_SESSION['years_of_experience'] = (int)$_POST['years_of_experience'];
    $_SESSION['key_responsibilities'] = htmlspecialchars(trim($_POST['key_responsibilities']));

    // Send to review page
    header("Location: review.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Step 3</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Step 3: Work Experience</h1>

    <!-- Progress Bar -->
    <div class="progress">
        <div class="progress-bar" style="width: 100%;">Step 3 of 3</div>
    </div>

    <form action="application_step3.php" method="post">
        <label>Previous Job Title:</label>
        <input type="text" name="job_title" value="<?php echo htmlspecialchars($_SESSION['job_title'] ?? ''); ?>" required>
        
        <label>Company Name:</label>
        <input type="text" name="company_name" value="<?php echo htmlspecialchars($_SESSION['company_name'] ?? ''); ?>" required>
        
        <label>Years of Experience:</label>
        <input type="number" name="years_of_experience" min="0" value="<?php echo htmlspecialchars($_SESSION['years_of_experience'] ?? ''); ?>" required>
        
        <label>Key Responsibilities:</label>
        <textarea name="key_responsibilities" required><?php echo htmlspecialchars($_SESSION['key_responsibilities'] ?? ''); ?></textarea>
        
        <!-- Previous button for navigation -->
        <button type="button" onclick="window.location.href='application_step2.php'">Previous</button>
        
        <!-- submit application btn  -->
        <button type="submit">Submit</button>
    </form>
</body>
</html>
