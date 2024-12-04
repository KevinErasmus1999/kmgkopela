<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Recipient email
    $to = "admin@kmgkte.co.za";

    // Email content
    $email_content = "New Contact Form Submission\n\n";
    $email_content .= "Name: " . $name . "\n";
    $email_content .= "Email: " . $email . "\n";
    $email_content .= "Phone: " . $phone . "\n";
    $email_content .= "Subject: " . $subject . "\n\n";
    $email_content .= "Message:\n" . $message . "\n";

    // Email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, "New Contact Form: " . $subject, $email_content, $headers)) {
        // Send auto-reply
        $auto_reply_subject = "Thank you for contacting KMG Kopela Trading Enterprise";
        $auto_reply_message = "Dear " . $name . ",\n\n";
        $auto_reply_message .= "Thank you for reaching out to us. We have received your message and will get back to you as soon as possible.\n\n";
        $auto_reply_message .= "Best regards,\nKMG Kopela Trading Enterprise Team";
        
        mail($email, $auto_reply_subject, $auto_reply_message, "From: " . $to);
        
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error"]);
    }
    exit;
}
?>
