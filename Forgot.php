<?php
require "connection.php";

if(isset($_POST['id'])) {
    $id = $_POST['id'];

    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($con, $id);

    $query = "SELECT email FROM students WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];
        echo $email;

        $password = generateRandomString();

        $apiKey = '7DE2D33E8664FAC4BD75BCCF2910EB22FAF0D45887CF77C20D7F795215A78DE3CFBEDB1AA8215A3998572F8ED66C692B';
        $fromEmail = 'gandhi.aditya11@gmail.com';
        $fromName = 'Aditya';
        $toEmail = $email;
        $subject = 'New Password';
        $message = 'Your new password is "' . $password . '"';

        $url = 'https://api.elasticemail.com/v2/email/send';

        $post = [
            'apikey' => $apiKey,
            'from' => $fromEmail,
            'fromName' => $fromName,
            'to' => $toEmail,
            'subject' => $subject,
            'body' => $message
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        echo $response;

        $q = "UPDATE students SET password='$password' WHERE id='$id'";
        $result = mysqli_query($con,$q);
        header("Location: StudentLogin.php");
        exit();
    } else {
        echo "Error in fetching email.";
    }
}

function generateRandomString() {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $specialChars = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    $randomString = '';
    for ($i = 0; $i < 2; $i++) {
        $randomString .= $letters[rand(0, strlen($letters) - 1)];
    }

    for ($i = 0; $i < 3; $i++) {
        $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
    }
    $randomString .= $specialChars[rand(0, strlen($specialChars) - 1)];
    $randomString = str_shuffle($randomString);

    return $randomString;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSMPS</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="welcome">Login</div>
    <div class="nav">
        <a href="Welcome.html">Back</a>
        <h3 style="margin-left:350px;color:red;background-color:white;width:710px;padding:5px;">NOTE: Your New Password will be sent to your registered <b><u>Email</u></b></h3>
    </div>
    <div class="container" style="margin-left: 100px;">
        <form method="post">
            <label for="StudentId">Student ID: </label>
            <input type="text" id="StudentId" name="id" placeholder="Enter Student Id"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
