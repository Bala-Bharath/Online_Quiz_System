<html>

<head><title>View mark</title><head>

<body background="exam13.jpg">
<form action="home.php" method="post">

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

$sql="select * from lastuser;";
$result1=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
while($row=mysql_fetch_array($result1))
	{
	$username=$row["username"];
	}

$i=0;
$sql="select * from lastmark;";
$result2=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
while($row=mysql_fetch_array($result2))
	{
	$mark[$i]=$row["mark"];
	//echo "hi".$mark[$i]."</br>";
	$i++;
	}

echo "</br>"."</br>";

$sql="select answer from questiondetails;";
$result3=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
$i=1;
$m=0;
while($row=mysql_fetch_array($result3))
	{
	$ans=$row["answer"];
	//echo $ans."</br>";
	//echo $mark[$i]."</br>";
		if ($ans==$mark[$i])
		{
		$m++; 
		}
	$i++;
	}
$sql="update studentsdetails set mark='$m' where username='$username';";
$result4=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
?>

<font color="green" size="4"><em><h3 align="center">Your mark is <?php echo $m; ?></h3></em></font>
<font color="green" size="4"><em><h3 align="center"><a href="home.php">Home</a></h3></em></font>
</form>
</body>
</html>

