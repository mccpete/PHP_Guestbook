<?php
//***********************************************
//NOTE - YOU NEED TO SET UP YOUR SQL QUERY IN ORDER FOR THESE SCRIPTS TO WORK

//SQL query Example with Pagination:
//$query = "SELECT * FROM users LIMIT $start, $display";

//SQL query Example with Sorting:
//$query = "SELECT * FROM users ORDER BY $order_by";

//SQL query Example with Both Pagination and Sorting:
//$query = "SELECT * FROM users ORDER BY $order_by LIMIT $start, $display";
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
case 'recent':
$order_by = 'comment_date DESC';
break;
case 'lname':
$order_by = 'lname ASC';
break;
case 'date':
$order_by = 'date ASC';
break;
default:
$order_by = 'comment_date DESC'
$sort = 'old';
break;

}

//Sort buttons
echo '<div align="center">';
echo '<strong> Sort By: </strong>';
echo '<a href="?sort=lname">Last name</a> |';
echo '<a href="?sort=date">Date</a>';
echo '<a href="?sort=recent">Most Recent</a>';
echo '</div>';

//***********************************************
//SORTING SETUP END
//***********************************************
?>
