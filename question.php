<html>

<head><title>Question updation</title><head>

<body background="exam13.jpg">
<form action=" " method="post">
<font color="darkblue" size="4"><em>

<p align="center">
<label for="textField1">Enter question  &nbsp&nbsp&nbsp&nbsp</label> 
<textarea name="textAreaField" id="textAreaField" rows="2" cols="21"></textarea>&nbsp&nbsp</p>

<p align="center">
<label for="textField1">Enter choice 1 &nbsp&nbsp&nbsp&nbsp</label>
<input type="text" name="textField1" id="textField1" value=""/></p>

<p align="center">
<label for="textField2">Enter choice 2 &nbsp&nbsp&nbsp&nbsp</label>
<input type="text" name="textField2" id="textField2" value=""/></p>

<p align="center">
<label for="textField3">Enter choice 3 &nbsp&nbsp&nbsp&nbsp</label>
<input type="text" name="textField3" id="textField3" value=""/></p>

<p align="center">
<label for="textField4">Enter choice 4 &nbsp&nbsp&nbsp&nbsp</label>
<input type="text" name="textField4" id="textField4" value=""/></p>

<p align="center">
<label for="pullDownMenu">Answer option &nbsp&nbsp&nbsp&nbsp</label>
<select name="pullDownMenu" id="pullDownMenu" size="1">
	<option value="" selected="selected">--select--</option>
	<option value="a">Choice 1</option>
	<option value="b">Choice 2</option>
	<option value="c">Choice 3</option>
	<option value="d">Choice 4</option>
</select>

&nbsp&nbsp&nbsp&nbsp
<input type="image" name="imageField" id="imageField" value="" src=asterisk.gif width="15" height="15"/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
</p></em></font>

<?php

$question=$_POST["textAreaField"];
$choice1=$_POST["textField1"];
$choice2=$_POST["textField2"];
$choice3=$_POST["textField3"];
$choice4=$_POST["textField4"];
$answer=$_POST["pullDownMenu"];


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
$sql="create table if not exists questiondetails(question_no int not null,question varchar(100) not null,choice1 varchar(50) not null,choice2 varchar(50) not null,choice3 varchar(50) not null,choice4 varchar(50) not null,answer varchar(5) not null,inc int not null,primary key(question_no));";
mysql_query($sql)
	or die (mysql_error());


$sql="select question_no from questiondetails;";
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");

	if(mysql_num_rows($result)>0)
	{
		while($row=mysql_fetch_array($result))
		{

		$no=$row["question_no"];
		
		}
		$no++;
	}
	
	else
	$no=1;
	

if ($no<0 || empty($question) || empty($choice1) || empty($choice2) || empty($choice3) || empty($choice4) || empty($answer)) 
{
$ch=0; 
} 
					
else 
$ch=1;

?>

<?php if ($ch==1) : ?>

	<?php 
	$sql="insert into questiondetails values('$no','$question','$choice1','$choice2','$choice3','$choice4','$answer','0');";
	mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");
	
	$sql="update questiondetails value set inc='1' where question_no='1';";
	mysql_query($sql) or die ("Unable to update :".mysql_error()."</br>");
	?>

<?php else: ?>
<font color="red" size="3"><h3 align="center"><em>Don't enter null value.please <a href="question.php">Re-enter</a></em></h3></font>

<?php endif; ?>


			<font color="red" size="4">
			<h3 align="center"><em> ( 
			<a href="question.php">Add one more question</a> /
			<a href="viewallquestions.php">view all quetions</a> / 
			<a href="deletequestion.php">Delete question</a> / 
			<a href="deleteallquestions.php">Delete all questions</a> /
			<a href="settime.php">Set exam timing</a> /
			<a href="settime.php">Re-set exam timing</a> )
			</em></h3>
			<h3 align="center"><em><a href="home.php" >Home</a></em></h3>
			</font>
			
</em></font>
</form>
</body>
</html>