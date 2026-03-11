<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Check if fields are empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format!"]);
        exit;
    }

    // Email details
    $to = "afridi.ux@gmail.com"; // Change this to your email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    $body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Your message has been sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to send message. Please try again later."]);
    }
}
?>
