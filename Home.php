<?php
session_start();

if(!isset($_SESSION['id'])) {
    header("Location: StudentLogin.html");
    exit();
}

$id = $_SESSION['id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$mobile = $_SESSION['mobile'];
$fname = $_SESSION['fname'];
$mname = $_SESSION['mname'];
$dob = $_SESSION['dob'];
$course = $_SESSION['course'];
$sem = $_SESSION['sem'];
$branch = $_SESSION['branch'];
$section = $_SESSION['section'];
$crno = $_SESSION['crno'];
$enrollno = $_SESSION['enrollno'];
$urno = $_SESSION['urno'];

if(isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: StudentLogin.php");
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
    <style>
    .container1 {
      display: flex;
      height: 78vh;
    }
    .left-side{
        width: 400px;
        border: 1px solid black;
        padding: 5px;
    }
    .left-side p{
        margin: 25px;
    }
    .right-side {
      flex: 1;
      border: 1px solid black;
      padding: 20px;
    }
  </style>
</head>
<body>
    <h1 id="welcome">Welcome, <?php echo $name; ?></h1>
    <div class="nav" style="display: flex;">
    <button onclick="change()" style="width: 150px; height: 40px; background-color: blue; color: white; margin-left: 1250px; margin-top: 0px; border-radius: 30px;"><b>Change Password</b></button>
        <form method="post">
            <input type="submit" name="logout" value="Logout" style="width: 100px; height: 40px; background-color: blue; color: white; margin-left: 50px; margin-top: 0px; border-radius: 30px;">
        </form>
    </div>
    <div class="container1">
        <div class="left-side" style="display: run-in;">
                <p id="email" style="background-color:cyan;"><b>Email: </b><?php echo $email; ?></p>
                <p id="fname"><b>Father's Name: </b><?php echo $fname; ?></p>
                <p id="mname" style="background-color:cyan;"><b>Mother's Name: </b><?php echo $mname; ?></p>
                <p id="mob"><b>Mobile: </b><?php echo $mobile; ?></p>
                <p id="dob" style="background-color:cyan;"><b>D.O.B: </b><?php echo $dob; ?></p>
                <p id="course"><b>Course: </b><?php echo $course; ?></p>
                <p id="branch" style="background-color:cyan;"><b>Branch: </b><?php echo $branch; ?></p>
                <p id="sem"><b>Sem: </b><?php echo $sem; ?></p>
                <p id="sec" style="background-color:cyan;"><b>Section: </b><?php echo $section; ?></p>
                <p id="crno"><b>Class Roll No: </b><?php echo $crno; ?></p>
                <p id="enrollno" style="background-color:cyan;"><b>Enrollment No: </b><?php echo $enrollno; ?></p>
                <p id="urno"><b>University Roll No: </b><?php echo $urno; ?></p>
        </div>
        <div class="right-side">
            <button style="width: 450px;height:200px;margin-top:150px;margin-left:300px;" onclick="exam()"><b>Exam</b></button>
            <!-- <button style="width: 250px;height:100px;margin-top:100px;margin-left:200px;" onclick="attendance()"><b>Attendance</b></button> -->
        </div>
    </div>
    <script>
        function exam(){
            var id = <?php echo $id;?>;
            console.log(id);
            window.location.href = "exam.php";
        }

        function change(){
            var id = <?php echo $id;?>;
            console.log(id);
            window.location.href = "change.html?id=" + id;
        }
</script>

</body>
</html>
