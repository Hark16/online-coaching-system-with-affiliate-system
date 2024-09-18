
<?php
include 'mydb/data.php';
$page_title = 'add course';

if(isset($_SESSION['user'])){
?>

<?php
include 'header.php';
?>

<h1>add new course</h1>
<form method='POST'>

<label for='course_name'>enter new course title</label>
<br>
<textarea rows='1' cols='21' name='title' id='course_name' required></textarea>
<br>

<label for='teacher'> enter full article </label>
<br>
<textarea name='description' id='teacher' rows='5' cols='51' required></textarea>
<br>

<label for='fees'> enter short description for front page </label>
<br>
<textarea name='short_description' id='fees' rows='2' cols='51' required></textarea>
<br>

<label for='fees1'> enter all meta keywords </label>
<br>
<textarea name='keywords' id='fees1' rows='2' cols='51' required></textarea>
<br>

<fieldset>
    <legend>Select category</legend>
  <input type="radio" id="male" name="cat" value="instrumental">
  <label for="male">Instrumental</label><br/>
  
  <input type="radio" id="female" name="cat" value="singing" checked>
  <label for="female">Singing</label><br/>
  </fieldset>

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
    $description1 = $_POST['description'];
    $short_description1 = $_POST['short_description'];
    $keywords1 = $_POST['keywords'];

    // Clean the user input using HTML Purifier
    $cleanTitle = $purifier->purify($title1);
    $cleanDescription = $purifier->purify($description1);
    $cleanShortDescription = $purifier->purify($short_description1);
    $cleanKeywords = $purifier->purify($keywords1);

    // Get user input
    $title = $cleanTitle;
    $description = $cleanDescription;
    $short_description = $cleanShortDescription;
    $keywords = $cleanKeywords;

    $cat = $_POST['cat'];

    $secret = $secret_key;
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
    $responseData = json_decode($verifyResponse);

    if ($responseData->success) {

$_SESSION['title'] = $title ;
$_SESSION['description'] = $description ;
$_SESSION['short_description'] = $short_description ;
$_SESSION['keywords'] = $keywords ;
$_SESSION['cat'] = $cat ;

$t1 = 'courses';

// Prepare the statement
$stmt = $conn->prepare("SELECT title FROM $t1 WHERE title = ?");

// Bind the parameter
$stmt->bind_param("s", $title);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Get the total number of rows
$total = $stmt->num_rows;

// Check if total is 0
if ($total === 0) {
?>
<script>
window.location.assign('new_course_insert.php');
</script>

<?php

}else{echo '<h3>This course title Is Taken Please Try Another One...</h3>';}
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
