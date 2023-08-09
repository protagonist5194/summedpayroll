<?php
include('db_config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_id = $_POST['recipient_id'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert the message into the messages table
    $insert_query = "INSERT INTO messages (employee_id, subject, message, timestamp) VALUES ('$recipient_id', '$subject', '$message', NOW())";
    if (mysqli_query($con, $insert_query)) {
        echo "Message sent successfully!";
    } else {
        echo "Error sending message: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
