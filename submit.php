<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application = [
        'fullname' => $_SESSION['fullname'],
        'email' => $_SESSION['email'],
        'phone' => $_SESSION['phone'],
        'degree' => $_SESSION['degree'],
        'field' => $_SESSION['field'],
        'institution' => $_SESSION['institution'],
        'year' => $_SESSION['year'],
        'job_title' => $_SESSION['job_title'],
        'company' => $_SESSION['company'],
        'experience' => $_SESSION['experience'],
        'responsibilities' => $_SESSION['responsibilities'],
    ];

    // Store application in JSON file
    $applications = json_decode(file_get_contents('applications.json'), true) ?? [];
    $applications[] = $application;
    file_put_contents('applications.json', json_encode($applications));

    // Clear session data
    session_destroy();

    echo "Application submitted successfully!<br>";
    echo "A confirmation email has been sent (simulated).";
}
?>
