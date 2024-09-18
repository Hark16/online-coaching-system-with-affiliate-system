
<?php
include 'mydb/data.php';
$page_title = 'create image name';

if(isset($_SESSION['user'])){
?>

<?php
include 'header.php';
?>

<h1>create name of image of product</h1>
<form method='POST'>

<label for='course_name'>enter new product article image name</label>
<br>
<input type='text' name='title' id='course_name' required>
<br>

<label for='course_name1'>enter new product article image alt text</label>
<br>
<input type='text' name='title1' id='course_name1' required>
<br>


                                <div class="g-recaptcha" data-sitekey="<?php echo$site_key; ?>" ></div>

<br/>
<button name='submit' style='background-color:blue; color:white;'>Submit</button>

</form>

<?php

if (isset($_POST['submit'])){
if($_POST['g-recaptcha-response'] != ""){

    // Include the HTML Purifier library
    require_once 'lib/HTMLPurifier.auto.php';

    // HTML Purifier configuration
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);

    // Get user input from the form
    $title1 = $_POST['title'];
    $title111 = $_POST['title1'];

    // Clean the user input using HTML Purifier
    $cleanTitle = $purifier->purify($title1);
    $cleanTitle1 = $purifier->purify($title111);

    // Get user input
    $name = $cleanTitle;
    $alt = $cleanTitle1;

    $post_id = $_SESSION['post_id'];
    $table_name = 'products';
    $added_on = date("d/m/Y");

    $secret = $secret_key;
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {

$_SESSION['image_name'] = $name ;

$t1 = 'images';

$sel= "SELECT name FROM $t1 WHERE name = '$name' ";
$result = mysqli_query($conn,$sel);
$total=mysqli_num_rows($result);

if ($total===0){

mysqli_query($conn, "INSERT INTO $t1 (name, alt, post_id, table_name, added_on) VALUES('$name', '$alt', '$post_id', '$table_name', '$added_on')");

?>
<script>
window.location.assign('image_upload.php');
</script>

<?php

}else{echo '<h3>This image name Is Taken Please Try Another One...</h3>';}
}else{ echo '<h1>Some Error try again . . . .</h1>'; }
}else{echo '<h1>check I am not Robot </h1>';}

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
