
<?php
include 'mydb/data.php';
$page_title = 'transfer funds';

$account_holder1 = mysqli_real_escape_string($conn, $_GET['account_holder']);
$account_holder= filter_var($account_holder1, FILTER_SANITIZE_STRING);

if(isset($_SESSION['user'])){
?>

<?php
include 'header.php';
?>

<a href= 'redeem1.php'> back </a>
<br/>

<h1> Details </h1>

<?php

$table = 'join_affiliates';

$select = "SELECT * FROM $table WHERE email = '$account_holder'";
$result = mysqli_query($conn, $select);
mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

$total = $row['total_balance'];
$redeem = $row['redeem_balance'];

$points = $total - $redeem ;

?>

<h2> full name : <?php echo $row['full_name']; ?></h2>

<h2> email id : <?php echo $row['email']; ?></h2>

<h2> total balance : <?php echo $total; ?></h2>
<h2> redeem balance : <?php echo $redeem; ?></h2>
<h2> Net balance : <?php echo $points; ?></h2>

<input type='text' id='upi' value='<?php echo $row["upi"]; ?>'/>
<br/>
<button onclick= 'copy1()'> copy u p i </button>
<br/>

<input type='text' id='bank' value='<?php echo $row["bank"]; ?>'/>
<br/>
<button onclick= 'copy2()'> copy bank account number </button>
<br/>

<input type='text' id='ifsc' value='<?php echo $row["ifsc"]; ?>'/>
<br/>
<button onclick= 'copy3()'> copy bank I F S C code </button>
<br/>

<input type='text' id='mobile' value='<?php echo $row["mobile_number"]; ?>'/>
<br/>
<button onclick= 'copy4()'> copy mobile number </button>
<br/>
<hr/>

<form method='POST'> <input type='submit' name='submit' value=' click here if Transfered Fund' /> <br/> </form>

<?php

if(isset($_POST['submit'])){

$new_redeem_balance = $redeem + $points ;
$update1 = "UPDATE $table SET redeem_balance = '$new_redeem_balance' WHERE email = '$account_holder'";
mysqli_query($conn, $update1);

?>
<script>
window.location.assign('redeem1.php');

</script>

<?php
}

?>


<script>

function copy1(){

  var copyText = document.getElementById("upi");

  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  navigator.clipboard.writeText(copyText.value);

}

function copy2(){

  var copyText = document.getElementById("bank");

  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  navigator.clipboard.writeText(copyText.value);

}

function copy3(){

  var copyText = document.getElementById("ifsc");

  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  navigator.clipboard.writeText(copyText.value);

}

function copy4(){

  var copyText = document.getElementById("mobile");

  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  navigator.clipboard.writeText(copyText.value);

}

</script>

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
