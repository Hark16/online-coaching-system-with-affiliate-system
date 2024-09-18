
<?php

include 'mydb/data.php';


$description = $_SESSION['description'];
$title = $_SESSION['title'];
$short_description = $_SESSION['short_description'];
$keywords = $_SESSION['keywords'];

$cat = $_SESSION['cat'];
$added_on = date("d/m/Y");
$live = 'not';
$table = 'courses';

    // Prepare the SQL statement
    $sql = "INSERT INTO $table (title, description, short_description, keywords, live, cat, added_on) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param('sssssss', $title, $description, $short_description, $keywords, $live, $cat, $added_on);

    // Execute the query
    $stmt->execute();

    // Close the statement
    $stmt->close();

$_SESSION['post_id'] = mysqli_insert_id($conn);

header("Location: index.php");

?>
