<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submitted'])) {
    // Check if a file is uploaded
    if (isset($_FILES["myfile"]) && $_FILES["myfile"]["error"] == UPLOAD_ERR_OK) {
        $file_name = $_FILES["myfile"]["name"];
        $file_tmp = $_FILES["myfile"]["tmp_name"];

        // Prepare email
        $to = "info@acekacademy.com";
        $subject = "File Uploaded";
        $message = "A file has been uploaded.";

        // Attach file to email
        $file_content = file_get_contents($file_tmp);
        $file_encoded = base64_encode($file_content);
        $file_attachment = chunk_split($file_encoded);

        $boundary = md5(time());
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
        $headers .= "From: Your Name <your_email@example.com>\r\n";

        $body = "--" . $boundary . "\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n";
        $body .= "\r\n" . $message . "\r\n";
        $body .= "--" . $boundary . "\r\n";
        $body .= "Content-Type: application/octet-stream; name=\"" . $file_name . "\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"" . $file_name . "\"\r\n";
        $body .= "\r\n" . $file_attachment . "\r\n";
        $body .= "--" . $boundary . "--";

        // Send email
        if (mail($to, $subject, $body, $headers)) {
            echo "Email sent successfully.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
