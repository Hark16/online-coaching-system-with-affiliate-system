
<?php
include 'mydb/data.php';
$page_title = 'signUp';

?>

<?php include 'header.php'; ?>

<p><a href="login.php">
click here if you have Account to LogIn 
</a></p>

<?php
include 'form_desktop.php';

if (isset($_POST['submit'])){
if($_POST['g-recaptcha-response'] != ""){

$fullname1 = mysqli_real_escape_string($conn, $_POST['fullname']);
$fullname= filter_var($fullname1, FILTER_SANITIZE_STRING);
$email1 = mysqli_real_escape_string($conn, $_POST['email']);
$email = filter_var($email1, FILTER_SANITIZE_STRING);

$country_code1 = mysqli_real_escape_string($conn, $_POST['country_code']);
$country_code = filter_var($country_code1, FILTER_SANITIZE_STRING);

$mobile1 = mysqli_real_escape_string($conn, $_POST['mobile']);
$mobile2 = filter_var($mobile1, FILTER_SANITIZE_STRING);

$mobile = $country_code.$mobile2;

$disability1 = mysqli_real_escape_string($conn, $_POST['disability']);
$disability= filter_var($disability1, FILTER_SANITIZE_STRING);
$percentage1 = mysqli_real_escape_string($conn, $_POST['percentage']);
$percentage= filter_var($percentage1, FILTER_SANITIZE_STRING);

$where1 = mysqli_real_escape_string($conn, $_POST['where']);
$where = filter_var($where1, FILTER_SANITIZE_STRING);
$qualification1 = mysqli_real_escape_string($conn, $_POST['qualification']);
$qualification = filter_var($qualification1, FILTER_SANITIZE_STRING);

$address1 = mysqli_real_escape_string($conn, $_POST['address']);
$address = filter_var($address1, FILTER_SANITIZE_STRING);

$village1 = mysqli_real_escape_string($conn, $_POST['village']);
$village = filter_var($village1, FILTER_SANITIZE_STRING);
if($village == ""){ $village = "not inserted"; }

$taluka1 = mysqli_real_escape_string($conn, $_POST['taluka']);
$taluka = filter_var($taluka1, FILTER_SANITIZE_STRING);
if($taluka == ""){ $taluka = "not inserted"; }

$city1 = mysqli_real_escape_string($conn, $_POST['city']);
$city = filter_var($city1, FILTER_SANITIZE_STRING);
$state1 = mysqli_real_escape_string($conn, $_POST['state']);
$state = filter_var($state1, FILTER_SANITIZE_STRING);
$country1 = mysqli_real_escape_string($conn, $_POST['country']);
$country = filter_var($country1, FILTER_SANITIZE_STRING);

$pin1 = mysqli_real_escape_string($conn, $_POST['pin']);
$pin = filter_var($pin1, FILTER_SANITIZE_STRING);

$gender1 = mysqli_real_escape_string($conn, $_POST['gender']);
$gender = filter_var($gender1, FILTER_SANITIZE_STRING);

$pass1 = mysqli_real_escape_string($conn, $_POST['password']);
$pass = filter_var($pass1, FILTER_SANITIZE_STRING);

    $secret = $secret_key;
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {

$_SESSION['fullname'] = $fullname ;
$_SESSION['email'] = $email ;

$_SESSION['mobile'] = $mobile ;
$_SESSION['disability'] = $disability ;
$_SESSION['percentage'] = $percentage ;

$_SESSION['where'] = $where ;
$_SESSION['qualification'] = $qualification ;

$_SESSION['address'] = $address ;
$_SESSION['village'] = $village ;
$_SESSION['taluka'] = $taluka ;

$_SESSION['city'] = $city ;
$_SESSION['state'] = $state ;
$_SESSION['country'] = $country ;

$_SESSION['pin'] = $pin ;

$_SESSION['gender'] = $gender ;
$_SESSION['pass'] = $pass ;

if(strpos("$email", "@gmail.com")){
if (preg_match('/^[0-9]{10}$/', $mobile2)) {
$t1 = 'join_affiliates';

$sel= "SELECT * FROM $t1 WHERE email = '$email' ";
$result = mysqli_query($conn,$sel);
$total=mysqli_num_rows($result);

if ($total===0){

?>
<script>
window.location.assign('index_insert.php');
</script>

<?php

}else{echo '<h3>This email is already entered,  Please Try with Another One...</h3>';}
} else {     echo "Mobile number is invalid";}
}else{ echo '<h1>this email id is invalid we only accept Gmail Id ...</h1>';}
}}else{echo '<h1>check first I am not Robot </h1>';}}

?>

<script>

        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.getElementById('agree');
            var table = document.getElementById('mytable');
            var pera = document.getElementById('mypera');

            // Hide the table initially
            table.style.display = 'none';
            pera.style.display = 'none';

            // Toggle table visibility when checkbox is checked/unchecked
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    table.style.display = 'block';
                    pera.style.display = 'block';

                } else {
                    table.style.display = 'none';
                    pera.style.display = 'none';

                }
            });
        });
    </script>

<?php include 'footer.php'; ?>

