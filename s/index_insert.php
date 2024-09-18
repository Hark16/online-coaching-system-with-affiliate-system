
<?php

include 'mydb/data.php';


$course_id = $_SESSION['course_id'] ;


$fullname = $_SESSION['fullname'] ;
$email = $_SESSION['email'] ;

$mobile = $_SESSION['mobile'] ;;
$disability = $_SESSION['disability'] ;
$percentage = $_SESSION['percentage'] ;

$where = $_SESSION['where'] ;
$qualification = $_SESSION['qualification'] ;

$address = $_SESSION['address'] ;
$village = $_SESSION['village'] ;
$taluka = $_SESSION['taluka'] ;

$city = $_SESSION['city'] ;
$state = $_SESSION['state'] ;
$country = $_SESSION['country'] ;

$pin = $_SESSION['pin'] ;

$gender = $_SESSION['gender'] ;
$mode = $_SESSION['mode'] ;

$ref = $_SESSION['ref'];

$added_on = date("d/m/Y");
$table = 'students';

$insert = "INSERT INTO $table (full_name, email, mobile_number, disability, disability_percentage, where_to_know, qualification, address, village, taluka, city, state, country, pin_code, gender, mode, course_id, ref_code, added_on) VALUES('$fullname', '$email', '$mobile', '$disability', '$percentage', '$where', '$qualification', '$address', '$village', '$taluka', '$city', '$state', '$country', '$pin', '$gender', '$mode', '$course_id', '$ref', '$added_on')" ;
mysqli_query($conn, $insert);

   header("Location: successful.php");

?>
