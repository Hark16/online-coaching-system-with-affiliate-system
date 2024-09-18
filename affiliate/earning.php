
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

if(isset($_SESSION['user'])){

$email = $_SESSION['user'];

?>

<?php
include 'header.php';
?>

<h1> Your Earning </h1>

<?php

$table = 'join_affiliates';

$select = "SELECT * FROM $table WHERE email = '$email' ";
$result = mysqli_query($conn, $select);
mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

$net_balance = $row['total_balance'] - $row['redeem_balance'] ;
?>

<p> Total Earnings : <?php echo$row['total_balance']; ?> </p>
<p> Redeemed Balance : <?php echo$row['redeem_balance']; ?> </p>
<p> Net Balance : <?php echo$net_balance; ?> </p>

<hr/>
<p>
we will transfer your funds in your given account details <br>
on the finishing of every course admitions<br>


</p>
<hr/>

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
