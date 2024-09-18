
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

$course_id1 = mysqli_real_escape_string($conn, $_GET['course_id']);
$course_id = filter_var($course_id1, FILTER_SANITIZE_STRING);
$ref = $_SESSION['code'];

if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>

<h1>all payment history in this subject</h1>

<?php

$table2 = 'payment';

$select2 = "SELECT * FROM $table2 WHERE ref_code = '$ref' and course_id = '$course_id'";
$result2 = mysqli_query($conn, $select2);
if(($line = mysqli_num_rows($result2)) > 0){
?>

<table>
<tr>

<th>Full Name</th>
<th>Amount</th>
<th>Date Payed</th>

</tr>


<?php

while($row2 = mysqli_fetch_array($result2)){

?>

<tr>

<td><?php echo $row2['full_name']; ?></td>

<td><?php echo $row2['amount']; ?></td>

<td><?php echo $row2['added_on']; ?></td>

</tr>

<?php }}
else{ echo "<h2>currently no data</h2>"; }

?>

</table>


<?php include 'footer.php'; ?>

<?php
}

else{
?>
<script>
window.location.assign('logout.php');

</script>
<?php
}
?>
