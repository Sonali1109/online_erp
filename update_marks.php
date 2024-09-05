<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;
header('Content-Type: application/json');
require "connection.php";

$response = [];

if (isset($_POST['student_id']) && isset($_POST['semester']) && isset($_POST['marks'])) {
    $student_id = $_POST['student_id'];
    $semester = $_POST['semester'];
    $marks = json_decode($_POST['marks'], true);

    // Fetch name
    $query = "SELECT * FROM students WHERE id='$student_id'";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $mobile = "+91".intval($mobile);

        if($semester <= 5)
            echo "Can't Change marks of previous Semester";

        if ($semester == 6) {
            $compilerDesign = $marks['sub1'];
            $softwareEngineering = $marks['sub2'];
            $computerNetworks = $marks['sub3'];
            $fullStackWebDevelopment = $marks['sub4'];
            $careerSkills = $marks['sub5'];
            $elective = $marks['sub6'];
            $compilerDesignLab = $marks['sub7'];
            $softwareEngineeringLab = $marks['sub8'];
            $fullStackWebDevelopmentLab = $marks['sub9'];
            $cgpa = $marks['cgpa'];

            $sql = "UPDATE Sem6 SET 
                        CompilerDesign=?, 
                        SoftwareEngineering=?, 
                        ComputerNetworks=?, 
                        FullStackWebDevelopment=?, 
                        CareerSkills=?, 
                        Elective=?, 
                        CompilerDesignLab=?, 
                        SoftwareEngineeringLab=?, 
                        FullStackWebDevelopmentLab=?, 
                        Cgpa=? 
                    WHERE id=?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssssssssi", $compilerDesign, $softwareEngineering, $computerNetworks, $fullStackWebDevelopment, $careerSkills, $elective, $compilerDesignLab, $softwareEngineeringLab, $fullStackWebDevelopmentLab, $cgpa, $student_id);

            if ($stmt->execute()) {
                // Email
                $response['success'] = 'Marks updated successfully';

                $apiKey = '7DE2D33E8664FAC4BD75BCCF2910EB22FAF0D45887CF77C20D7F795215A78DE3CFBEDB1AA8215A3998572F8ED66C692B';
                $fromEmail = 'gandhi.aditya11@gmail.com';
                $fromName = 'Admin';
                $toEmail = $email;
                $subject = 'Result Out';
                $message = 'Dear '. $name . ', Your result for Semester ' . $semester . ' is out on ERP portal. Your ward has scored a Cgpa of ' .$cgpa. '. Kindly access the portal to view your result.';
                $url = 'https://api.elasticemail.com/v2/email/send';

                $post = [
                    'apikey' => $apiKey,
                    'from' => $fromEmail,
                    'fromName' => $fromName,
                    'to' => $toEmail,
                    'subject' => $subject,
                    'bodyHtml' => $message
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response['email_response'] = curl_exec($ch);
                curl_close($ch);

                // SMS
                $sid = 'AC92fc112b1cafc66ee04b1d6f25408aaf';
                $token = 'e3342068fb23b9f82f3cebd6efd932a4';
                $twilio = new Client($sid, $token);

                $message = $twilio->messages
                                ->create("$mobile",
                                        [
                                            "body" => "Dear ".$name.", Your result for Semester ". $semester." is out on ERP portal. Your ward has scored a Cgpa of ".$cgpa ." . Kindly access the portal to view your result.",
                                            "from" => "+15075981259"
                                        ]
                                );

            } else {
                $response['error'] = 'Error updating marks: ' . $stmt->error;
            }
        } else {
            $response['error'] = 'Invalid semester';
        }
    } else {
        $response['error'] = 'Error fetching student data: ' . mysqli_error($con);
    }

    $con->close();
} else {
    $response['error'] = 'Invalid input';
}

echo json_encode($response);