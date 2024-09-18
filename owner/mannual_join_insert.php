
<?php
include 'mydb/data.php';
$page_title = 'add payment';


$course_id1 = mysqli_real_escape_string($conn, $_GET['course_id']);
$course_id = filter_var($course_id1, FILTER_SANITIZE_STRING);

$ref_code1 = mysqli_real_escape_string($conn, $_GET['ref_code']);
$ref_code = filter_var($ref_code1, FILTER_SANITIZE_STRING);

$email1 = mysqli_real_escape_string($conn, $_GET['email']);
$email = filter_var($email1, FILTER_SANITIZE_STRING);

$fullname1 = mysqli_real_escape_string($conn, $_GET['fullname']);
$fullname = filter_var($fullname1, FILTER_SANITIZE_STRING);

    $payment_status = "Mannual Joined";
    $added_on = date('Y-m-d h:i:s');


if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>


<form method="POST">
<input type="number" name="amount" autofocus placeholder=" add amount "><br>

<input type="submit" value="submit" name="submit">
</form>

<?php

if(isset($_POST['submit'])){
$amount1 = mysqli_real_escape_string($conn, $_POST['amount']);
$amount = filter_var($amount1, FILTER_SANITIZE_STRING);

if($ref_code >= 1){

    mysqli_query($conn,"insert into payment(full_name, email, amount, status, course_id, added_on, payment_id, ref_code) values('$fullname', '$email', '$amount', '$payment_status', '$course_id', '$added_on', 'Mannual Joined', '$ref_code')");
    $cummission = $amount*0.05;
$aff_table = 'join_affiliates';

$sql1 = "SELECT * FROM $aff_table WHERE code = '$ref_code'";
$result1 = mysqli_query($conn, $sql1);
if(($lines1 =mysqli_num_rows($result1)) > 0 ){
$row1 = mysqli_fetch_array($result1);

$old = $row1['total_balance'];
$new = $old + $cummission ;

$update1 = "UPDATE $aff_table SET total_balance = '$new' WHERE code = '$ref_code'";
mysqli_query($conn, $update1);

?>
<script>
window.location.assign('index.php');
</script>
<?php
}}
else{

    mysqli_query($conn,"insert into payment(full_name, email, amount, status, course_id, added_on, payment_id, ref_code) values('$fullname', '$email', '$amount', '$payment_status', '$course_id', '$added_on', 'Mannual Joined', '$ref_code')");

?>
<script>
window.location.assign('index.php');
</script>
<?php

}

}
?>

<h1>all payment history in this subject</h1>

<?php

$table2 = 'payment';

$select2 = "SELECT * FROM $table2 WHERE email= '$email' and course_id = '$course_id'";
$result2 = mysqli_query($conn, $select2);
if(($line = mysqli_num_rows($result2)) > 0){
?>

<table>
<tr>

<th>Amount</th>
<th>Date Payed</th>

</tr>


<?php

while($row2 = mysqli_fetch_array($result2)){

?>

<tr>

<td><?php echo $row2['amount']; ?></td>

<td><?php echo $row2['added_on']; ?></td>

</tr>

<?php }}
else{ 
echo mysqli_error($conn);
echo "<h2>currently no data</h2>"; }

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
