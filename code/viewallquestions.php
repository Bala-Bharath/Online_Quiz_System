<html>

<head><title>View all questions</title></head>

<body background="../images/exam13.jpg">
<form action="question.php" method="post">

<?php
//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
	or die("Unable to connect Database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");


$sql="select * from questiondetails";
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
?>

<?php if (mysql_num_rows($result)>0): ?>
	<?php while ($row=mysql_fetch_array($result)): ?>
		<em><h3>
		<font color="darkblue" size="4">	
		<?php echo $row["question_no"]." : ".$row["question"]; ?></font></br>&nbsp&nbsp
		
		<font color="red" size="4">
		<?php echo "a) ".$row["choice1"]; ?></br>&nbsp&nbsp
		<?php echo "b) ".$row["choice2"]; ?></br>&nbsp&nbsp
		<?php echo "c) ".$row["choice3"]; ?></br>&nbsp&nbsp
		<?php echo "d) ".$row["choice4"]; ?></font></br>

		<font color="green" size="4">
		<?php echo "Answer : ".$row["answer"]; ?></font></br>
		</h3></em>
	<?php endwhile; ?>
		
<?php else : ?>
	<font color="red" size=""><em><h3>No question exist!</h3></em></font>
	
<?php endif; ?>
<em><h3>&nbsp&nbsp
<a href="question.php">Back</a>&nbsp&nbsp
<a href="home.php">Home</a></em></h3>
</form>
</body>
</html>