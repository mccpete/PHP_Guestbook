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
	
	if (isset($_GET['guestbook_id'])){
		$guestbook_id = "";
	}
	
	if (isset($_POST['comment'])){
		$comment = mysqli_real_escape_string($dbc, trim($_POST['comment']));
	}else{
		$comment = "";
	}
	
	//$guestbook_id = $_POST['guestbook_id'];
	//$comment = $_POST['comment'];

//here is where we use php and sql to update our query 
if ($_SERVER['REQUEST_METHOD']=='POST'){
	
	
	//here is the sql query that is used to update our database
	$query = "UPDATE guestbook SET comment= '$comment' WHERE guestbook_id = '$guestbook_id'";
	
	$results = mysqli_query($dbc,$query);
	
	if($results){
		echo "<h3>Your comment has been updated!</h3>";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
}

}

?>

<?php
if (isset($comment)){
	$sticky_query="SELECT comment FROM guestbook WHERE guestbook_id=" .$guestbook_id;
	$sticky_results=mysqli_query($dbc,$sticky_query);
	$sticky_row=mysqli_fetch_array($sticky_results,MYSQLI_ASSOC);
	$sticky_comment=$sticky_row['comment'];
	
}


?>


<!--here is the form that is used to update a guestbook entry-->
<div class = 'menu'>
<form action="update.php?guestbook_id=<?php echo $guestbook_id?>" method="post">


Please enter new comments:
<br>
<textarea name="comment" cols="40" rows="5"><?php echo $sticky_comment?></textarea>
<br>
<input type="submit" name="submit" value="Submit" />

</form>

</div>
