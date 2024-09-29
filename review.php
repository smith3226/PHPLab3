<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //storing the user data in array to access it
    $applicationData = [
        'fullname' => $_SESSION['fullname'],
        'email' => $_SESSION['email'],
        'phone' => $_SESSION['phone'],
        'degree' => $_SESSION['degree'],
        'field_of_study' => $_SESSION['field_of_study'],
        'institution' => $_SESSION['institution'],
        'year_of_graduation' => $_SESSION['year_of_graduation'],
        'job_title' => $_SESSION['job_title'],
        'company_name' => $_SESSION['company_name'],
        'years_of_experience' => $_SESSION['years_of_experience'],
        'key_responsibilities' => $_SESSION['key_responsibilities'],
    ];

      // if application json file exists store retrieve it
      $applications = [];
      if (file_exists('applications.json')) {
          $applications = json_decode(file_get_contents('applications.json'), true);
      }
  
      // Add the new application
      $applications[] = $applicationData;
  
      // Save to JSON
      file_put_contents('applications.json', json_encode($applications, JSON_PRETTY_PRINT));
  
      // Clear session once the submit btn is clicked
      session_destroy();

      // Confirmation message
    $confirmationMessage = "Application submitted successfully! Thank you! A confirmation email has been sent to " . htmlspecialchars($applicationData['email']) . ".";

    // Confirmation mail
    $to = $applicationData['email'];
    $subject = "Application Confirmation";
    $message = "Dear " . htmlspecialchars($applicationData['fullname']) . ",\n\nThank you for your application! Here are your application details:\n\n" . print_r($applicationData, true);
   
    echo "<h1>Confirmation</h1>";
    echo "<p>$confirmationMessage</p>";
    echo "<pre>$message</pre>"; 
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Review Your Application</h1>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($_SESSION['fullname'] ?? ''); ?></p>
    <p><strong>Email Address:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?></p>
    <p><strong>Highest Degree Obtained:</strong> <?php echo htmlspecialchars($_SESSION['degree'] ?? ''); ?></p>
    <p><strong>Field of Study:</strong> <?php echo htmlspecialchars($_SESSION['field_of_study'] ?? ''); ?></p>
    <p><strong>Name of Institution:</strong> <?php echo htmlspecialchars($_SESSION['institution'] ?? ''); ?></p>
    <p><strong>Year of Graduation:</strong> <?php echo htmlspecialchars($_SESSION['year_of_graduation'] ?? ''); ?></p>
    <p><strong>Previous Job Title:</strong> <?php echo htmlspecialchars($_SESSION['job_title'] ?? ''); ?></p>
    <p><strong>Company Name:</strong> <?php echo htmlspecialchars($_SESSION['company_name'] ?? 'N/A'); ?></p>
    <p><strong>Years of Experience:</strong> <?php echo htmlspecialchars($_SESSION['years_of_experience'] ?? 'N/A'); ?></p>
    <p><strong>Key Responsibilities:</strong> <?php echo htmlspecialchars($_SESSION['key_responsibilities'] ?? ''); ?></p>

    <form action="review.php" method="post">
        <button type="submit">Submit Application</button>
    </form>
    <a href="application_step1.php">Edit your information</a>
</body>
</html>
