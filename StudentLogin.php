<?php
session_start();

require "connection.php";

if(isset($_POST["id"]) && isset($_POST["password"]))
{
    $id = $_POST["id"];
    $password = $_POST["password"];

    $query = "SELECT * FROM students WHERE id='$id' AND password='$password'";
    
    $result = mysqli_query($con, $query);
    
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['mname'] = $row['mname'];
            $_SESSION['dob'] = $row['dob'];
            $_SESSION['course'] = $row['course'];
            $_SESSION['sem'] = $row['sem'];
            $_SESSION['branch'] = $row['branch'];
            $_SESSION['section'] = $row['section'];
            $_SESSION['crno'] = $row['crno'];
            $_SESSION['enrollno'] = $row['enrollno'];
            $_SESSION['urno'] = $row['urno'];

            header("Location: Home.php");
            exit();
        } else {
            $message = "Invalid Credentials";
            echo "<script type='text/javascript'>alert('$message');</script>";

        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
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
        <a href="Forgot.php">Forgot Password</a>
    </div>
    <div class="container" style="margin-left: 100px;">
        <form method="post">
            <label for="StudentId">Student ID: </label>
            <input type="text" id="StudentId" name="id" placeholder="Enter Student Id"><br>
            <label for="password">Password :</label>
            <input type="password" id="password" name="password" placeholder="Enter Password"><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>