
<?php
include 'mydb/data.php';
$coursePage = 'logout.php';
$page_title = 'your Details';
$course_id = $_SESSION['course_id'];

$select11="SELECT * FROM courses WHERE id= '$course_id' and live = 'yes' ";
$result11=mysqli_query($conn, $select11);
$line = mysqli_num_rows($result11);
$row11=mysqli_fetch_array($result11);

//$amount = $row11['amount'];

if($line === 1 ){

?>

<?php include 'header.php'; ?>

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
$mode1 = mysqli_real_escape_string($conn, $_POST['mode']);
$mode = filter_var($mode1, FILTER_SANITIZE_STRING);

$ref1 = mysqli_real_escape_string($conn, $_POST['ref']);
$ref = filter_var($ref1, FILTER_SANITIZE_STRING);

    $secret = $secret_key;
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {

$_SESSION['course_id'] = $course_id ;
//$_SESSION['amount'] = $amount ;

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
$_SESSION['mode'] = $mode ;

$_SESSION['ref'] = $ref;

if(strpos("$email", "@gmail.com")){
if (preg_match('/^[0-9]{10}$/', $mobile2)) {
$t1 = 'students';

$sel= "SELECT * FROM $t1 WHERE email = '$email' and course_id = '$course_id'";
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

<?php include 'footer.php'; ?>


<?php
}else{
?>

<script>
window.location.assign("<?php echo $coursePage; ?>");

</script>

<?php
}
?>
