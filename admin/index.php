
<?php
include 'mydb/data.php';
$page_title = 'Home';

if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>

<h1> All courses Details </h1>

								<?php
									$table = 'courses';
									
									// find out how many rows are in the table 
									$sql = "SELECT COUNT(*) FROM $table ";
									$result = mysqli_query($conn, $sql) or trigger_error("SQL", E_USER_ERROR);
									$r = mysqli_fetch_row($result);
									$numrows = $r[0];
									
									// number of rows to show per page
									$rowsperpage = 25;
									// find out total pages
									$totalpages = ceil($numrows / $rowsperpage);
									
									// get the current page or set a default
									if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
									   // cast var as int
									   $currentpage = (int) $_GET['currentpage'];
									} else {
									   // default page num
									   $currentpage = 1;
									} // end if
									
									// if current page is greater than total pages...
									if ($currentpage > $totalpages) {
									   // set current page to last page
									   $currentpage = $totalpages;
									} // end if
									// if current page is less than first page...
									if ($currentpage < 1) {
									   // set current page to first page
									   $currentpage = 1;
									} // end if
									
									// the offset of the list, based on current page 
									$offset = ($currentpage - 1) * $rowsperpage;
									
									// get the info from the db 
									$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $offset, $rowsperpage ";
									$result = mysqli_query($conn, $sql) or trigger_error("SQL", E_USER_ERROR);
									
									// while there are rows to be fetched...
									while ($row = mysqli_fetch_assoc($result)) {
									
									?>

<?php
$table1 = 'students';
$course_id = $row['id'];

// Prepare the statement
$stmt = $conn->prepare("SELECT * FROM $table1 WHERE course_id = ?");

// Bind the parameter
$stmt->bind_param("s", $course_id);

// Execute the statement
$stmt->execute();

// Store the result
$stmt->store_result();

// Get the total number of rows
$total1 = $stmt->num_rows;

?>

<h3> <?php echo$row['title']; ?>, <?php echo$total1; ?> students </h3> 


                     <p class="ipsum_text"> <?php echo$row['short_description']; ?> </p>

<p>category is <?php echo$row['cat']; ?></p>

<?php

if($row['live'] === 'yes'){
echo "<a href='live_not.php?course_id=".$course_id."'> Unpublish this </a>";
echo "<hr/>";

}else{
echo "<a href='live_yes.php?course_id=".$course_id."'> Publish this </a>";
echo "<hr/>";

}

?>

								<?php
									}
									// end while
									//select query ended

									?>

							<nav class='pagination'>
								<?php
									/******  build the pagination links ******/
									// range of num links to show
									$range = 3;
									
									// if not on page 1, don't show back links
									if ($currentpage > 1) {
									   // show << link to go back to page 1
									   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
									   // get previous page num
									   $prevpage = $currentpage - 1;
									   // show < link to go back to 1 page
									   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
									} // end if 
									
									// loop to show links to range of pages around current page
									for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
									   // if it's a valid page number...
									   if (($x > 0) && ($x <= $totalpages)) {
									      // if we're on current page...
									      if ($x == $currentpage) {
									         // 'highlight' it but don't make a link
									         echo " [<b>$x</b>] ";
									      // if not current page...
									      } else {
									         // make it a link
									         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
									      } // end else
									   } // end if 
									} // end for
									
									// if not on last page, show forward and last page links        
									if ($currentpage != $totalpages) {
									   // get next page
									   $nextpage = $currentpage + 1;
									    // echo forward link for next page 
									   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
									   // echo forward link for lastpage
									   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
									} // end if
									/****** end build pagination links ******/
									?>
							</nav>


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
