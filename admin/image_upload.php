<?php

include 'mydb/data.php';
$page_title = 'image of product';
if(isset($_SESSION['user'])){
include 'header.php';

?>
<h1>upload image</h1>

    <form method="post" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
<br>        <input type="file" name="image" id="image" accept="image/jpeg, image/png" required>
<br>        <input type="submit" name="submit" value="Upload">
    </form>

<?php

if(isset($_POST['submit'])){
// Set the target directory for image uploads
$targetDir = "../images/";

// Get the uploaded file name
$fileName = $_FILES['image']['name'];

// Get the file extension
$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Check if the file extension is valid (only JPG and PNG allowed)
$allowedExtensions = ['jpg', 'png'];
if (!in_array($fileExt, $allowedExtensions)) {
    echo "Invalid file format. Only JPG and PNG files are allowed.";
    exit;
}

// Generate the new file name using the value from the session
$oldName = $_SESSION['image_name'];
$newFileName = $oldName . '.' . $fileExt;

// Set the final file path
$targetFilePath = $targetDir . $newFileName;

// Move the uploaded file to the target directory with the new file name
if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
mysqli_query($conn, "UPDATE images SET ext = '$fileExt' WHERE name = '$oldName' ");

    echo "Image uploaded successfully.";
?>
<script>
window.location.assign('products.php');
</script>
<?php
} else {
    echo "Error uploading the image.";
}}
?>

<?php
include 'footer.php';
?>
<?php
}else{
?>
<script>
window.location.assign('logout.php');
</script>
<?php } ?>
