
<?php
include 'mydb/data.php';
$page_title = 'welcome '.$_SESSION["full_name"];

if(isset($_SESSION['user'])){

?>

<?php
include 'header.php';
?>

<h1> Your Refferal code </h1>

<input type='text' id='codeCopy1' value= '<?php echo $_SESSION['code']; ?>' />
<br>
<button onclick= 'codeCopy1()'> click here to copy the code </button>
<br>

<h1> Your Refferal area </h1>

<table>

<tr>

<th>Course Name</th>


<th>Copy your referral link</th>

</tr>
								<?php
									$table = 'courses';
									
									// find out how many rows are in the table 
									$sql = "SELECT COUNT(*) FROM $table ";
									$result = mysqli_query($conn, $sql) or trigger_error("SQL", E_USER_ERROR);
									$r = mysqli_fetch_row($result);
									$numrows = $r[0];
									
									// number of rows to show per page
									$rowsperpage = 10;
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
									$sql = "SELECT * FROM $table WHERE live = 'yes' ORDER BY id DESC LIMIT $offset, $rowsperpage ";
									$result = mysqli_query($conn, $sql) or trigger_error("SQL", E_USER_ERROR);
									
									// while there are rows to be fetched...
									while ($row = mysqli_fetch_assoc($result)) {
									
									?>
<?php
$course_id = $row['id'];

$code = $_SESSION['code'];

$referral = 'https://soorvihar.in/s/index.php?id='.$course_id.'&ref='.$code;

?>

<tr>

<td><?php echo $row['title']; ?></td>


<td><button onclick= 'codeCopy("<?php echo$referral; ?>")'> copy your referral link </button></td>

</tr>

								<?php
									}
									// end while
									//select query ended

									?>

</table>

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


<script>
function codeCopy1() {
  var inputField = document.getElementById("codeCopy1");
  inputField.select();
  inputField.setSelectionRange(0, 99999); // For mobile devices

  document.execCommand("copy");

  alert("Value copied: " + inputField.value);
}

function codeCopy(text) {
  var tempInput = document.createElement("textarea");
  tempInput.value = text;
  document.body.appendChild(tempInput);
  tempInput.select();
  document.execCommand("copy");
  document.body.removeChild(tempInput);

  alert("Value copied: " + text);
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
