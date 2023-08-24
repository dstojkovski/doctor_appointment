<?php
include 'config.php';

$appointmentsQuery = "SELECT * FROM Appointments";
$appointmentsResult = $conn->query($appointmentsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointments List</title>
</head>
<body>
    <a href="appointment.html">Home Page</a>
    <h1>Appointments List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Doctor</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Service</th>
            <th>Special Requirements</th>
            <th>Medical Condition</th>
            <th>Patient Name</th>
            <th>Patient Contact</th>
            <th>Edit</th>
            <th>Cancel</th>
        </tr>
        <?php
        if ($appointmentsResult->num_rows > 0) {
            while ($row = $appointmentsResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['doctor_id'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['service_e'] . "</td>";
                echo "<td>" . $row['special_requirements'] . "</td>";
                echo "<td>" . $row['medical_condition'] . "</td>";
                echo "<td>" . $row['patient_name'] . "</td>";
                echo "<td>" . $row['patient_contact'] . "</td>";
                echo "<td><a href='edit_appointment.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "<td><a href='cancel_appointment.php?id=" . $row['id'] . "'>Cancel</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No appointments found.</td></tr>";
            echo '<a class="button-link" href="appointment.html">Home Page</a>';
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
