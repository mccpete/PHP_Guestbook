<?php
//used to include menu for top of the page
include('header.php');
include('mysqli_connect.php');
include('footer.php');
?>

<style>
	/* I aligned the page to the center and used some css for submit button*/
.menu {
	text-align center;
	font-family: Monaco;
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
//this code allows us to insert a new guestbook entry using SQL
if ($_SERVER['REQUEST_METHOD']=='POST'){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$comment = $_POST['comment'];
	//query that inserts new data into guesbook database
	$query = "INSERT INTO guestbook(guestbook_id, fname, lname, comment_date, comment) 
	VALUES ('','$fname','$lname',NOW(),'$comment')";
	
	$results = mysqli_query($dbc,$query);
	//tells us if our query ran
	if($results){
		echo "It worked your comment was added!";
		} else {
		echo "There was an error!" . mysqli_error($dbc);
}

}

?>
<!--A form so the guests can enter their data which is centered with a div tag-->
<div class = 'menu'>
<form action="comment.php" method="post">

<!--here is where the data will be entered-->
First Name:
<input name="fname" type="text"/>
<br>
Last Name:
<input name="lname" type="text"/>
<br>
Please enter some comments:
<br>
<textarea name="comment" cols="40" rows="5"></textarea>
<br>
<input type="submit" name="submit" value="Submit" />
</form>
</div>
