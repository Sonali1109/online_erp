<?php
session_start();

if(isset($_POST['logout'])) {
    // $_SESSION = array();
    session_destroy();
    header("Location: Welcome.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSMPS</title>
    <link rel="stylesheet" href="styles1.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Welcome, Admin</h1>
    <div class="nav">
        <form method="post" style="display: inline;">
            <input type="submit" name="logout" value="Logout" style="width: 100px; height: 40px; background-color: blue; color: white; margin-left: 1350px; margin-top: 0px; border-radius: 30px;">
        </form>
    </div>
    <div>
        <button style="width: 250px;height:100px;margin-top:100px;margin-left:200px;" onclick="marks()"><b>Update Marks</b></button>
        <button style="width: 250px;height:100px;margin-top:100px;margin-left:200px;" onclick="Add_Student()"><b>Add Student</b></button>
    </div>
    <script>
        function marks(){
            window.location.href = "EnterMarks.html";
        }
        function Add_Student(){
            window.location.href = "AddStudent.php";
        }
    </script>
</body>
</html>