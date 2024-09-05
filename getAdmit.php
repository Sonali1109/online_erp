<?php
require "connection.php";

if(isset($_POST['id']) && isset($_POST['type'])) {
    $id = $_POST['id'];
    $type = $_POST['type'];

    $query = "SELECT * FROM students WHERE id=?";
    $statement = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($statement, "s", $id);

    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo "No data found for the provided ID.";
    }
    mysqli_stmt_close($statement);
} else {
    echo "ID or type parameter is missing!";
}
?>
