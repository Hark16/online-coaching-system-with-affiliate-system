
<?php
include 'mydb/data.php';
$page_title = 'not payed';

if(isset($_SESSION['user'])){
?>

<?php
include 'header.php';
?>


<details>
<summary> click here to search student </summary>

<input type="text" id="search_term" placeholder="enter email of student " autofocus >
<br>
<button onclick="search()">search</button>
<br>

</details>

<div id='no_result_message' style='display:none;'> no result found </div>

<h1 class="all_items"> All students who did not payed any payments </h1>

<?php

$table = 'students';
$table2 = 'payment';
$table3 = 'join_affiliates';
$table4 = 'courses';

$select = "SELECT * FROM $table ";
$result = mysqli_query($conn, $select);
mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){

$email = $row['email'];
$ref_code = $row['ref_code']; 
$course_id = $row['course_id'];

$select2 = "SELECT * FROM $table2 WHERE email = '$email' and course_id = '$course_id'";
$result2 = mysqli_query($conn, $select2);
$line = mysqli_num_rows($result2);

$select3 = "SELECT * FROM $table3 WHERE code = '$ref_code' ";
$result3 = mysqli_query($conn, $select3);
$line3 = mysqli_num_rows($result3);
$row3 = mysqli_fetch_array($result3);

$select4 = "SELECT * FROM $table4 WHERE id = '$course_id' ";
$result4 = mysqli_query($conn, $select4);
$line4 = mysqli_num_rows($result4);
$row4 = mysqli_fetch_array($result4);
if($line == 0){
?>

<details class="all_items" id="<?php echo $email; ?>">
<summary>

<h2> Name: <?php echo $row['full_name']; ?> </h2>
<h2> Email: <?php echo $row['email']; ?> </h2>
<h2> Course Name: <?php echo $row4['title']; ?> </h2>

<?php
if($ref_code > 0){
?>
<h3> Referred by <?php echo $row3['full_name']; ?></h3>
<?php
}
?>

</summary>

<?php

echo "<a href='mannual_join_insert.php?ref_code=".$ref_code."&course_id=".$course_id."&email=".$row['email']."&fullname=".$row['full_name']."'> <h3>Add payment, ".$line." times payed</h3> </a>";    

?>

<p> E-Mail : <?php echo $row['email']; ?> </p>
<p> Mobile Number : <?php echo $row['mobile_number']; ?> </p>
<p> Disability Type : <?php echo $row['disability']; ?> </p>
<p> Disability Percentage : <?php echo $row['disability_percentage']; ?> </p>
<p> Gender : <?php echo $row['gender']; ?> </p>
<p> learning mode : <?php echo $row['mode']; ?> </p>
<p> Qualification : <?php echo $row['qualification']; ?> </p>
<p> sorce of Info : <?php echo $row['where_to_know']; ?> </p>

<p> Address : <?php echo $row['address']; ?> </p>
<p> village : <?php echo $row['village']; ?> </p>
<p> Taluka : <?php echo $row['taluka']; ?> </p>

<p> City : <?php echo $row['city']; ?> </p>
<p> State : <?php echo $row['state']; ?> </p>
<p> country : <?php echo $row['country']; ?> </p>

<p> Postal code : <?php echo $row['pin_code']; ?> </p>
<p> Date of FormFilling : <?php echo $row['added_on']; ?> </p>

</details>
<?php
}}
?>

<script>

function search() {
    let search_term = document.getElementById('search_term').value;
    let email = document.getElementById(search_term);
    let all_items = document.querySelectorAll('.all_items');
    let final = all_items.length;
        let noResultMessage = document.getElementById('no_result_message');

    // Loop through all items and hide them
    for (let i = 0; i < final; i++) {
        all_items[i].style.display = 'none';
    }

    if (email) {
        noResultMessage.style.display = 'none';

        // If email element is found, show it
        email.style.display = 'block';
    } else {
        // If email element is not found, show a "no search result" message
        noResultMessage.style.display = 'block';
    }
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
