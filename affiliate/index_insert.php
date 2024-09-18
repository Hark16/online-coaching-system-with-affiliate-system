
<?php

include 'mydb/data.php';

$fullname = $_SESSION['fullname'] ;
$email = $_SESSION['email'] ;

$mobile = $_SESSION['mobile'] ;
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
$password = $_SESSION['pass'];


$added_on = date("d/m/Y");
$table = 'join_affiliates';

$insert = "INSERT INTO $table (full_name, email, mobile_number, disability, disability_percentage, where_to_know, qualification, address, village, taluka, city, state, country, pin_code, gender, password, total_balance, redeem_balance, upi, ifsc, bank, approved, added_on, code) VALUES('$fullname', '$email', '$mobile', '$disability', '$percentage', '$where', '$qualification', '$address', '$village', '$taluka', '$city', '$state', '$country', '$pin', '$gender', '$password', '0', '0', 'not entered', 'not entered', 'not entered', 'not', '$added_on', '0')" ;
mysqli_query($conn, $insert);
$_SESSION['approve'] = 'not';

echo mysqli_error($conn);

header("Location: index_insert1.php");

?>
