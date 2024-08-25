<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize input data
        $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST["phone"]), FILTER_SANITIZE_STRING);
        $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);
    
        // Validate input data
        if (empty($name) || empty($email) || empty($phone) || empty($message)) {
            echo "Please fill in all required fields.";
            exit;
        }
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }
    
        if (!preg_match('/^[0-9]{10,15}$/', $phone)) { // Adjust regex as per your requirement
            echo "Invalid phone number.";
            exit;
        }
    
        // Prepare the email
        $to = "ksrefrigeratorservices@gmail.com"; // Replace with your email
        $subject = "New Contact Form Submission from $name";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: $email";
    
        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "Thank you! Your message has been sent.";
        } else {
            echo "Sorry, something went wrong. Please try again later.";
        }
    }
    ?>