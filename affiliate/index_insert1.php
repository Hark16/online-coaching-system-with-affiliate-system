
<?php

include 'mydb/data.php';

$email = $_SESSION['email'] ;
$table = 'join_affiliates';

$sql= "SELECT * FROM $table WHERE email = '$email' ";
$result = mysqli_query($conn,$sql);
$total=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

$id = $row['id'];

mysqli_query($conn, "UPDATE $table SET code = '$id' WHERE id = '$id' ");

   header("Location: login.php");

?>
