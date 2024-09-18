
<?php
include 'mydb/data.php';

$id1 = mysqli_real_escape_string($conn, $_GET['id']);
$id = filter_var($id1, FILTER_SANITIZE_STRING);
$table = 'join_affiliates';

$update = "UPDATE $table SET approved = 'removed' WHERE id = '$id'";
mysqli_query($conn, $update);

header("Location: affiliate.php");

?>
