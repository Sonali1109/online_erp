<?php
require "connection.php";

if(isset($_POST['id']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $id = mysqli_real_escape_string($con, $id);
    $password = mysqli_real_escape_string($con, $password);

    $query = "UPDATE students SET password='$password' WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if($result) {
        $response = "Success";
    } else {
        $response = "Error: " . mysqli_error($con);
    }

    echo $response;
} else {
    echo "ID or password not received";
}
?>
