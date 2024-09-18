<?php
include 'mydb/data.php';

$course_id1 = mysqli_real_escape_string($conn, $_GET['id']);
$course_id = filter_var($course_id1, FILTER_SANITIZE_STRING);
$_SESSION['course_id'] = $course_id ;

if(isset($_GET['ref'])){

$ref1 = mysqli_real_escape_string($conn, $_GET['ref']);
$ref = filter_var($ref1, FILTER_SANITIZE_STRING);
$_SESSION['reff'] = $ref;
}

   header("Location: index_main.php");

?>

