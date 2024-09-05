<?php
setcookie("id",21021000, time() + (86400 * 30 * 30), "/");
setcookie("erno",2018600, time() + (86400 * 30 * 30), "/");

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'] + 1;
    setcookie("id", $id, time() + (86400 * 30 * 30), "/");
} else {
    $id = 21021001;
    setcookie("id", $id, time() + (86400 * 30 * 30), "/");
}

if (isset($_COOKIE['erno'])) {
    $erno = $_COOKIE['erno'] + 1;
    setcookie("erno", $erno, time() + (86400 * 30 * 30), "/");
} else {
    $erno = 2018600;
    setcookie("erno", $erno, time() + (86400 * 30 * 30), "/");
}

require "connection.php";


$result = "";
$name = $email = $id = $password = $mobile = $fname = $mname = $dob = $course = $sem = $branch = $erno = $urno = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $fname = htmlspecialchars($_POST['fname']);
    $mname = htmlspecialchars($_POST['mname']);
    $dob = htmlspecialchars($_POST['dob']);
    $course = htmlspecialchars($_POST['course']);
    $sem = (int) $_POST['sem'];
    $branch = htmlspecialchars($_POST['branch']);
    $erno = htmlspecialchars($_POST['erno']);
    $urno = htmlspecialchars($_POST['urno']);

    try {
        $query = "INSERT INTO students VALUES ('$id', '$password', '$name', '$email', '$mobile', '$fname', '$mname', '$dob', '$course', $sem, '$branch','NA',0, '$erno', '$urno')";
        $q1 = "INSERT INTO sem1 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        $q2 = "INSERT INTO sem2 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        $q3 = "INSERT INTO sem3 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        $q4 = "INSERT INTO sem4 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        $q5 = "INSERT INTO sem5 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        $q6 = "INSERT INTO sem6 VALUES(0,0,0,0,0,0,0,0,0,0.0,'$id')";
        mysqli_query($con,$q1);
        mysqli_query($con,$q2);
        mysqli_query($con,$q3);
        mysqli_query($con,$q4);
        mysqli_query($con,$q5);
        mysqli_query($con,$q6);
        $res = mysqli_query($con, $query);
        if ($res) {
            $result = "Student Successfully Added";
        } else {
            $result = "Failed to add Student";
        }
    } catch (Exception $e) {
        $result = $e;
    }
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
    <h1 id="welcome">Add Student</h1>
    <div style="margin-left:600px;color:red;font-size:20px;"><?php echo $result ?></div>
    <div class="nav" style="display: flex;">
        <a href="AdminHome.php">Back</a>
    </div>
    <form class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="padding:20px;">
        <h3>Fill Details</h3>
        Id: <input type="text" value="<?php echo htmlspecialchars($_COOKIE['id']); ?>" name="id" readonly><br> 
        Password: <input type="text" value="<?php echo htmlspecialchars($_COOKIE['id']); ?>@geu" name="password" readonly><br>
        Student Name: <input type="text" name="name" required><br>

        Email: <input type="text" name="email" required><br>

        Mobile: <input type="text" name="mobile" required><br>

        Father's Name: <input type="text" name="fname" required><br>

        Mother's Name: <input type="text" name="mname" required><br>

        DOB: <input type="text" name="dob" required><br>

        Course: <input type="text" name="course" required><br>

        Sem: <input type="text" name="sem" value="1" required><br>

        Branch: <input type="text" name="branch" required><br>

        Enrollment No: <input type="text" name="erno" value="<?php echo htmlspecialchars($_COOKIE['erno']); ?>" readonly><br>

        University No: <input type="text" name="urno" value="<?php echo htmlspecialchars($_COOKIE['id']); ?>" readonly><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
