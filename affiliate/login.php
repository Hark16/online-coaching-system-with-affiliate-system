<?php
include 'mydb/data.php';

if(isset($_SESSION['user'])){
?>
<script>
window.location.assign('logout.php');

</script>
<?php
}
else{

$page_title = 'login';

?>

<?php include 'header.php'; ?>


<?php

if(isset($_SESSION['approve'])){

?>

  <h2>Thank you for signing up!</h2>
  <p>We have successfully received your account details. However, please note that your account requires approval from our admin team before you can access it.</p>
  
  <p>Once your account is approved, you will able to login. We appreciate your patience during this process.</p>
  
  <p>If you have any urgent inquiries or need assistance, please don't hesitate to contact our support team or call us ...</p>
  
  <p>Thank you for choosing our platform. We look forward to serving you soon.</p>
  
  <p>Best regards,<br>
  
Team SoorVihar</p>

<?php

}else{
?>

<h1>Welcome </h1>

<p> Fill email id and password to login your account...</p>

<form method='POST'>

<lable for='email'>E-mail </lable><br/>
<input type='email' placeholder='email' name='email' id='email' required/><br/>

<lable for="password">Password </lable><br/>
<input type='password' name='password' id='password' required/><br/>

<input type='submit' name='submit' value='submit' class='btn btn-success'/>

</form>

<?php

if (isset($_POST['submit']))
{

$password1 = mysqli_real_escape_string($conn, $_POST['password']);
$password= filter_var($password1, FILTER_SANITIZE_STRING);
$email1 = mysqli_real_escape_string($conn, $_POST['email']);
$email= filter_var($email1, FILTER_SANITIZE_STRING);
$table = 'join_affiliates';

$sql= "SELECT * FROM $table WHERE email = '$email' and password = '$password' ";

$result = mysqli_query($conn,$sql);
$total=mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
 
if ($total===1){
if($password === $row['password'] ){

$approved = $row['approved'];

if($approved == 'yes'){

$_SESSION['user']= $row['email'];
$_SESSION['code']= $row['code'];
$_SESSION['full_name']= $row['full_name'];
?>
<script>
window.location.assign('index.php');
</script>
<?php
}else if($approved == 'not'){
?>

  <p>Your account is currently awaiting approval. Please wait to be approved and try again later.</p>
<p>If you have any urgent inquiries or need assistance, please don't hesitate to contact our support team or call us ...</p>
  
<?php

}else{
?>
<p>We're sorry to inform you that your affiliate account has been suspended due to inactivity. As stated in our terms and conditions, if no referrals are generated within a six-month period, accounts may be subject to removal. We appreciate your interest in our affiliate program and encourage you to reapply when you are ready to actively promote our products/services. Thank you for your understanding.</p>

<?php

}
}else{
echo '<h1> Wrong Password </h1>';

}

}else{
?>
<script>alert("login unsuccessfull, try again")
</script>
<?php

}

}
?>

<hr/>
<h3><a href='signup.php'> Create New Account </a></h3>
<h3><a href='forget.php'> Click here if Forget Password </a></h3>

<?php
}
?>

<?php include 'footer.php'; ?>

<?php
}
?>
