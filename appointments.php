<?php
include 'config.php';

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
    } else {
        
        $overlapQuery = "SELECT id FROM Appointments 
        WHERE doctor_id='$doctorId' 
        AND ('$startTime' BETWEEN start_time AND end_time 
        OR '$endTime' BETWEEN start_time AND end_time
        OR start_time BETWEEN '$startTime' AND '$endTime' 
        OR end_time BETWEEN '$startTime' AND '$endTime')";
    

        $overlapResult = $conn->query($overlapQuery);

        if ($overlapResult->num_rows > 0) {
        echo "Error: Appointment time overlaps with an existing appointment.";
        } else {
        
        $insertQuery = "INSERT INTO Appointments (doctor_id, start_time, end_time, service_e, special_requirements, medical_condition, patient_name, patient_contact) 
            VALUES ('$doctorId', '$startTime', '$endTime', '$service_e', '$specialRequirements', '$medicalCondition', '$patientName', '$patientContact')";

        if ($conn->query($insertQuery) === TRUE) {
        echo "Appointment booked successfully!";
        } else {
        echo "Error: " . $conn->error;
        }
        }
    }
}

$conn->close();
?>