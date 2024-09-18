
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

if(isset($_SESSION['user'])){
$email = $_SESSION['user'];
?>

<?php
include 'header.php';
?>

<h1> Your Details </h1>

<?php

$table = 'join_affiliates';

$select = "SELECT * FROM $table WHERE email = '$email' ";
$result = mysqli_query($conn, $select);
mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

?>

<h2> Personal Details </h2>

<p> Name : <?php echo $row['full_name']; ?> </p><br/>
<p> E-Mail : <?php echo $row['email']; ?> </p><br/>
<p> Mobile Number : <?php echo $row['mobile_number']; ?> </p><br/>
<p> Disability Type : <?php echo $row['disability']; ?> </p><br/>
<p> Disability Percentage : <?php echo $row['disability_percentage']; ?> </p><br/>
<p> Gender : <?php echo $row['gender']; ?> </p><br/>
<p> Qualification : <?php echo $row['qualification']; ?> </p><br/>

<p> House/Flat name/number : <?php echo $row['address']; ?> </p><br/>
<p> Village/Locality/Colony/Society name/number : <?php echo $row['village']; ?> </p><br/>
<p> Taluka/Tehsil/Sub-district name : <?php echo $row['taluka']; ?> </p><br/>

<p> City/Town/District name : <?php echo $row['city']; ?> </p><br/>
<p> State/Union-territory name : <?php echo $row['state']; ?> </p><br/>
<p> Country name : <?php echo $row['country']; ?> </p><br/>

<p> Pin/Postal/Zip code : <?php echo $row['pin_code']; ?> </p><br/>

<p> Date of FormFilling : <?php echo $row['added_on']; ?> </p>
<hr/>

<h2> Payment Details </h2>

<p> U P I : <?php echo $row['upi']; ?> </p>
<p> Bank account number : <?php echo $row['bank']; ?> </p>
<p> IFSC code : <?php echo $row['ifsc']; ?> </p>

<hr/>
<a href='update_payment.php'> Update Payment Details </a>
<hr/>
<a href='change_password.php'> Change Your Password </a>
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
