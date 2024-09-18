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

<h1>Welcom admin </h1>

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
$table = 'join_teachers';

//$sql= "SELECT * FROM $table WHERE email = '$email' and password = '$password' ";
//$result = mysqli_query($conn,$sql);
//$total=mysqli_num_rows($result);
//$row = mysqli_fetch_array($result);
 
//if ($total===1){
//if($password === $row['password'] ){

if($email == 'harish@gmail.com'){
if($password = 'harish@123'){

//$_SESSION['user']= $row['email'];
$_SESSION['user'] = 'hark';

   header("Location: index.php");

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

<?php include 'footer.php'; ?>

<?php
}
?>
