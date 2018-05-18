<html>

<head><title>Delete all questions</title></head>

<body background="../images/exam13.jpg">
<form action=" " method="post">

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

$sql="select * from  questiondetails;";
$result=mysql_query($sql) or die("Unable to delete :".mysql_error()."</br>");

if(mysql_num_rows($result)>0)
{
$flag=1;
$sql="truncate table questiondetails";
$result=mysql_query($sql) or die("Unable to truncate :".mysql_error()."</br>");
}

else
$flag=0;

?>
</br></br></br>
<?php if ($flag==1): ?>
	<?php if($result): ?>
		<font color="green" size="3" align="center"><em><h3>All questions deleted successfully</h3></em></font>
	<?php endif; ?>
<?php else: ?>
	<font color="red" size="3" align="center"><em><h3>No question exists!</h3></em></font>
<?php endif; ?>
<h3><p align="center"><em><a href="question.php">Back</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="home.php">Home</a></em></p></h3>
</form>
</body>
</html>