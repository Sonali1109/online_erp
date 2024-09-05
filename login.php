<?php

require "connection.php";

if(isset($_POST["id"]) && isset($_POST["password"]))
{
    $id = $_POST["id"];
    $password = $_POST["password"];

    $query = "SELECT * FROM students WHERE id='$id' AND password='$password'";
    
    $result = mysqli_query($conn, $query);
    
    if($result) {
        if(mysqli_num_rows($result) > 0) {
            // Fetch user data
            $row = mysqli_fetch_assoc($result);
            
            // Start the session
            session_start();
            
            // Store user data in session variables
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            // Redirect to home.html with user data
            header("Location: Home.html?id=".$row['id']."&name=".$row['name']);
            exit();
        } else {
            // Redirect back to StudentLogin.html with error message
            header("Location: StudentLogin.html?error=Invalid credentials!");
            exit();
        }
    } else {
        // Error handling
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>
