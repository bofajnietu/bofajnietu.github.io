<?php
// sendEmail.php

// Function to sanitize input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $message = sanitize_input($_POST['message']);
    
    // Construct email headers
    $to = 'fryderyk.wiszniewski@gmail.com';
    $email_subject = "Nowa Wiadomość od: $name";
    $email_message = "$name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Numer Telefonu: $phone\n\n";
    $email_message .= "Wiadomość:\n$message";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    mail('<fryderyk.wiszniewski@gmail.com>', 'the subject', 'the message', $headers);
    
    // Send email
    if (mail($to, $email_subject, $email_message, $headers)) {
        echo json_encode(['message' => 'Email sent successfully']);
    } else {
        $error_message = error_get_last()['message'] ?? 'Unknown error';
        echo json_encode(['message' => 'Failed to send email']);
    }
} else {
    echo json_encode(['message' => 'Invalid request method']);
}
?>
