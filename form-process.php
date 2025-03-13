<?php
header('Content-Type: application/json');

$errorMSG = "";

// FIRST NAME
if (empty($_POST["fname"])) {
    $errorMSG .= "First Name is required. ";
} else {
    $fname = htmlspecialchars($_POST["fname"]);
}

// LAST NAME
if (empty($_POST["lname"])) {
    $errorMSG .= "Last Name is required. ";
} else {
    $lname = htmlspecialchars($_POST["lname"]);
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required. ";
} else {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMSG .= "Invalid email format. ";
    }
}

// PHONE
if (empty($_POST["phone"])) {
    $errorMSG .= "Phone is required. ";
} else {
    $phone = htmlspecialchars($_POST["phone"]);
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required. ";
} else {
    $message = htmlspecialchars($_POST["message"]);
}

$subject = 'Contact Inquiry from Physiocare Website';
$EmailTo = "rockshieldhi@outlook.com"; // Change to your email

// Prepare email body text
$Body = "First Name: $fname\n";
$Body .= "Last Name: $lname\n";
$Body .= "Email: $email\n";
$Body .= "Phone: $phone\n";
$Body .= "Message: $message\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$success = @mail($EmailTo, $subject, $Body, $headers);

// Return response
if ($success && $errorMSG == "") {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $errorMSG ?: "Something went wrong :("]);
}
?>
