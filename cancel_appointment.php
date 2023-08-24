<?php
include 'config.php';

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $deleteQuery = "DELETE FROM Appointments WHERE id='$appointmentId'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Appointment canceled successfully!";
    } else {
        echo "Error canceling appointment: " . $conn->error;
    }
} else {
    echo "Invalid appointment ID.";
}

$conn->close();
?>
