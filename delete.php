<?php
include('header.php');
include('mysqli_connect.php');
include('footer.php');
?>

<style>
	/* I aligned the page to the center and used some css for submit button*/
.menu {
	text-align center;
}

input[type=submit] {
    background: #0066A2;
	color: white;
	border-style: outset;
	border-color: #0066A2;
	height: 50px;
	width: 100px;
	font: bold15px arial,sans-serif;
	text-shadow: none;
}

</style>

<?php
//here we use some php to be able to delete a comment from a database with a sql query
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$guestbook_id = $_POST['guestbook_id'];
	
	//here is the sql query that deletes the comment with specified guest id
	$query = "DELETE FROM guestbook WHERE guestbook_id = '$guestbook_id'";
	
	$results = mysqli_query($dbc,$query);
	
	if($results){
		echo "It worked the comment was deleted!";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
}

}



?>
<!--Here is the form to delete a comment-->
<div class = 'menu'> 
<form action="delete.php" method="post">

Guestbook ID:
<input name="guestbook_id" type="text"/>
<br>
<br>
<input type="submit" name="submit" value="Submit" />

</form>
</div>

