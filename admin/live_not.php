
<?php
include 'mydb/data.php';

$course_id1 = mysqli_real_escape_string($conn, $_GET['course_id']);
$course_id = filter_var($course_id1, FILTER_SANITIZE_STRING);
$table = 'courses';

$update = "UPDATE $table SET live = 'not' WHERE id = '$course_id'";
mysqli_query($conn, $update);

header("Location: index.php");

?>
