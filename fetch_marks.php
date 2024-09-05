<?php
header('Content-Type: application/json');
require "connection.php";

$response = [];

if (isset($_POST['student_id']) && isset($_POST['semester'])) {
    $student_id = $_POST['student_id'];
    $semester = $_POST['semester'];
    
    if (!is_numeric($student_id) || !is_numeric($semester)) {
        $response['error'] = 'Invalid input';
        echo json_encode($response);
        exit();
    }

    $tablename = 'sem' . intval($semester);
    
    $stmt = $con->prepare("SELECT * FROM $tablename WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param('i', $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            $response['error'] = 'No data found';
            echo json_encode($response);
        }

        $stmt->close();
    } else {
        $response['error'] = 'Query error: ' . $con->error;
        echo json_encode($response);
    }

    $con->close();
} else {
    $response['error'] = 'Invalid input';
    echo json_encode($response);
}
?>
