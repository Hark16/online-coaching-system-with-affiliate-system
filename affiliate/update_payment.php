
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>

<h1>Enter Payment Details </h1>

<form method='POST'>

<p><label for='bank'> Bank account number </label><br> <input type='text' id='bank' name='bank' required> </p>
<p><label for='ifsc'> I F S C Code </label><br> <input type='text' id='ifsc' name='ifsc' required> </p>
<p><label for='upi'> U P I Id </label><br> <input type='text' id='upi' name='upi' required> </p>
<br/>

<input type='submit' name='submit' value='submit' />
</form>

<?php

if(isset($_POST['submit'])){

$table = 'join_affiliates';
$code = $_SESSION['code'];

$bank1 = mysqli_real_escape_string($conn, $_POST['bank']);
$bank = filter_var($bank1, FILTER_SANITIZE_STRING);
$ifsc1 = mysqli_real_escape_string($conn, $_POST['ifsc']);
$ifsc = filter_var($ifsc1, FILTER_SANITIZE_STRING);
$upi1 = mysqli_real_escape_string($conn, $_POST['upi']);
$upi = filter_var($upi1, FILTER_SANITIZE_STRING);

mysqli_query($conn, "UPDATE $table SET bank = '$bank' WHERE code = '$code' ");
mysqli_query($conn, "UPDATE $table SET ifsc = '$ifsc' WHERE code = '$code' ");
mysqli_query($conn, "UPDATE $table SET upi = '$upi' WHERE code = '$code' ");

?>
<script>
window.location.assign('profile.php');
</script>
<?php
}
?>

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
