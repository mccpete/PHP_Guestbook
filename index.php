<?php
include('header.php');
include('mysqli_connect.php');
#old
if (isset($_GET['delete_id'])){
	$delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
	
	$delete_query = "DELETE FROM guestbook WHERE guestbook_id = " . $delete_id;
	$delete_results = mysqli_query($dbc, $delete_query);
	
	echo "<h3>The entry has been deleted.</h3>";
}else{
	$delete_id = "";
}

//***********************************************
//PAGINATION SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
$pages = $_GET['p'];
} else { // Need to determine.
// Count the number of records:
$q = "SELECT COUNT(guestbook_id) FROM guestbook";
$r = mysqli_query ($dbc, $q);
$rowp = mysqli_fetch_array ($r, MYSQLI_NUM);
$records = $rowp[0];
// Calculate the number of pages...
if ($records > $display) { // More than 1 page.
$pages = ceil ($records/$display);
} else {
$pages = 1;
}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
$start = $_GET['s'];
} else {
$start = 0;
}

//***********************************************
//PAGINATION SETUP END
//***********************************************
//***********************************************
//SORTING SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date';

// Determine the sorting order:
		switch ($sort) {
            case 'lname':
            $order_by = 'lname ASC';
            break;
            case 'fname':
            $order_by = 'fname ASC';
            break;
            case 'old':
            $order_by = 'comment_date ASC';
            break;
            case 'new':
            $order_by = 'comment_date DESC';
            break;
            default:
            $order_by = 'comment_date DESC';
            $sort = 'new';
            break;


}

//Sort buttons
 echo '<div align="center">';
 echo '<strong> Sort By: </strong>';
 echo '<a href="?sort=fname">First Name</a> | ';
 echo '<a href="?sort=lname">Last name</a> | ';
 echo '<a href="?sort=old">Oldest</a> | ';
 echo '<a href="?sort=new">Newest</a>';
 echo '</div>';

//***********************************************
//SORTING SETUP END
//***********************************************
?>

<!--here I used a w3 schools css framework for my guestbook -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
	/*here I aligned the h2 tag to the center*/
h2{
	text-align: center;
}

</style>

<h2>Here are the Entries: </h2> 
<br>



<?php
//here with php and sql we are able to show all the guestbook entries
//query that shows guestbook entries
$query = "SELECT * FROM guestbook ORDER BY $order_by LIMIT $start, $display";
$results = mysqli_query($dbc,$query);
	
/*	if($results){
		echo "It worked the comment was deleted!";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
	}
*/ 
//while loop that shows all the entries along with css formatting
while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
	?>
	<!-- css framework div with amber color -->
	<div class="w3-amber w3-hover-shadow w3-padding-64 w3-center" style="margin: auto">
		
	<?php
	//here we echo out all the entries
	echo "Name: ";
	echo $row['fname'] . " " . $row['lname'] . "<br>";
	echo "Comment: ";
	echo $row['comment'] . "<br>";
	echo "Guestbook ID is " . $row['guestbook_id']. "<br><br>";
	echo "<a href='update.php?guestbook_id=" . $row['guestbook_id'] . "'>Update Comment</a> | ";
	echo "<a href='index.php?delete_id=" . $row['guestbook_id'] . "'>Delete Comment</a> ";
	

}	
//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS START
//***********************************************

// Make the links to other pages, if necessary.
if ($pages > 1) {

echo '<br /><p>';
$current_page = ($start/$display) + 1;

// If it's not the first page, make a Previous button:
if ($current_page != 1) {
echo '<a href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}

// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) {
if ($i != $current_page) {
echo '<a href="?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
} else {
echo $i . ' ';
}
} // End of FOR loop.

// If it's not the last page, make a Next button:
if ($current_page != $pages) {
echo '<a href="?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}

echo '</p>'; // Close the paragraph.

} // End of links section.

//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS END
//***********************************************
?>



</div>

<?php
include('footer.php');
?>
