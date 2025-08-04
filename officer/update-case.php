<?php
require 'session.php';
require '../core/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message_id = $_POST['message_id'];
    $case_status = $_POST['case_status'];
    $notes = $_POST['notes'];

    // Check if there is an existing entry for the given message_id
    $check_query = "SELECT * FROM updatecase WHERE message_id = '$message_id'";
    $check_result = mysql_query($check_query);

    if (mysql_num_rows($check_result) > 0) {
        // If there is an existing entry, update it
        $update_query = "UPDATE updatecase SET status = '$case_status', notes = '$notes' WHERE message_id = '$message_id'";
        $result = mysql_query($update_query);

        if ($result) {
            // Data updated successfully
            header("Location: message.php"); // Redirect back to message
            exit();
        } else {
            // Error occurred while updating data
            die("Error: " . mysql_error());
        }
    } else {
        // If there is no existing entry, insert a new one
        $insert_query = "INSERT INTO updatecase (message_id, status, notes) VALUES ('$message_id', '$case_status', '$notes')";
        $result = mysql_query($insert_query);

        if ($result) {
            // Data inserted successfully
            header("Location: message.php"); // Redirect back to message
            exit();
        } else {
            // Error occurred while inserting data
            die("Error: " . mysql_error());
        }
    }
}
?>
