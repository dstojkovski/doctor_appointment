<?php
include 'config.php';

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    $deleteQuery = "DELETE FROM Appointments WHERE id='$appointmentId'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Appointment canceled successfully!\n";
        echo '<a class="button-link" href="appointment.html">Home Page</a>';
    } else {
        echo "Error canceling appointment: \n" . $conn->error;
        echo '<a class="button-link" href="appointment.html">Home Page</a>';
    }
} else {
    echo "Invalid appointment ID.\n";
    echo '<a class="button-link" href="appointment.html">Home Page</a>';
}

$conn->close();
?>
