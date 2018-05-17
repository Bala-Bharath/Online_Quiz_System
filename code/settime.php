<html>

<head><title>Question updation</title><head>

<body background="../images/exam13.jpg">
<form action=" " method="post">

<font color="darkblue" size="4"><em>
<p align="center">
<label for="textField1">Set exam date </label>
<input type="date" name="textField1" id="textField1" value=""/>&nbsp<p>

<p align="center">
<label for="textField2">Set exam time </label>
<input type="time" name="textField2" id="textField2" value=""/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</p>

<p align="center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<label for="textField3">Set exam duration</label>
<input type="number" name="textField3" id="textField3" value=""/>(in mintues)</p>

<p align="center">
<label for="textField4">Set mark for each question</label>
<input type="number" name="textField4" id="textField4" value=""/>&nbsp&nbsp&nbsp
<input type="image" name="imageField" id="imageField" value="" src=asterisk.gif width="15" height="15"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
</p></em></font>

<?php

$edate=$_POST["textField1"];
$etime=$_POST["textField2"];
$eduration=$_POST["textField3"];
$emark=$_POST["textField4"];

//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
	or die("Unable to connect Database :".mysql_error()."</br>");


//database creation
$sql="create database if not exists examdb";
mysql_query($sql,$link)
	or die("Error creating database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");

//table creation
$sql="create table if not exists timeandmark(no int not null,exam_date date not null,exam_time time not null,exam_duration int not null,mark int not null,primary key(no));";
mysql_query($sql)
	or die (mysql_error());


$no=1;

if (empty($edate) || empty($etime) || empty($eduration)|| empty($emark)) 
{
$ch=0; 
} 
					
else 
$ch=1;

?>

<?php if ($ch==1) : ?>

	<?php 
	$sql="truncate table timeandmark;";
	mysql_query($sql) or die("Unable to truncate :".mysql_error()."</br>");

	$sql="insert into timeandmark values('$no','$edate','$etime','$eduration','$emark');";
	mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");
	
	?>

<?php else: ?>
<font color="red" size="3"><h3 align="center"><em>Don't enter null value.please <a href="settime.php">Re-enter</a></em></h3></font>

<?php endif; ?>

<h3 align="center"><em><a href="question.php">Back</a>
<?php mysql_close($link); ?>
</form>
</body>
</html>