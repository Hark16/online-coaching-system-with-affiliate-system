
<?php
include 'mydb/data.php';
if(isset($_GET['art'])){

$id1 = mysqli_real_escape_string($conn, $_GET['art']);
$id = filter_var($id1, FILTER_SANITIZE_STRING);

$table = 'products';
$select = "SELECT * FROM $table WHERE id = '$id'";
$result = mysqli_query($conn, $select);
if(mysqli_num_rows($result) == 1){
$row = mysqli_fetch_array($result);

$id = $row['id'];
$title = $row['title'];
$description = $row['description'];
$link = $row['link'];
$page_title = $title;
$added_on = $row['added_on'];
$keywords = $row['keywords'];

?>

<?php include 'header.php'; ?>


<h1> <?php echo $title; ?></h1>
<?php

$table1 = 'images';
$select1 = "SELECT * FROM $table1 WHERE post_id = '$id' and table_name = 'products' LIMIT 1";
$result1 = mysqli_query($conn, $select1);

$row1 = mysqli_fetch_array($result1);

?>

                     <img src="../images/<?php echo$row1['name']; ?>.<?php echo $row1['ext']; ?>" alt="<?php echo$row1['alt']; ?>" class="image_7" style="width:100%">
<br>

<span> <?php echo$added_on; ?> </span>
<div> <pre style="white-space:pre-wrap;"><?php echo$description; ?></pre> </div>
<hr>
<a href='<?php echo$link; ?>'> click here to <b>Go To Product</b> </a>
<hr>


<?php include 'footer.php'; ?>


<?php
}else{
?>
<script>

window.location.assign('index.php');
</script>
<?php
}
?>
<?php
}else{
?>
<script>

window.location.assign('index.php');
</script>
<?php
}
?>
