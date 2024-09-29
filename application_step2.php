<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    //get user information and store in session
    $_SESSION['degree'] = htmlspecialchars(trim($_POST['degree']));
    $_SESSION['field_of_study'] = htmlspecialchars(trim($_POST['field_of_study']));
    $_SESSION['institution'] = htmlspecialchars(trim($_POST['institution']));
    $_SESSION['graduation_year'] = (int)$_POST['graduation_year'];


    
    
    header("Location: application_step3.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Step 2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Step 2: Educational Background</h1>

    <!-- Progress Bar -->
    <div class="progress">
        <div class="progress-bar" style="width: 66%;">Step 2 of 3</div>
    </div>

    <form action="application_step2.php" method="post">
        <label>Highest Degree Obtained:</label>
        <input type="text" name="degree" value="<?php echo htmlspecialchars($_SESSION['degree'] ?? ''); ?>" required>
        
        <label>Field of Study:</label>
        <input type="text" name="field_of_study" value="<?php echo htmlspecialchars($_SESSION['field_of_study'] ?? ''); ?>" required>
        
        <label>Name of Institution:</label>
        <input type="text" name="institution" value="<?php echo htmlspecialchars($_SESSION['institution'] ?? ''); ?>" required>
        
        <label>Year of Graduation:</label>
        <input type="number" name="graduation_year" min="1900" max="<?php echo date('Y'); ?>" value="<?php echo htmlspecialchars($_SESSION['graduation_year'] ?? ''); ?>" required>
        
        <div class="button-container">
        <button type="button" onclick="window.location.href='application_step1.php'">Previous</button>
        <button type="submit">Next</button>
    </div>
    </form>
</body>
</html>
