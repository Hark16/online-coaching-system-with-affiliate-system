
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>

<h1> Change password </h1>

<form method='POST'>

<p><label for="old"> Old Password </label><br> <input type='text' id='old' name='old' required> </p>
<p><label for='new1'> New Password </label><br> <input type='text' id='new1' name='new1' required> </p>
<p><label for='new2'> confirm new Password </label><br> <input type='text' id='new2' name='new2' required> </p>
<br/>

<input type='submit' name='submit' value='submit' />
</form>

<?php

if(isset($_POST['submit'])){

$table = 'join_affiliates';
$code = $_SESSION['code'];


$old1 = mysqli_real_escape_string($conn, $_POST['old']);
$old = filter_var($old1, FILTER_SANITIZE_STRING);
$new11 = mysqli_real_escape_string($conn, $_POST['new1']);
$new1 = filter_var($new11, FILTER_SANITIZE_STRING);
$new21 = mysqli_real_escape_string($conn, $_POST['new2']);
$new2 = filter_var($new21, FILTER_SANITIZE_STRING);

$select = "SELECT * FROM $table WHERE code = '$code' ";
$result = mysqli_query($conn, $select);
mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$password = $row['password'];

if($password == $old ){
if($new1 == $new2 ){

mysqli_query($conn, "UPDATE $table SET password = '$new1' WHERE code = '$code' ");

?>
<script>
window.location.assign('profile.php');
</script>
<?php

}else{ echo '<h2> Confirm Password did not Match </h2>'; }
}else{ echo '<h2> Old Password did not Match </h2>'; }


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
