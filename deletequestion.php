<html>

<head><title>Delete questions</title></head>

<body background="exam13.jpg">

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
$result1=mysql_query($sql);// or die("Unable to delete :".mysql_error()."</br>");
$n=mysql_num_rows($result1);
if($n>0)
{
$flag=1;
$sql="delete from questiondetails where question_no=$no;";
$result2=mysql_query($sql) or die("Unable to delete :".mysql_error()."</br>");
}

else
$flag=0;

$sql="select question_no from  questiondetails;";
$result3=mysql_query($sql);// or die("Unable to delete :".mysql_error()."</br>");
$n=mysql_num_rows($result3);
$i=1;
while($row=mysql_fetch_array($result3))
{
$qno=$row["question_no"];
//echo "</br>".$qno."</br>";
$sql="update questiondetails set question_no='$i' where question_no='$qno';";
$result4=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
$i++;
}

//mysql_close($link);
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