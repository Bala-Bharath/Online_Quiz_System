<html>

<head><title>Delete questions</title></head>

<body background="../images/exam13.jpg">

<form action=" " method="post">
</br></br></br>
<font color="darkblue" size="3"><em align="center"><h3>
<label for="textField">Enter question nunber to delete </label>
<input type="text" name="textField" id="textField" value=""/>&nbsp&nbsp&nbsp

<input type="image" name="imageField" id="imageField" value="" src=asterisk.gif width="15" height="15"/>
</h3></em></font>
<br/><br/>
<?php

$no=$_POST["textField"];
$i=$no+1;

//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
	or die("Unable to connect Database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");

$sql="select * from  questiondetails where question_no=$no;";
$result=mysql_query($sql);// or die("Unable to delete :".mysql_error()."</br>");

if(mysql_num_rows($result)>0)
{
$flag=1;
$sql="delete from questiondetails where question_no=$no;";
$result=mysql_query($sql) or die("Unable to delete :".mysql_error()."</br>");
}

else
$flag=0;

$sql="select question_no from  questiondetails;";
$result=mysql_query($sql);// or die("Unable to delete :".mysql_error()."</br>");
$n=mysql_num_rows($result);


while($n!=($i+3))
{
	$sql="update questiondetails set question_no=($i-1) where question_no=$i;";
	$result=mysql_query($sql);// or die("Unable to delete :".mysql_error()."</br>");
	$i=$i+1;
}

mysql_close($link);
?>
<font color="green" size="3" align="center"><em><h3>
<?php if($flag==1): ?>
	Question deleted successfully
<?php else: ?>
	<font color="red">No question exists in this number!</font>
<?php endif; ?>
</h3></em></font>
<h3><p align="center"><em><a href="question.php">Back</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="home.php">Home</a></em></p></h3>
</form>
</body>
</html>