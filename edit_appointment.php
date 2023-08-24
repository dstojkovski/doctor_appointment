<?php
include 'config.php';

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $doctorId = $_POST['doctor_id'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];
        $service_e = $_POST['service_e'];
        $specialRequirements = $_POST['special_requirements'];
        $medicalCondition = $_POST['medical_condition'];
        $patientName = $_POST['patient_name'];
        $patientContact = $_POST['patient_contact'];

        $startDate = date('Y-m-d', strtotime($startTime));
        $endDate = date('Y-m-d', strtotime($endTime));


        if ($startDate !== $endDate) {
            echo "Error: Start time and end time must be within the same day.";
        } 
        else{
 
        $updatedDate = date('Y-m-d', strtotime($startTime));
        $updatedDayOfWeek = date('w', strtotime($updatedDate));

        $overlapQuery = "SELECT id FROM Appointments 
                            WHERE doctor_id='$doctorId' 
                            AND ('$startTime' BETWEEN start_time AND end_time 
                            OR '$endTime' BETWEEN start_time AND end_time
                            OR start_time BETWEEN '$startTime' AND '$endTime' 
                            OR end_time BETWEEN '$startTime' AND '$endTime')";
        
        $overlapResult = $conn->query($overlapQuery);

        if($updatedDayOfWeek == 0 || $updatedDayOfWeek == 6) {
            echo "Error: Appointments are not allowed on weekends.";
        }
        else if ($overlapResult->num_rows > 0 ) {
            echo "Error: Appointment time overlaps with an existing appointment.";
        }
        else if ($overlapResult->num_rows === 0){
            $updateQuery = "UPDATE Appointments 
            SET doctor_id='$doctorId', start_time='$startTime', end_time='$endTime', service_e='$service_e', special_requirements='$specialRequirements', medical_condition='$medicalCondition', patient_name='$patientName', patient_contact='$patientContact'
            WHERE id='$appointmentId'";

            if ($conn->query($updateQuery) === TRUE) {
                echo "Appointment updated successfully!";
            } else {
                echo "Error updating appointment: " . $conn->error;
            }
        }
    }
        }
        
       
    $appointmentQuery = "SELECT * FROM Appointments WHERE id='$appointmentId'";
    $appointmentResult = $conn->query($appointmentQuery);

    if ($appointmentResult->num_rows > 0) {
        $appointmentData = $appointmentResult->fetch_assoc();
        $doctorId = $appointmentData['doctor_id'];
        $start_time = $appointmentData['start_time'];
        $end_time = $appointmentData['end_time'];
        $service_e = $appointmentData['service_e'];
        $specialRequirements = $appointmentData['special_requirements'];
        $medicalCondition = $appointmentData['medical_condition'];
        $patientName = $appointmentData['patient_name'];
        $patientContact = $appointmentData['patient_contact'];
    } else {
        echo "Appointment not found.";
        exit;
    }
} else {
    header("Location: display_appointments.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
</head>
<body>
    <h1>Edit Appointment</h1>
    <form action="edit_appointment.php?id=<?php echo $appointmentId; ?>" method="POST">
        <label for="doctor_id">Doctor:</label>
        <input type="text" name="doctor_id" value="<?php echo $doctorId; ?>"><br>
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" value="<?php echo $start_time; ?>"><br>
        <label for="end_time">End Time:</label>
        <input type="datetime-local" name="end_time" value="<?php echo $end_time; ?>"><br>
        <label for="service_e">Service:</label>
        <input type="text" name="service_e" value="<?php echo $service_e; ?>"><br>
        <label for="special_requirements">Special Requirements:</label>
        <input type="text" name="special_requirements" value="<?php echo $specialRequirements; ?>"><br>
        <label for="medical_condition">Medical Condition:</label>
        <input type="text" name="medical_condition" value="<?php echo $medicalCondition; ?>"><br>
        <label for="patient_name">Patient Name:</label>
        <input type="text" name="patient_name" value="<?php echo $patientName; ?>"><br>
        <label for="patient_contact">Patient Contact:</label>
        <input type="text" name="patient_contact" value="<?php echo $patientContact; ?>"><br>
        <input type="submit" value="Save Changes">

    </form>
</body>
</html>

<?php
$conn->close();
?>
